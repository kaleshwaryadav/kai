<?php
/*
* add styles css
*/
function dd($array){
   echo "<pre>";
   	print_r($array); 
   echo "</pre>";
}
/*
 * Restric admin bar form expect "administrator" & "editor"
 */
function wevo_disable_admin_bar() {
   if (current_user_can('administrator') || current_user_can('editor') ) {
     // user can view admin bar
     show_admin_bar(true); // this line isn't essentially needed by default...
   } else {
     // hide admin bar
     show_admin_bar(false);
   }
}
add_action('after_setup_theme', 'wevo_disable_admin_bar');
/*
 * If user is not an admin, do not allow access to the dashboard AT ALL.
 */
/*function custom_remove_no_admin_access(){

    if ( ! defined( 'DOING_AJAX' ) && ! current_user_can( 'manage_options' ) ) {
        wp_redirect( home_url() );
        die();
    }
}
add_action( 'admin_init', 'custom_remove_no_admin_access', 1 );*/


/*
* Clear header already sent
*/
function ob_start_head(){
	ob_start();
}
add_action('init', 'ob_start_head');

/*
* add styles css
*/
function t2i_site_enqueue_styles(){
	/*
	* Styles
	*/

	if(is_singular() && 'assets' === get_post_type() ){
		wp_enqueue_style( 'css-jquery-datetimepicker-min', '//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.css', '', '2.1.9', false );
	}
}
add_action( 'wp_enqueue_scripts', 't2i_site_enqueue_styles' );

/*
* add custom js
*/
function t2i_site_enqueue_scripts(){
	/*
	* Scripts
	*/
	wp_enqueue_script( 'site-script', get_template_directory_uri() . '/assets/js/site-script.js', array( 'jquery' ), time(), true );
	wp_localize_script('site-script', 'siteObj', array(
			'textdomain' => __('t2i', 't2i'),
			'ajaxUrl' => admin_url('admin-ajax.php')
		)
	);
	if(is_singular() && 'assets' === get_post_type() ){
		wp_enqueue_script( 'lightslider', get_template_directory_uri() . '/assets/js/lightslider.js', array( 'jquery' ), time(), false );
		wp_enqueue_script( 'js-jquery-datetimepicker-min', '//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.js', array( 'jquery' ), '2.1.9', false );
	}
}
add_action( 'wp_enqueue_scripts', 't2i_site_enqueue_scripts' );

/*
* Lets add Open Graph Meta Info
*/
// <meta property="og:image"              content="http://d3.iworklab.com/t2iwp1/wp-content/uploads/2019/05/instagram-download-your-information-1.png" />';
function t2i_insert_ogtag_in_head() {
	global $post;
	$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	// print_r($thumbnail_src);
	if ( !is_singular()) //if it is not a post or a page
		return;
        echo '<meta property="og:url"                content="'.get_permalink().'" />
				<meta property="og:type"               content="article" />
				<meta property="og:title"              content="'.get_the_title().'" />
				<meta property="og:description"        content="'.get_the_excerpt().'" />';

	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		$default_image=get_template_directory_uri()."/assets/images/share-default.jpeg"; //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
}
add_action( 'wp_head', 't2i_insert_ogtag_in_head', 5 );

/*
* Redirect back if page is reminder
*/
/*function t2i_redirect_back(){
	global $post;
	ob_start();
	// ob_get_clean();
	if ( is_page('reminder') ){
		if( wp_get_referer() ){
	    	wp_safe_redirect( wp_get_referer() );
	    	exit;
		}else{
			wp_safe_redirect( home_url('dashboard'));
		}
	}
}
add_action('wp_head', 't2i_redirect_back');*/

