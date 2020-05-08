<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Duo_Tecno
 * @since 1.0
 * @version 1.0
 */

$user = wp_get_current_user();
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/assets/images/favicon.ico" type="image/x-icon" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/ekko-lightbox.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/bootstrap-select.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/style-2.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/responsive.css">
</head>
<body <?php body_class(); ?>>



<!-- header start -->
<header id="header">
	
	<div class="top_header">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-md-6 col-sm-6 hidden-xs">
					<div class="top_header_text"> <i class="fa fa-angle-double-up"> </i>
						<span class="h_phone"><i class="fa fa-phone" aria-hidden="true"></i>
<a href="tel:<?php the_field('phone', 'option') ?>"><?php the_field('phone', 'option') ?></a></span>
						<span class="h_email"><i class="fa fa-envelope" aria-hidden="true"></i>
<a href="mailto:<?php the_field('email', 'option') ?>"><?php the_field('email', 'option') ?></a></span>
					</div>
				</div>

				<div class="col-lg-5 col-md-6 col-sm-6">
					<div class="top_header_right_text text-right">
						<?php wp_nav_menu( array( 'theme_location' => 'top', 'container_class' => 'top-menu' ) ); ?>
						<?php
						if ( is_user_logged_in() ) { ?>
							<div class="user-account-menu">
								<a href="#" >Welkom <?php echo $user->user_login; ?></a>
								<?php dynamic_sidebar( 'account-menu' ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="main_header">
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-2 overflow">
					<div class="brand_logo">
						<a href="<?php bloginfo('url') ?>">
							<img src="<?php the_field('brand_logo', 'option') ?>">
						</a>
					</div>


						<button class="mobile-search-icon">
							<i class="fa fa-search" aria-hidden="true"></i>
						</button>


						<button class="mobile-menu-btn">
							<span></span>
							<span></span>
							<span></span>
						</button>

				</div>

				<div class="col-md-10 col-sm-10 mobile-clear">
					<div class="brand_menu text-right">
						<div class="ipad-search">
							<a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
						</div>
						<div class="brand_menu_close"><a href="#"> <i class="fa fa-times" aria-hidden="true"></i> </a></div>
						<?php wp_nav_menu( array( 'theme_location' => 'main', 'container_class' => 'my_extra_menu_class' ) ); ?>
					</div>
					<div class="search_box">
						<a class="formClose" href="#"> <i class="fa fa-times" aria-hidden="true"></i> </a>
						<?php get_search_form(); ?>			
					</div>
				</div>
			</div>
		</div>
	</div>


<?php if ( is_front_page() ) : ?>
	<div class="h-tagline"> <?php the_field('header_tag_line'); ?> </div>
<?php endif; ?>

</header>
<!-- header here-->




<?php 
	ob_start();
	wc_print_notices();
	$noticeMsg = ob_get_clean();
	echo '<script type="text/javascript">var noticeMsg = false;</script>';
	if($noticeMsg) {
		echo '<script type="text/javascript">noticeMsg = true;</script>';
	}
?>

<!-- popup start here-->
<div class="popup-main login_pop_up">
<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
<!-- Login form start here-->
	<div id="loginForm" class="popup-body">
		<h2><a class="close-icon" href="javascript:void(0);"><i class="fa fa-times" aria-hidden="true"></i> </a>Login/Registreer</h2>
		<p class="status"><?php echo $noticeMsg; ?></p>
<?php
global $wp, $wpdb;
if(isset($_GET['activation'])){ 
$activationKey = $_GET['activation']; 
$status = $wpdb->get_var( $wpdb->prepare("SELECT user_status FROM $wpdb->users WHERE user_activation_key = %s ", $activationKey) );
if(!$status){
$flag = $wpdb->update( $wpdb->users, ['user_status' => 1], ['user_activation_key' => $activationKey] ); 
if($flag) echo '<p class="status sk-error">User activation completed..</p>'; 
else echo '<p class="status sk-error">Invalid/reuse activation link.</p>';
echo '<script type="text/javascript">jQuery(".login_pop_up").show()</script>';
} 
}
?>

		<div class="popup-iner">
			<!-- h3>Existing Customers Login</h3 -->

						<form class="woocomerce-form woocommerce-form-login login" method="post" autocomplete="off">

							<?php do_action( 'woocommerce_login_form_start' ); ?>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
								<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" autocomplete="off" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
							</p>
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
								<input class="woocommerce-Input woocommerce-Input--text input-text" autocomplete="off" type="password" name="password" id="password"/>
							</p>

							<?php do_action( 'woocommerce_login_form' ); ?>

							<p class="form-row">
								<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
								<input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />

								<!--<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
									<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> 						<span><?php _e( 'Remember me', 'woocommerce' ); ?></span>
								</label>  -->

				        		<span class="woocommerce-LostPassword lost_password">
									<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
								</span>
							</p>

							<?php do_action( 'woocommerce_login_form_end' ); ?>

						</form>

		</div>
		<!-- div class="or">OR</div-->
		<a class="register-redirect" href="javascript:void(0);">Vraag hier je login aan</a>
	</div>
<!-- End -->

<!-- Register form here-->
	<div id="registrationForm" class="popup-body">
		<h2><a class="close-icon" href="javascript:void(0);"><i class="fa fa-times" aria-hidden="true"></i>
		  </a><?php _e( 'Register', 'woocommerce' ); ?></h2>
		<?php echo $noticeMsg; ?>
		<div class="popup-iner">
				<form method="post" class="register">

					<?php do_action( 'woocommerce_register_form_start' ); ?>
				 
				   <!-- custom -->
				   <!-- First Name -->
				   <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			       <label for="first_name"><?php _e( 'Voornaam', 'woocommerce' ); ?><span class="required">*</span></label>
			       <input type="text" class="input-text woocommerce-Input" name="first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['first_name'] ) ) esc_attr_e( $_POST['first_name'] ); ?>" />
			       </p>
			       <!-- Last Name -->
			       <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			       <label for="last_name"><?php _e( 'Familienaam', 'woocommerce' ); ?><span class="required">*</span></label>
			       <input type="text" class="input-text woocommerce-Input" name="last_name" id="reg_last_name" value="<?php if ( ! empty( $_POST['last_name'] ) ) esc_attr_e( $_POST['last_name'] ); ?>" />
			       </p>
			        <!-- Store Name -->
			        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			       <label for="store_name"><?php _e( 'BTW Nummer', 'woocommerce' ); ?><span class="required">*</span></label>
			       <input type="text" class="input-text woocommerce-Input" name="store_name" id="req_store_name" value="<?php if ( ! empty( $_POST['store_name'] ) ) esc_attr_e( $_POST['store_name'] ); ?>" />
			       </p>
			        <!-- Address Name -->
			       <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			       <label for="wpsl_address"><?php _e( 'Bedrijf', 'woocommerce' ); ?><span class="required">*</span></label>
			       <input type="text" class="input-text woocommerce-Input" name="wpsl_address" id="reg_wpsl_address" value="<?php if ( ! empty( $_POST['wpsl_address'] ) ) esc_attr_e( $_POST['wpsl_address'] ); ?>" />
			       </p>
			       <!-- City Name -->
			       <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			       <label for="wpsl_city"><?php _e( 'Stad', 'woocommerce' ); ?><span class="required">*</span></label>
			       <input type="text" class="input-text woocommerce-Input" name="wpsl_city" id="reg_wpsl_city" value="<?php if ( ! empty( $_POST['wpsl_city'] ) ) esc_attr_e( $_POST['wpsl_city'] ); ?>" />
			       </p>
			        <!-- State NAme -->
			       <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			       <label for="wpsl_state"><?php _e( 'Adres', 'woocommerce' ); ?><span class="required">*</span></label>
			       <input type="text" class="input-text woocommerce-Input" name="wpsl_state" id="reg_wpsl_state" value="<?php if ( ! empty( $_POST['wpsl_state'] ) ) esc_attr_e( $_POST['wpsl_state'] ); ?>" />
			       </p>
			        <!-- Zip NAme -->
			       <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			       <label for="wpsl_zip"><?php _e( 'Postcode', 'woocommerce' ); ?><span class="required">*</span></label>
			       <input type="text" class="input-text woocommerce-Input" name="wpsl_zip" id="reg_wpsl_zip" value="<?php if ( ! empty( $_POST['wpsl_zip'] ) ) esc_attr_e( $_POST['wpsl_zip'] ); ?>" />
			       </p>
			        <!-- Country Name -->	
			       	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			       <label for="wpsl_country"><?php _e( 'Country', 'woocommerce' ); ?><span class="required">*</span></label>
			       <input type="text" class="input-text woocommerce-Input" name="wpsl_country" id="reg_wpsl_country" value="<?php if ( ! empty( $_POST['wpsl_country'] ) ) esc_attr_e( $_POST['wpsl_country'] ); ?>" />
			       </p>

			       <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			       <label for="wpsl_phone"><?php _e( 'Telefoonnummer', 'woocommerce' ); ?><span class="required">*</span></label>
			       <input type="text" class="input-text woocommerce-Input" name="wpsl_phone" id="reg_wpsl_phone" value="<?php if ( ! empty( $_POST['wpsl_phone'] ) ) esc_attr_e( $_POST['wpsl_phone'] ); ?>" />
			       </p>
			       <!-- custom end -->





					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
						</p>

					<?php endif; ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?>" />
					</p>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
							<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
						</p>

					<?php endif; ?>



					<!-- Spam Trap -->
					<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" /></div>

					<?php do_action( 'woocommerce_register_form' ); ?>

					<p class="woocomerce-FormRow form-row">
						<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
						<input type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Aanvraag indienen', 'woocommerce' ); ?>" />
					</p>

					<?php do_action( 'woocommerce_register_form_end' ); ?>

				</form>

		</div>
	</div>
<!-- End -->
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
</div>
<!-- Popup end here-->
<!-- Logout Pop Up Starts Here -->

<!-- popup start here-->
<div class="popup-main logout">
<!-- Login form start here-->
	<div id="loginForm" class="popup-body">
		<h2><a class="close-icon" href="javascript:void(0);"><i class="fa fa-times" aria-hidden="true"></i> </a>Logout</h2>
		<div class="popup-iner">
			<h3> <?php the_field('logout_text', 'option'); ?> </h3>
			<a class="custom-btn" href="<?php echo wp_logout_url( 'my-account'); ?>"> <?php the_field('yes', 'option'); ?> </a>
			<a class="custom-btn no_logout" href="javascript:void(0);"> <?php the_field('no', 'option'); ?> </a>
		</div>
	</div>
</div>

<!-- Logout Pop Up Ends Here -->