<?php
/**
 * ILC Tabbed Settings Page
 */
$lang = isset($_GET['lang'])? $_GET['lang'].'_' : 'en_';
// echo "<pre>", print_r($_REQUEST), "</pre>";
add_action( 'init', 'ilc_admin_init' );
add_action( 'admin_menu', 'ilc_settings_page_init' );

function ilc_admin_init() {
	$settings = get_option( "ilc_theme_settings" );
	if ( empty( $settings ) ) {
		$settings = array(
			'reg_salutation' => 'Some intro text for the home page',
			'ilc_tag_class' => false,
			'ilc_ga' => false
		);
		add_option( "ilc_theme_settings", $settings, '', 'yes' );
	}	
}

function ilc_settings_page_init() {
	$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );
	$settings_page = add_theme_page( $theme_data['Name']. ' Email Settings', $theme_data['Name']. ' Email Settings', 'edit_theme_options', 'email-settings', 'ilc_settings_page' );
	add_action( "load-{$settings_page}", 'ilc_load_settings_page' );
}

function ilc_load_settings_page() {
	$lang = isset($_GET['lang'])? '&lang='.$_GET['lang'] : '&lang=en';
	if ( $_POST["ilc-settings-submit"] == 'Y' ) {
		check_admin_referer( "ilc-settings-page" );
		ilc_save_theme_settings();
		$url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
		wp_redirect(admin_url('themes.php?page=email-settings{$lang}&'.$url_parameters));
		exit;
	}
}

function ilc_save_theme_settings() {
	global $pagenow;
	$lang = isset($_GET['lang'])? $_GET['lang'].'_' : '';
	$settings = get_option( "ilc_theme_settings{$lang}" );
	
	if ( $pagenow == 'themes.php' && $_GET['page'] == 'email-settings' ){ 
		if ( isset ( $_GET['tab'] ) )
	        $tab = $_GET['tab']; 
	    else
	        $tab = 'registration'; 

	    switch ( $tab ){ 
	        case 'forgot' :
				$settings['ilc_tag_class']	  = $_POST['ilc_tag_class'];
			break; 
	        case 'payment' : 
				$settings['ilc_ga']  = $_POST['ilc_ga'];
			break;
			case 'registration' : 
				$settings['reg_email_tpl_option']	  = $_POST['reg_email_tpl_option'];
			break;
	    }
	}
	
	if( !current_user_can( 'unfiltered_html' ) ){
		if ( $settings['ilc_ga']  )
			$settings['ilc_ga'] = stripslashes( esc_textarea( wp_filter_post_kses( $settings['ilc_ga'] ) ) );
		if ( $settings['reg_salutation'] )
			$settings['reg_email_tpl_option'] = $settings['reg_email_tpl_option'];
	}
	dd($settings); 
	echo "ilc_theme_{$lang}settings";
	// die;
	$updated = update_option( "ilc_theme_settings{$lang}", $settings );
}

function ilc_admin_tabs( $current = 'registration' ) { 
	$lang = isset($_GET['lang'])? '&lang='.$_GET['lang'] : '&lang=en';
    $tabs = array( 'registration' => 'Registration', 'forgot' => 'Forgot', 'payment' => 'Payment' ); 
    $links = array();
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=email-settings{$lang}&tab=$tab'>$name</a>";
        
    }
    echo '</h2>';
}

function ilc_settings_page() {
	global $pagenow;
	$lang = isset($_GET['lang'])? '&lang='.$_GET['lang'] : '&lang=en';
	$settings = get_option( "ilc_theme_settings" );
	$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );
	?>
	
	<div class="wrap">
		<h2><?php echo $theme_data['Name']; ?> Email Settings</h2>
		
		<?php
			if ( 'true' == esc_attr( $_GET['updated'] ) ) echo '<div class="updated" ><p>Email Settings updated.</p></div>';
			
			if ( isset ( $_GET['tab'] ) ) ilc_admin_tabs($_GET['tab']); else ilc_admin_tabs('registration');
		?>

		<div id="poststuff">
			<form method="post" action="<?php admin_url( 'themes.php?page=email-settings{$lang}' ); ?>">
				<?php
				wp_nonce_field( "ilc-settings-page" ); 
				
				if ( $pagenow == 'themes.php' && $_GET['page'] == 'email-settings' ){ 
				
					if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab']; 
					else $tab = 'registration'; 
					
					echo '<table class="form-table">';
					switch ( $tab ){
						case 'forgot' :
							?>
							<tr>
								<th><label for="ilc_tag_class">Tags with CSS classes:</label></th>
								<td>
									<input id="ilc_tag_class" name="ilc_tag_class" type="checkbox" <?php if ( $settings["ilc_tag_class"] ) echo 'checked="checked"'; ?> value="true" /> 
									<span class="description">Output each post tag with a specific CSS class using its slug.</span>
								</td>
							</tr>
							<?php
						break; 
						case 'payment' : 
							?>
							<tr>
								<th><label for="ilc_ga">Insert tracking code:</label></th>
								<td>
									<textarea id="ilc_ga" name="ilc_ga" cols="60" rows="5"><?php echo esc_html( stripslashes( $settings["ilc_ga"] ) ); ?></textarea><br/>
									<span class="description">Enter your Google Analytics tracking code:</span>
								</td>
							</tr>
							<?php
						break;
						case 'registration' : 
							?>
							<tr>
								<th><label for="reg_salutation">Salutation</label></th>
								<td>
									<input type="text" value="<?php echo esc_html( stripslashes( $settings["reg_salutation"] ) ); ?>" id="reg_salutation" name="reg_email_tpl_option['reg_salutation']"><br/>
									<span class="description">Enter the introductory text for the home page:</span>
								</td>
							<tr>
							<tr>
								<th><label for="reg_subject">Subject</label></th>
								<td>
									<input type="text" value="<?php echo esc_html( stripslashes( $settings["reg_subject"] ) ); ?>" id="reg_subject" name="reg_email_tpl_option['reg_subject']"><br/>
									<span class="description">Enter the introductory text for the home page:</span>
								</td>
							<tr>
							</tr>
								<th><label for="reg_text_1">Text 1 Before Data </label></th>
								<td>
									<textarea id="reg_text_1" name="reg_email_tpl_option['reg_text_1']" cols="60" rows="5" ><?php echo esc_html( stripslashes( $settings["reg_text_1"] ) ); ?></textarea><br/>
									<span class="description">Dyanamic data that is display body after this "Text 1":</span>
								</td>
							</tr>
							</tr>
								<th><label for="reg_text_1">Text 2 Before Data </label></th>
								<td>
									<textarea id="reg_text_2" name="reg_email_tpl_option['reg_text_2']" cols="60" rows="5" ><?php echo esc_html( stripslashes( $settings["reg_text_2"] ) ); ?></textarea><br/>
									<span class="description">Dyanamic data that is display body after this "Text 2":</span>
								</td>
							</tr>
							<?php
						break;
					}
					echo '</table>';
				}
				?>
				<p class="submit" style="clear: both;">
					<input type="submit" name="Submit"  class="button-primary" value="Update Settings" />
					<input type="hidden" name="ilc-settings-submit" value="Y" />
				</p>
			</form>
			
			<p><?php echo $theme_data['Name'] ?> theme by <a href="http://ilovecolors.com.ar/">ilovecolors.com.ar</a> | <a href="http://twitter.com/eliorivero">Follow me on Twitter</a>! | Join <a href="http://on.fb.me/ilcfb">ilovecolors on Facebook</a>!</p>
		</div>

	</div>
<?php
}


?>