/*
* Admin payment status handler
*/
add_action( 'wp_ajax_t2i_handle_payment_status', 't2i_handle_payment_status' );
function t2i_handle_payment_status() {
	global  $current_user, $wpdb;
	$table_name = $wpdb->prefix . "transaction_log";
	$table_name_update = $wpdb->prefix . "montly_payment_report"; 
	$response = array();

	$id = $_POST['id'];
	$email_templ_id = $_POST['email_templ'];
	$tax_id = $_POST['tax_id'];
	$status = $_POST['status'];
	$current_date = date('Y-m-d');
	$sql = "SELECT * FROM $table_name where id = $id AND txn_id='$tax_id'";
	$transaction = $wpdb->get_row($sql);
	$invoice_id = $transaction->invoice_id;
	$owner_id = $transaction->payment_by_userid;
	$asset_user = get_userdata($owner_id);
	$user_displayname = $asset_user->user_firstname;
	$user_email = $asset_user->user_email;
	$address =  get_user_meta($owner_id,'address',true);
	$payment_responce = maybe_unserialize($transaction->payment_responce);
	$netAmt = $payment_responce['payment_gross'] - $payment_responce['tax'];

	$my_current_lang = apply_filters( 'wpml_current_language', NULL );

	// $adminTemp = get_post(2221);
	// $postID = icl_object_id(2221,'post',false,ICL_LANGUAGE_CODE);
	$adminTemp = get_post($email_templ_id);

	$emailPaymentTemp = str_replace('{subject}', $adminTemp->post_title, $adminTemp->post_content); 
	$emailPaymentTemp = str_replace('{name}', $user_displayname, $emailPaymentTemp); 
	$emailPaymentTemp = str_replace('{payment_date}', $current_date, $emailPaymentTemp); 
	$emailPaymentTemp = str_replace('{transaction_id}', $transaction->txn_id, $emailPaymentTemp); 
	$emailPaymentTemp = str_replace('{payment_status}', $status, $emailPaymentTemp); 
	$emailPaymentTemp = str_replace('{paypal_id}', $transaction->payer_email, $emailPaymentTemp); 
	$emailPaymentTemp = str_replace('{net_amount}', $netAmt, $emailPaymentTemp); 
	$emailPaymentTemp = str_replace('{vat}', $payment_responce['tax'], $emailPaymentTemp); 
	$emailPaymentTemp = str_replace('{total_amount}', $payment_responce['payment_gross'], $emailPaymentTemp);


	  
    $updateSql1 = "UPDATE " . $table_name ." SET payment_status = '$status', updated_date = NOW() WHERE payment_by_userid = '$owner_id' AND id='$id' AND txn_id = '$tax_id'";
    $update_res1 = $wpdb->query($updateSql1);
    
    $updateSql2 = "UPDATE " . $table_name_update ." SET Payment_Status = '$status', Updated_DateTime = NOW() WHERE UserID = '$owner_id' and ID='$invoice_id'";
    $update_res2 = $wpdb->query($updateSql2);
	if( $updateSql1 && $updateSql2 ){

	/*	ob_start();	    
		require_once( get_parent_theme_file_path( '/payment/emails/admin-payment-email.php' ) );
		$emailsPayment = ob_get_contents();
		ob_end_clean();
		$emailsPayment;*/

	    // $to = 't2i@getnada.com';
	    $to = $user_email;
	    $subject = $adminTemp->post_title.' : Transaction ID :'.$txn_id;
	    $admin_email = get_option( 'admin_email' );
	    // $sender    = get_bloginfo( 'name' );
	    $sender    = $admin_email;
	    $message   = $emailsReminder;
	    $headers[] = 'MIME-Version: 1.0' . "\r\n";
	    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	    $headers[] = "X-Mailer: PHP \r\n";
	    $headers[] = 'From: T2i < '.$admin_email.'>' . "\r\n";
	    // $mailBody= "Subject: $subjects \nMessage: Payment Confirmation ";
	    // $mail = wp_mail($to, $subject, $emailsReminder, $headers);
	    $mail = wp_mail($to, $subject, $emailPaymentTemp, $headers);	                    

	    if($mail){
	    	$response['status'] = true; 
	    }else{
	    	$response['status'] = false;
	    }
	}
	wp_send_json_success($response);
	wp_die();	    
}
 		
/*
function getTwitterShares($shareUrl){
	$socialCounts = array();
	$twitterShareCount = 0;
    $api = file_get_contents( 'https://cdn.api.twitter.com/1/urls/count.json?url=' . $shareUrl );
    $count = json_decode( $api );
    if(isset($count->count) && $count->count != '0'){
        $twitterShareCount = $count->count;
    }
    $socialCounts['twittershares'] = $twitterShareCount;
    // print_r( $socialCounts);
    return $twitterShareCount;
}*/
/*
add_action('wp_head','twitter_share_count');
function twitter_share_count(){
	
	if($_GET['tweet-response']){
		// date_default_timezone_set('Asia/Calcutta');
		global  $wpdb, $post;
		$table_name = $wpdb->prefix . "share_asset";

		$obj= new UserReports();
		$current_user = wp_get_current_user();

		$template = wp_get_post_terms($post->ID,'asset-detail');
		// $cat_id = wp_get_post_categories($post->ID);
		$category_id = $post->post_category[0];
		$template_id = $template[0]->term_id;

		// echo "category_id: ".$category_id;
		// echo "cat_id: ".$cat_id[0];
		// echo "template_id: ".$template_id;

		$subs_id = CheckPlanAssetsViewPost($template_id);
		$shares_cost = $obj->get_current_subscription_data($subs_id, 'shares');
		$share_date = date('Y-m-d');
		$insertSQL = "INSERT INTO " . $table_name . " SET post_id ={$post->ID}, user_id ={$current_user->ID}, template_id={$template_id},category_id={$category_id},share_price={$shares_cost}, date='$share_date', share_type='TW'";
		$results = $wpdb->query($insertSQL);

	       
		// global $post;
	 //       $log =  "twitter-REQUEST: ".print_r($_REQUEST).
	 //       "GET THE ID: ".$post->ID.
	 //        "-------------------------".PHP_EOL;
	//Save string to log, use FILE_APPEND to append.
	// file_put_contents('tw_'.date("j.n.Y").'.log', $log, FILE_APPEND);
	$log =  "Twitter Shared On :  ".PHP_EOL;

	file_put_contents('tw_'.date("d.m.Y").'.log', $log, FILE_APPEND);
	}
}*/


function t2i_add_cron_recurrence_interval( $schedules ) { 	
    $schedules['every_three_minutes'] = array(
            // 'interval'  => 180,
            'interval'  => 1*60,
            'display'   => __( 'Every 1 Minutes', 't2i' )
    );
     
    return $schedules;
}
add_filter( 'cron_schedules', 't2i_add_cron_recurrence_interval' );

wp_schedule_event( time(), 'every_three_minutes', 't2i_five_minut_cron_event_hook' );

if ( ! wp_next_scheduled( 't2i_five_minut_cron_event_hook' ) ) {
    wp_schedule_event( time(), 'every_three_minutes', 't2i_five_minut_cron_event_hook' );
}

add_action('t2i_five_minut_cron_event_hook', 't2i_reminder_cron_job_send_mail');
 
function t2i_reminder_cron_job_send_mail() {
	global  $current_user, $wpdb;
	$current_user = wp_get_current_user();
	$table_name = $wpdb->prefix . "remainder";

	date_default_timezone_set('Asia/Kolkata');

    $table_name = $wpdb->prefix . "remainder";
    $sql = "SELECT * FROM $table_name";
    $reminders = $wpdb->get_results($sql);

    $to = 't2i@getnada.com';
    $subject = 'Test my 1-minute cron by using crontab -e';
    $message = 'If you received this message, it means that your 3-minute cron job has worked! <img draggable="false" class="emoji" alt="🙂" src="https://s.w.org/images/core/emoji/12.0.0-1/svg/1f642.svg"> ';
    foreach ($reminders as $key => $reminder) {
    	
    	$stdate 			= $reminder->stardate;
    	$days_text 			= $reminder->days;
    	$st_date 			= $reminder->stardate;
       	$end_date 			= $reminder->enddate;
       	$current_cron_date 	= date('Y-m-d', strtotime($reminder->next_cron_date) );
       	$last_cron_date 	= $current_cron_date;
       	$cron_time 			= date( "H:i", strtotime($reminder->cron_time) );

       	$date1 = date_create($st_date);
       	$date2 = date_create($end_date);
       //difference between two dates
       	$diff = date_diff($date1,$date2);
       	$d = $diff->format("%a");

     //Our YYYY-MM-DD date string.
        // $selectedDate = "2019-06-24 15:49";
        // $selectedDate = "2019-05-23";
        
        $selectedDate = $last_cron_date;
        $cronTime = $cron_time;
         
        //Convert the date string into a unix timestamp.
        $unixTimestamp = strtotime($selectedDate);
         
        //Get the day of the week using PHP's date function.
        $cronDayName = date("l", $unixTimestamp); // cronDayName meand  "Sunday, Monday etc"
         
        //Print out the day that our date fell on.
        // echo $selectedDate . ' fell on a ' . $cronDayName.'<br>';
        $post_id = icl_object_id($reminder->post_id,'post',false,ICL_LANGUAGE_CODE);
     //    echo "post_id: ".$reminder->post_id;
    	// // dd($reminder);
    	// echo "curTime".$curTime = date( "H:i");
     //    echo "current_cron_date".$current_cron_date;
     //    echo "cron_time".$cron_time;
     //    echo "post_id".$post_id;
    	if( 'publish' === get_post_status( $post_id ) && date('Y-m-d') == $current_cron_date && $curTime >= $cron_time ){
    	// if( 'publish' === get_post_status( $reminder->post_id ) && date('Y-m-d') == '2019-05-28' && $curTime >= '16:45' ){
    		// $mail = wp_mail( 't2i@getnada.com', "Reminder Testing", "Remnder Test Message" );
    		 
	        if( $days_text=='daily' ){
	          $cronDate = $cronDateDaily = date('Y-m-d', strtotime('+1 day', strtotime($selectedDate))); // Cron date daily
	        }
	        else if( $days_text=='weekly' ){
	          $cronDate = $cronDateWeek = date('Y-m-d', strtotime('next '.$cronDayName, strtotime($selectedDate))); // Cron date every week
	        }
	        else if( $days_text=='monthly' ){
	          $cronDate = $cronDateMonth = date('Y-m-d', strtotime('+1 month', strtotime($selectedDate))); // Cron date every month
	        }
	        else if( $days_text=='quarterly' ){
	          $cronDate = $cronDateQuarterly = date('Y-m-d', strtotime('+3 month', strtotime($selectedDate))); // Cron date every quarterly
	        }
	        else if( $days_text=='yearly' ){
	          $cronDate = $cronDateYaer = date('Y-m-d', strtotime('+1 year', strtotime($selectedDate))); // Cron date every year 
	        }else{
	          $cronDate = $selectedDate; // Cron date only once 
	        }
	       	// $curTime = date( "H:i");
			// echo "<br>Previous Monday:". date('Y-m-d', strtotime('previous thursday', strtotime($currentDate)));
    		   
			$current_user = wp_get_current_user();
			// print_r($current_user);
			$table_name = $wpdb->prefix . "remainder";
			$user_id = $reminder->user_id;
			$post_id = $post_id;
			$item = $wpdb->get_row("SELECT * FROM $table_name where user_id='$user_id' and post_id = '$post_id'");
			$assertInfo = get_post($post_id);
			$business_name = get_field('business_name',$item->post_id);
			$ImageUrl = wp_get_attachment_image_src( get_post_thumbnail_id( $item->post_id ), 'full');
			$user 	= get_user_by('id', $user_id);
			$lanCode = ICL_LANGUAGE_CODE;
			if($lanCode=='en'){
			   $subjectReminder ="T2I - You asked us to remind on an Asset";
			   $Title ="Title";
			   $DateTime ="Date & Time";
			   $Message ="Message";
			   $delete ="delete";
			   $sorry ="Sorry there is no assert in reminder List!.";
			   $edit ="edit";
			}
			else
			{
			$subjectReminder ="T2I - You asked us to remind on an Asset";
			$Title ="Titel";
			$DateTime ="Terminzeit";
			$Message ="Botschaft";
			$delete ="löschen";
			$sorry ="Entschuldigung, es gibt keine Bestätigung in der Erinnerungsliste !.";
			$edit ="bearbeiten";
			}
	        $emailsReminder = '';
	      /*  $logo = 'http://d3.iworklab.com/t2iwp1/wp-content/uploads/2018/01/kai_logo.png';
	        $emailsReminder = '<table class="body-wrap" style="width:97% !important;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;">
	          <tbody><tr>
	            <td class="container" style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;">
	              <!-- Message start -->
	              <table style="width:100% !important;border-collapse:collapse;">
	                <tbody>         
	                <tr>
	                  <td class="masthead" style="padding-top:80px;padding-bottom:80px;padding-right:0;padding-left:0;background-color:#2a333b;background-image:url('.esc_html($logo).');background-repeat:no-repeat;background-position:center 15px;background-attachment:scroll;color:white;border-radius:10px 10px 0 0;" align="center">
	                    <h1 style="line-height:1.25;font-size:32px;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:90%;color: #fff;">'. esc_html($subjectReminder).'</h1>
	                  </td>
	                </tr>
	                <tr>
	                  <td class="content" style="background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:20px;padding-left:20px;">
	                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">'.esc_html("Dear").', '.esc_html( $user->display_name).'</p>
	                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">'.esc_html("this email reminds you on an asset within the T2I system").'<a href="'.network_home_url( '/' ).'" style="color:#324bd2; text-decoration:underline;" target="_blank"> '.esc_html("(www.thing2inter.net)").'</a></p>
	                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">
	                    <div class="col-xs-6" style="width: 100%">
	                            <div class="flex_box" style="margin-bottom: 50px; width: 100%;">
	                               <img class="img-responsive" src="'.esc_html($ImageUrl['0']).'" alt="" style="width: 200px; height: 200px;float: left; margin-right: 10px;">
	                                <div class="image-text" style="width: 94%;">
	                                    <p style="font-weight: 600;">'.esc_html($business_name).'</p>
	                                </div>
	                                <div class="list-box-description" style="padding: 10px;">
	                                    <div class="list-unstyled ">                                        
	                                         <div>
	                                            <span style="font-weight: 600; font-size: 12px;">'.esc_html($Title).' :</span>
	                                            <span>'.esc_html(get_the_title($item->post_id)).'</span>
	                                        </div>
	                                        <div>
	                                            <span style="font-weight: 600; font-size: 12px;">'.esc_html($DateTime).' :</span>
	                                            <span>'.esc_html(date('m/d/Y h:i:s', strtotime($item->stardate))).'</span>
	                                        </div>
	                                        <div>
	                                            <span style="font-weight: 600; font-size: 12px;">'.esc_html($Message).' :</span>
	                                            <span>'.esc_html($item->Message).'</span>
	                                        </div>
	                                        <div>
	                                            <span style="font-weight: 600; font-size: 12px;">'.esc_html("View Asset").' :</span>
	                                            <span><a href="'.get_permalink( $post_id ).'" style="color:#324bd2; text-decoration:underline;" target="_blank"> '.esc_html("Click Here").'</a></span>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                        </div>
	                        </p>

	                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;float: left; width: 100%;"">'.esc_html("Please feel free to create your first own thing in the internet!  Start now at  www.thing2inter.net").'</a></p>
	                     <p style="font-size:14px;font-weight:normal;margin-bottom:10px; float: left; width: 100%;">'.esc_html("Sincerly yours").'</p>
	                    <p style="font-size:14px;font-weight:normal;margin-bottom:10px; float: left; width: 100%;">'.esc_html("T2I Team ").'</p>
	                    <p style="font-size:14px;font-weight:normal;margin-bottom:10px; float: left; width: 100%;"><a href="'.network_home_url( '/' ).'" style="color:#324bd2; text-decoration:underline;" target="_blank"> '.esc_html("(www.thing2inter.net)").'</a></p>
	                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"></p>
	                  </td>
	                </tr>
	              </tbody></table>
	              <!-- body end -->
	            </td>
	          </tr> 
	          </tbody>
	        </table>';*/

	        $remnderData = ' <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">
	                    <div class="col-xs-6" style="width: 100%">
	                            <div class="flex_box" style="margin-bottom: 50px; width: 100%;">
	                               <img class="img-responsive" src="'.esc_html($ImageUrl['0']).'" alt="" style="width: 200px; height: 200px;float: left; margin-right: 10px;">
	                                <div class="image-text" style="width: 94%;">
	                                    <p style="font-weight: 600;">'.esc_html($business_name).'</p>
	                                </div>
	                                <div class="list-box-description" style="padding: 10px;">
	                                    <div class="list-unstyled ">                                        
	                                         <div>
	                                            <span style="font-weight: 600; font-size: 12px;">'.esc_html($Title).' :</span>
	                                            <span>'.esc_html(get_the_title($item->post_id)).'</span>
	                                        </div>
	                                        <div>
	                                            <span style="font-weight: 600; font-size: 12px;">'.esc_html($DateTime).' :</span>
	                                            <span>'.esc_html(date('m/d/Y h:i:s', strtotime($item->stardate))).'</span>
	                                        </div>
	                                        <div>
	                                            <span style="font-weight: 600; font-size: 12px;">'.esc_html($Message).' :</span>
	                                            <span>'.esc_html($item->Message).'</span>
	                                        </div>
	                                        <div>
	                                            <span style="font-weight: 600; font-size: 12px;">'.esc_html("View Asset").' :</span>
	                                            <span><a href="'.get_permalink( $post_id ).'" style="color:#324bd2; text-decoration:underline;" target="_blank"> '.esc_html("Click Here").'</a></span>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                        </div>
	                        </p>';
	        $reg_email_templ = icl_object_id(2261,'post',false,ICL_LANGUAGE_CODE);
		    $reminderTempl = get_post($reg_email_templ);
		    $emailReminderTempl = str_replace('{subject}', $reminderTempl->post_title, $reminderTempl->post_content); 
		    $emailReminderTempl = str_replace('{name}', $user->display_name, $emailReminderTempl); 
		    $emailReminderTempl = str_replace('{reminder}', $remnderData, $emailReminderTempl); 

	        // $to = 't2i@getnada.com';
        	
	        $to 			= $user->user_email;
	        $subject  		= $reminderTempl->post_title;
	        // $subjects   	= $subjectReminder;
	        $admin_email	= get_option( 'admin_email' );
	        $sender    		= get_bloginfo( 'name' );
	        $message   		= $subjectReminder;
	        $headers[] 		= 'MIME-Version: 1.0' . "\r\n";
	        $headers[] 		= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	        $headers[] 		= "X-Mailer: PHP \r\n";
	        $headers[] 		= 'From: '.$sender.' < '.$admin_email.'>' . "\r\n";
	        // $mailBody 		= "Subject: $subjects \nMessage: $message ";
	        $mail 			= wp_mail($to, $subject, $emailReminderTempl, $headers);
	        // $mail = true;
    		// echo "Cron run<br>";
    		// echo $last_cron_date."<br>"; 
    		// echo $cronDate."<br>"; 
  			if( $mail ){
	    		$updateSql = "UPDATE " . $table_name ." set next_cron_date='$cronDate', last_cron_date='$last_cron_date' where id = '$item->id'";
	  			// $updatCron = $wpdb->query($updateSql);
  			}
    	}else{
    		echo "<br>post_id: ".$reminder->post_id;
    	// dd($reminder);
	    	echo "<br>curTime".$curTime = date( "H:i");
	        echo "<br>current_cron_date".$current_cron_date;
	        echo "<br>cron_time".$cron_time;
	        echo "<br>post_id".$post_id;
    		echo "<br>Cron not run<br>";
    		echo $last_cron_date."<br>"; 
    		echo $cronDate."<br>";
    		exit;
    	}
    }
}

 

/*$currentDate = date('Y-m-d');

//Our YYYY-MM-DD date string.
// $selectedDate = "2019-06-24 15:49";
$selectedDate = "2019-05-23";
 
//Convert the date string into a unix timestamp.
$unixTimestamp = strtotime($selectedDate);
 
//Get the day of the week using PHP's date function.
$cronDayName = date("l", $unixTimestamp); // cronDayName meand  "Sunday, Monday etc"
 
//Print out the day that our date fell on.
echo $selectedDate . ', fell on a ' . $cronDayName.'<br>';

echo '<br> Day Name'.$cronDayName.', Daily: '.$cronDateDailyy = date('Y-m-d', strtotime('+1 day', strtotime($selectedDate))); // Cron date daily

echo '<br> Day Name'.$cronDayName.', Week: '.$cronDateWeek = date('Y-m-d', strtotime('next thursday', strtotime($selectedDate))); // Cron date every week

echo '<br> Day Name'.$cronDayName.', Month: '.$cronDateMonth = date('Y-m-d', strtotime('+1 month', strtotime($selectedDate))); // Cron date every month

echo '<br> Day Name'.$cronDayName.', Quarterly: '.$cronDateQuarterly = date('Y-m-d', strtotime('+3 month', strtotime($selectedDate))); // Cron date every quarterly

echo '<br> Day Name'.$cronDayName.', Yaer: '.$cronDateYaer = date('Y-m-d', strtotime('+1 year', strtotime($selectedDate))); // Cron date every year
*/

// $cronDate = $cronDateWeek;

// echo "<br>Cron Run On Next ".$cronDayName.", ".$cronDate.'<br>';
// echo "<br>Previous Monday:". date('Y-m-d', strtotime('previous thursday', strtotime($currentDate)));

	/*	ob_start();
        get_template_part( 'template-parts/emails/content', 'user-registration-email' );
        $emailsReminder = ob_get_contents();
        ob_end_clean();
        echo $emailsReminder;
        // $to = 't2i@getnada.com';
        // echo $emailsReminder;
        $to = $current_user->user_email;
        $subject  = 'T2I - You are now registered';
        $subjects   = 'T2I - You are now registered';
        $admin_email = get_option( 'admin_email' );
        $sender    = get_bloginfo( 'name' );
        // $message   = $_POST['message'];
        $headers[] = 'MIME-Version: 1.0' . "\r\n";
        $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers[] = "X-Mailer: PHP \r\n";
        $headers[] = 'From: '.$sender.' < '.$admin_email.'>' . "\r\n";
        $mailBody= "Subject: $subjects \nMessage: $message ";
   */

       /* global  $current_user, $wpdb;
		$current_user = wp_get_current_user();
		// print_r($current_user);
		$table_name = $wpdb->prefix . "remainder";
		$user_id = $current_user->ID;
		$post_id = 1560;
		$item = $wpdb->get_row("SELECT * FROM $table_name where user_id='76' and post_id = '$post_id'");
		$assertInfo = get_post($post_id);
		$business_name = get_field('business_name',$item->post_id);
		$ImageUrl = wp_get_attachment_image_src( get_post_thumbnail_id( $item->post_id ), 'full');
		$lanCode = ICL_LANGUAGE_CODE;
		if($lanCode=='en'){
		   $Reminder ="T2I - you asked us to remind on an Asset";
		   $Title ="Title";
		   $DateTime ="Date & Time";
		   $Message ="Message";
		   $delete ="delete";
		   $sorry ="Sorry there is no assert in reminder List!.";
		   $edit ="edit";
		}
		else
		{
		$Reminder ="T2I - you asked us to remind on an Asset";
		$Title ="Titel";
		$DateTime ="Terminzeit";
		$Message ="Botschaft";
		$delete ="löschen";
		$sorry ="Entschuldigung, es gibt keine Bestätigung in der Erinnerungsliste !.";
		$edit ="bearbeiten";
		}
        $emailsReminder = '';
        $logo = 'http://d3.iworklab.com/t2iwp1/wp-content/uploads/2018/01/kai_logo.png';
        echo $emailsReminder = '<table class="body-wrap" style="width:97% !important;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;">
          <tbody><tr>
            <td class="container" style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;">
              <!-- Message start -->
              <table style="width:100% !important;border-collapse:collapse;">
                <tbody>         
                <tr>
                  <td class="masthead" style="padding-top:80px;padding-bottom:80px;padding-right:0;padding-left:0;background-color:#2a333b;background-image:url('.esc_html($logo).');background-repeat:no-repeat;background-position:center 15px;background-attachment:scroll;color:white;border-radius:10px 10px 0 0;" align="center">
                    <h1 style="line-height:1.25;font-size:32px;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:90%;color: #fff;">'. esc_html($Reminder).'</h1>
                  </td>
                </tr>
                <tr>
                  <td class="content" style="background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:20px;padding-left:20px;">
                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">'.esc_html("Dear, ").','.esc_html("Kushal").'</p>
                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">'.esc_html("this email reminds you on an asset within the T2I system").'<a href="'.network_home_url( '/' ).'" style="color:#324bd2; text-decoration:underline;" target="_blank"> '.esc_html("(www.thing2inter.net)").'</a></p>
                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">
                    <div class="col-xs-6" style="width: 100%">
                            <div class="flex_box" style="margin-bottom: 50px; width: 100%;">
                               <img class="img-responsive" src="'.esc_html($ImageUrl['0']).'" alt="" style="width: 200px; height: 200px;">
                                <div class="image-text" style="width: 94%;">
                                    <p style="font-weight: 600;">'.esc_html($business_name).'</p>
                                </div>
                                <div class="list-box-description" style="padding: 10px;">
                                    <div class="list-unstyled ">                                        
                                         <div>
                                            <span style="font-weight: 600; font-size: 12px;">'.esc_html($Title).' :</span>
                                            <span>'.esc_html(get_the_title($item->post_id)).'</span>
                                        </div>
                                        <div>
                                            <span style="font-weight: 600; font-size: 12px;">'.esc_html($DateTime).' :</span>
                                            <span>'.esc_html(date('m/d/Y h:i:s', strtotime($item->stardate))).'</span>
                                        </div>
                                        <div>
                                            <span style="font-weight: 600; font-size: 12px;">'.esc_html($Message).' :</span>
                                            <span>'.esc_html($item->Message).'</span>
                                        </div>
                                        <div>
                                            <span style="font-weight: 600; font-size: 12px;">'.esc_html("View Asset").' :</span>
                                            <span><a href="'.get_permalink( $post_id ).'" style="color:#324bd2; text-decoration:underline;" target="_blank"> '.esc_html("Click Here").'</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        </p>

                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">'.esc_html("Please feel free to create your first own thing in the internet!  Start now at  www.thing2inter.net").'</a></p>
                     <p style="font-size:14px;font-weight:normal;margin-bottom:10px;">'.esc_html("Sincerly yours").'</p>
                    <p style="font-size:14px;font-weight:normal;margin-bottom:10px;">'.esc_html("Your T2I Team ").'</p>
                    <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><a href="'.network_home_url( '/' ).'" style="color:#324bd2; text-decoration:underline;" target="_blank"> '.esc_html("(www.thing2inter.net)").'</a></p>
                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"></p>
                  </td>
                </tr>
              </tbody></table>
              <!-- body end -->
            </td>
          </tr> 
          </tbody>
        </table>';*/
/* Password reset activation E-mail -> Body*/
add_filter( 'retrieve_password_message', 'dnlt_retrieve_password_message', 10, 2 );
 
function dnlt_retrieve_password_message( $message, $key ){
    $user_data = '';
    // If no value is posted, return false
    if( ! isset( $_POST['user_login'] )  ){
            return '';
    }
    // Fetch user information from user_login
    if ( strpos( $_POST['user_login'], '@' ) ) {
 
        $user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
    } else {
        $login = trim($_POST['user_login']);
        $user_data = get_user_by('login', $login);
    }
    if( ! $user_data  ){
        return '';
    }
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    /*$logo = 'http://d3.iworklab.com/t2iwp1/wp-content/uploads/2018/01/kai_logo.png';
			$site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
		        $message = '<table class="body-wrap" style="width:97% !important;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;">
		          <tbody><tr>
		            <td class="container" style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;">
		              <!-- Message start -->
		              <table style="width:100% !important;border-collapse:collapse;">
		                <tbody>         
		                <tr>
		                  <td class="masthead" style="padding-top:80px;padding-bottom:80px;padding-right:0;padding-left:0;background-color:#2a333b;background-image:url('.esc_html($logo).');background-repeat:no-repeat;background-position:center 15px;background-attachment:scroll;color:white;border-radius:10px 10px 0 0;" align="center">
		                    <h1 style="line-height:1.25;font-size:32px;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:90%;color: #fff;">'. esc_html("T2I - Password change").'</h1>
		                  </td>
		                </tr>
		                <tr>
		                  <td class="content" style="background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:10px;padding-left:20px;">
		                   <p style="font-size:14px;font-weight:normal;margin-bottom:10px;">'.esc_html("Dear").', '.esc_html($user_login).'</p>
		                    <p style="font-size:14px;font-weight:normal;margin-bottom:10px;">'.esc_html("You requested to select a new passsword at").'<a href="'.network_home_url( '/' ).'" style="color:#324bd2; text-decoration:underline;" target="_blank"> thing2inter.net.</a> </p>		                    
		                     <p style="font-size:14px;font-weight:normal;margin-bottom:10px;">';
							    // Setting up message for retrieve password
							    // $message .= "A password reset has been requested for this site:\n\n";
							    // $message .= network_home_url( '/' ) . "\r\n\r\n";
							    // $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";  						
							    // $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login')
							    $message .= '<p style="font-size:14px;font-weight:normal;margin-bottom:20px;"> <a href="'.network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login').'" style="color:#324bd2; text-decoration:underline;" target="_blank">'. esc_html("Click here").' </a>'.esc_html("to reset your password").'</p>';
							    $message .= "Please follow above the link , to change your new password.";

		                    $message .= '</p>  
		                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">'.esc_html("Please feel free to create your first own thing in the internet!  Start now at  www.thing2inter.net").'</a></p>
		                     <p style="font-size:14px;font-weight:normal;margin-bottom:10px;">'.esc_html("Yours Sincerly").'</p>
		                    <p style="font-size:14px;font-weight:normal;margin-bottom:10px;">'.esc_html("T2I Team ").'</p>
		                    <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><a href="'.network_home_url( '/' ).'" style="color:#324bd2; text-decoration:underline;" target="_blank">'.esc_html("(www.thing2inter.net)").'</a></p>
		                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"></p>
		                  </td>
		                </tr>
		              </tbody></table>
		              <!-- body end -->
		            </td>
		          </tr> 
		          </tbody>
		        </table>';*/

    $reset_password_link = '<a href="'.network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login').'" style="color:#324bd2; text-decoration:underline;" target="_blank">'. esc_html("Click here").' </a>';

    $reg_email_templ = icl_object_id(2256,'post',false,ICL_LANGUAGE_CODE);
    $regTempl = get_post($reg_email_templ);
    $emailRegTempl = str_replace('{subject}', $regTempl->post_title, $regTempl->post_content); 
    $emailRegTempl = str_replace('{name}', $user_login, $emailRegTempl); 
    $emailRegTempl = str_replace('{reset_password_link}', $reset_password_link, $emailRegTempl); 
    $emailRegTempl = str_replace('{user}', $user_login, $emailRegTempl); 
    return $emailRegTempl;
    // return $message;
}
		

// Our custom post type events function
function create_cpt_email_template() {

    register_post_type( 'cpt-email-template',
// CPT Options
        array(
            'labels' => array(
                'name' => __( 'Email Template' ),
                'singular_name' => __( 'Email Templates' )
                ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'cpt-email-template'),
            'supports'            => array( 'title', 'editor' ),
            )
        );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_cpt_email_template' );
// $adminTemp = get_post(2221);
// 	dd($adminTemp);
/*ob_start();
global $wpdb;
$table_name = $wpdb->prefix . "transaction_log";
	$current_date = date('Y-m-d');
	$sql = "SELECT * FROM $table_name where id = 1 AND txn_id='5L743832B01854222'";
	$transaction = $wpdb->get_row($sql);
	$invoice_id = $transaction->invoice_id;
	$owner_id = $transaction->payment_by_userid;
	$asset_user = get_userdata($owner_id);
	$user_displayname = $asset_user->user_firstname;
	$user_email = $asset_user->user_email;
	$address =  get_user_meta($owner_id,'address',true);
	$payment_responce = maybe_unserialize($transaction->payment_responce);
	$netAmt = $payment_responce['payment_gross'] - $payment_responce['tax'];

$temp = get_post(2221);
// using str_replace() function 
$resStr = str_replace('{subject}', 'Payment Confirmation Here', $temp->post_content); 
$resStr = str_replace('{name}', $user_displayname, $resStr); 
$resStr = str_replace('{payment_date}', $current_date, $resStr); 
$resStr = str_replace('{transaction_id}', $transaction->txn_id, $resStr); 
$resStr = str_replace('{payment_status}', $user_displayname, $resStr); 
$resStr = str_replace('{paypal_id}', $transaction->payer_email, $resStr); 
$resStr = str_replace('{net_amount}', $netAmt, $resStr); 
$resStr = str_replace('{vat}', $payment_responce['tax'], $resStr); 
$resStr = str_replace('{total_amount}', $payment_responce['payment_gross'], $resStr); 
  
print_r($resStr); */
/*ob_start();	    
require_once( get_parent_theme_file_path( '/payment/emails/admin-payment-email.php' ) );
$emailsPayment = ob_get_contents();
ob_end_clean();
echo $emailsPayment;
2221
*/
// echo $my_current_lang = apply_filters( 'wpml_current_language', NULL );
/*$postID = icl_object_id(2221,'post',false,ICL_LANGUAGE_CODE);

$adminTemp = get_post($postID);

dd($adminTemp);*/