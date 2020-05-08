<?php 
   /*
    * @Kaleshwar yadav
    * Its handle all ajax request
    */
class Ajax_request_handle {

     function __construct() {

       add_action( 'wp_ajax_ajaxlogin', array( $this, 'ajaxlogin' ));
       add_action( 'wp_ajax_nopriv_ajaxlogin', array( $this, 'ajaxlogin' ));
       add_action( 'wp_ajax_user_registration', array( $this, 'rs_user_registration_callback' ));
       add_action( 'wp_ajax_nopriv_user_registration', array( $this, 'rs_user_registration_callback' ));
       add_action( 'wp_ajax_profile_save', array( $this, 'profile_save_callback' ));
       add_action( 'wp_ajax_nopriv_profile_save', array( $this, 'profile_save_callback' ));

       add_action( 'wp_ajax_post_template', array( $this, 'post_template' ));
       add_action( 'wp_ajax_nopriv_post_template', array( $this, 'post_template' ));

       add_action( 'wp_ajax_technical_post_template', array( $this, 'technical_post_template' ));
       add_action( 'wp_ajax_nopriv_technical_post_template', array( $this, 'technical_post_template' ));

       add_action( 'wp_ajax_small_template', array( $this, 'small_template' ));
       add_action( 'wp_ajax_nopriv_small_template', array( $this, 'small_template' ));

       add_action( 'wp_ajax_publish_assert', array( $this, 'publish_assert' ));
       add_action( 'wp_ajax_nopriv_publish_assert', array( $this, 'publish_assert' ));

       add_action( 'wp_ajax_delete_assert', array( $this, 'delete_assert' ));
       add_action( 'wp_ajax_nopriv_delete_assert', array( $this, 'delete_assert' ));

       add_action( 'wp_ajax_plan_subscription', array( $this, 'plan_subscription' ));
       add_action( 'wp_ajax_nopriv_plan_subscription', array( $this, 'plan_subscription' ));

       add_action( 'wp_ajax_send_msg', array( $this, 'send_msg' ));
       add_action( 'wp_ajax_nopriv_send_msg', array( $this, 'send_msg' ));

       add_action( 'wp_ajax_edit_assets', array( $this, 'edit_assets' ));
       add_action( 'wp_ajax_nopriv_edit_assets', array( $this, 'edit_assets' ));

       add_action( 'wp_ajax_add_favorite', array( $this, 'add_favorite' ));
       add_action( 'wp_ajax_nopriv_add_favorite', array( $this, 'add_favorite' ));

       add_action( 'wp_ajax_unfavorite_like', array( $this, 'unfavorite_like' ));
       add_action( 'wp_ajax_nopriv_unfavorite_like', array( $this, 'unfavorite_like' ));

       add_action( 'wp_ajax_asset_favorite', array( $this, 'asset_favorite' ));
       add_action( 'wp_ajax_nopriv_asset_favorite', array( $this, 'asset_favorite' ));

       add_action( 'wp_ajax_asset_unfavorite', array( $this, 'asset_unfavorite' ));
       add_action( 'wp_ajax_nopriv_asset_unfavorite', array( $this, 'asset_unfavorite' ));

       add_action( 'wp_ajax_delete_favorite', array( $this, 'delete_favorite' ));
       add_action( 'wp_ajax_nopriv_delete_favorite', array( $this, 'delete_favorite' ));

       add_action( 'wp_ajax_assert_remainder', array( $this, 'assert_remainder' ));
       add_action( 'wp_ajax_nopriv_assert_remainder', array( $this, 'assert_remainder' ));

       add_action( 'wp_ajax_delete_reminder', array( $this, 'delete_reminder' ));
       add_action( 'wp_ajax_nopriv_delete_reminder', array( $this, 'delete_reminder' ));

       add_action( 'wp_ajax_share_assert_byemail', array( $this, 'share_assert_byemail' ));
       add_action( 'wp_ajax_nopriv_share_assert_byemail', array( $this, 'share_assert_byemail' ));

       add_action( 'wp_ajax_send_msg_to_owner', array( $this, 'send_msg_to_owner' ));
       add_action( 'wp_ajax_nopriv_send_msg_to_owner', array( $this, 'send_msg_to_owner' ));

       add_action( 'wp_ajax_update_reminder', array( $this, 'update_reminder' ));
       add_action( 'wp_ajax_nopriv_update_reminder', array( $this, 'update_reminder' ));

       add_action( 'wp_ajax_track_clickedLink', array( $this, 'track_clickedLink' ));
       add_action( 'wp_ajax_nopriv_track_clickedLink', array( $this, 'track_clickedLink' ));

       add_action( 'wp_ajax_accessLevel', array( $this, 'accessLevel' ));
       add_action( 'wp_ajax_nopriv_accessLevel', array( $this, 'accessLevel' ));

       add_action( 'wp_ajax_sendMessageToAssetOwner', array( $this, 'sendMessageToAssetOwner' ));
       add_action( 'wp_ajax_nopriv_sendMessageToAssetOwner', array( $this, 'sendMessageToAssetOwner' ));

       add_action( 'wp_ajax_download_asset', array( $this, 'download_asset' ));
       add_action( 'wp_ajax_nopriv_download_asset', array( $this, 'download_asset' ));

       add_action( 'wp_ajax_ads_per_template', array( $this, 'ads_per_template' ));
       add_action( 'wp_ajax_nopriv_ads_per_template', array( $this, 'ads_per_template' ));

       add_action( 'wp_ajax_report_per_template', array( $this, 'report_per_template' ));
       add_action( 'wp_ajax_report_per_template', array( $this, 'report_per_template' ));

       add_action( 'wp_ajax_generate_assets_data_report_month','generate_assets_data_report_month');
       add_action( 'wp_ajax_nopriv_generate_assets_data_report_month','generate_assets_data_report_month');

       add_action( 'wp_ajax_send_payment_reminder','send_payment_reminder');
       add_action( 'wp_ajax_nopriv_send_payment_reminder','send_payment_reminder');
     }

   /*
    * @Kaleshwar yadav
    * User Login function
    */
    function ajaxlogin() {
           session_start();
           $user = get_user_by('login',$_POST['username']);
           $active = get_user_meta($user->ID,'is_activated',true);
           $lanCode = ICL_LANGUAGE_CODE;
           if($lanCode=='en'){
            $validation_error = 'The Validation code does not match!';
            $not_active_error ='Sorry!, Your Account is not active,please check your inbox';
            $username_not_match = 'Sorry! Wrong username or password!';
            $login_success = 'Login successful, redirecting...';
           }
           else {
            $validation_error = 'Der Validierungscode stimmt nicht überein!';
            $not_active_error ='Sorry! Ihr Konto ist nicht aktiv. Bitte überprüfen Sie Ihren Posteingang';
            $username_not_match = 'Es tut uns leid! Benutzername oder Passwort falsch!';
            $login_success = 'Login erfolgreich, Weiterleitung ...';
           }
           if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){ 
            echo json_encode( array( 'loggedin'=>false, 'class'=>"msg_error", 'message'=>$validation_error));
           }
           else if($active=="no"){
            echo json_encode( array( 'loggedin'=>false, 'class'=>"msg_error", 'message'=>$not_active_error));
           }
           else {   
            $info = array();
            $info['user_login'] = $_POST['username'];
            $info['user_password'] = $_POST['password'];
            $info['remember'] = true;

            $user_signon = wp_signon( $info, false );
            wp_set_auth_cookie($user_signon->ID, true, false );
            if ( is_wp_error( $user_signon )) {
                echo json_encode( array( 'loggedin'=>false, 'class'=>"msg_error",  'message'=>$username_not_match));
            } else {
                echo json_encode( array( 'loggedin'=>true, 'class'=>"msg_status", 'message'=>$login_success));
            }
            }
            die();
            }
           /*
            * @Kaleshwar yadav
            * User registration function
            */
          function rs_user_registration_callback(){
           session_start();
           $error = '';
           $success = '';
           $nonce = $_POST['rs_user_registration_nonce'];
           if ( ! wp_verify_nonce( $nonce, 'rs_user_registration_action' ) )
           die ( '<p class="error">Security checked!, Cheatn huh?</p>' );
             $user_login = $_POST["username"]; 
             $user_email = $_POST["email"];
             $user_pass  = $_POST["user_password"];
             $pass_confirm = $_POST["user_confrm_password"];
             $lang_code = $_POST["lang_code"];
             
           if(username_exists($user_login)) {
              // invalid username
             $error = 'Invalid username.';
            }
           else if($user_login == '') {
              // empty username
                $error = 'Please enter a username.';
            }
            else if(!is_email($user_email)) {
              //invalid email
               $error = 'Invalid email.';
            }
            else if(email_exists($user_email)) {
              //Email address already registered
                 $error = 'Email already registered.';
            }
            else if($user_pass == '') {
              // passwords do not match
              $error = 'Please enter a password.';  
            }
            else if($user_pass != $pass_confirm) {
              // passwords do not match
                $error = 'Passwords do not match.'; 
           }
           else if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){ 
               $error = 'The Validation code does not match!'; 
              }

           else {
             $new_user_id = wp_insert_user(array(
              'user_login'    => $user_login,
              'user_pass'     => $user_pass,
              'user_email'    => $user_email,
              'role'=>'author',
              'user_registered' => date('Y-m-d H:i:s'),
            )
           );
           if( is_wp_error( $new_user_id ) ) {
            $error = $user_id->get_error_message();
            }
            else {
            if($new_user_id) {
              $code = sha1($new_user_id . time() );

              $activation_link = add_query_arg( array( 'key' => $code, 'userid' => $new_user_id ), get_permalink(156));
              update_user_meta($new_user_id, 'is_activated', 'no');
              $success = 1;
              $this->send_mail($user_email,$user_login,$user_pass,$activation_link, $lang_code);
              die;
           }
   
            }
         
           }

          if( ! empty( $error ) ){
            echo '<p class="error">'. $error .'</p>';
            die;
           }
          }
           /*
            * @Kaleshwar yadav
            * Send email activation mail to user
            */

          public function send_mail($email,$ursername,$password,$activation_link, $lang_code){
            if($lang_code=='en'){
             $subjectMessage ='T2I - You are now registered';
             $newUser ="New user register";
             $active_accountMsg ="You are successfully register,Click below link to active account";
             $clickHere ="Click here to activate account!";
            }
            else{
             $subjectMessage ='T2I - You are now registered<br>';
             $newUser ="Neuer Benutzer registrieren";
             $active_accountMsg ="Sie sind erfolgreich registriert. Klicken Sie unten auf den Link zum aktiven Konto";
             $clickHere ="Klicken Sie hier, um das Konto zu aktivieren!";

           }
          /*  $to = $email;
            $subject = $subjectMessage;
            $admin_email = get_option( 'admin_email' );
            $sender = get_bloginfo( 'name' );
            //$message = 'Your new password is: '.$random_password;
            $headers[] = 'MIME-Version: 1.0' . "\r\n";
            $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers[] = "X-Mailer: PHP \r\n";
            $headers[] = 'From: '.$sender.' < '.$admin_email.'>' . "\r\n";
            $message = '<!DOCTYPE html>
            <html>
            <head>
            <title>'.$newUser.'</title><br>
            </head>
            <body>
            <h3>Hi, </h3>
            <p>'.$active_accountMsg.'</p>
            <table>
            <tr>
                <td>User Id: </td>
                <td>'.$ursername.'</td>
            </tr>
            <tr>
                <td>Password: </td>
                <td>'.$password.'</td>
            </tr>
            <tr><td><a href="'.$activation_link.'" style="color:#324bd2; text-decoration:underline;" target="_blank">'.$clickHere.'</a></td></tr>
           </table>
            </body>
            </html>';
           $mail = wp_mail($to, $subject, $message, $headers);
           if($mail){
            echo $status = 1;
             die;
           }
*/

        /*ob_start();
        get_template_part( 'template-parts/emails/content', 'user-registration-email' );
        $emailsUserReg = ob_get_contents();
        ob_end_clean();*/

       /* $logo = 'http://d3.iworklab.com/t2iwp1/wp-content/uploads/2018/01/kai_logo.png';
        $emailsUserReg = '<table class="body-wrap" style="width:97% !important;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;">
          <tbody><tr>
            <td class="container" style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;">
              <!-- Message start -->
              <table style="width:100% !important;border-collapse:collapse;">
                <tbody>         
                <tr>
                  <td class="masthead" style="padding-top:80px;padding-bottom:80px;padding-right:0;padding-left:0;background-color:#2a333b;background-image:url('.esc_html($logo).');background-repeat:no-repeat;background-position:center 15px;background-attachment:scroll;color:white;border-radius:10px 10px 0 0;" align="center">
                    <h1 style="line-height:1.25;font-size:32px;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:90%;color: #fff;">'. esc_html("T2I - You are now registered").'</h1>
                  </td>
                </tr>
                <tr>
                  <td class="content" style="background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:20px;padding-left:20px;">
                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">'.esc_html("Dear").', '.esc_html($ursername).'</p>
                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">'.esc_html("We inform you about your successful registration on the T2I platform.  Congratulations!").'</p>
                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"> <a href="'.$activation_link.'" style="color:#324bd2; text-decoration:underline;" target="_blank">'. esc_html("Click here").' </a>'.esc_html("to activate account").'</p>
                     <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">
                        '.esc_html("User ID ").': '.esc_html($ursername).'<br>'
                        .esc_html("Password").': '.esc_html($password).'<br>
                      </p>  
                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">'.esc_html("Please feel free to create your first own thing in the internet!  Start now at  www.thing2inter.net").'</a></p>
                     <p style="font-size:14px;font-weight:normal;margin-bottom:10px;">'.esc_html("Yours Sincerly").'</p>
                    <p style="font-size:14px;font-weight:normal;margin-bottom:10px;">'.esc_html("Your T2I Team ").'</p>
                    <p style="font-size:14px;font-weight:normal;margin-bottom:10px;">'.esc_html("(www.thing2inter.net)").'</p>
                    <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"></p>
                  </td>
                </tr>
              </tbody></table>
              <!-- body end -->
            </td>
          </tr> 
          </tbody>
        </table>';*/

        $varify_link = '<a href="'.$activation_link.'" style="color:#324bd2; text-decoration:underline;" target="_blank">'. esc_html("Click here").' </a>';

        $reg_email_templ = icl_object_id(2247,'post',false,$lang_code);
        $regTempl = get_post($reg_email_templ);
        $emailRegTempl = str_replace('{subject}', $regTempl->post_title, $regTempl->post_content); 
        $emailRegTempl = str_replace('{name}', $ursername, $emailRegTempl); 
        $emailRegTempl = str_replace('{varify_link}', $varify_link, $emailRegTempl); 
        $emailRegTempl = str_replace('{user}', $ursername, $emailRegTempl); 
        $emailRegTempl = str_replace('{password}', $password, $emailRegTempl); 



        // $to = 't2i@getnada.com';
        // echo $emailsReminder;
        $to = $email;
        $subject  = $regTempl->post_title;
        // $subjects   = $subjectMessage;
        $admin_email = get_option( 'admin_email' );
        $sender    = get_bloginfo( 'name' );
        $message   = $active_accountMsg;
        $headers[] = 'MIME-Version: 1.0' . "\r\n";
        $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers[] = "X-Mailer: PHP \r\n";
        $headers[] = 'From: '.$sender.' < '.$admin_email.'>' . "\r\n";
        // $mailBody= "Subject: $subjects \nMessage: $message ";
        $mail = wp_mail($to, $subject, $emailRegTempl, $headers);
        if($mail){
           echo $status = 1;
        }else{
           echo $status = 0;
        }
            
       
    }
       /*
        * @Kaleshwar yadav
        * Save profile user data
        */
        public function profile_save_callback(){
         global  $current_user, $wpdb;
          $response = array();
          $lanCode = ICL_LANGUAGE_CODE;
          $table_name = $wpdb->prefix . "users";
          $nonce = $_POST['rs_user_profile_action_nonce'];
          if ( ! wp_verify_nonce( $nonce, 'rs_user_profile_action' ) )
            die ( '<p class="error">Security checked!, Cheatn huh?</p>' );
            $user_id = get_current_user_id();
            $date_now = date("Y-m-d"); // this format is string comparable
            $curdate = strtotime($date_now);
            $dob      = strtotime( $_POST['dob'] );
          if ($dob >= $curdate) {
              $response['status'] = 'error';
            if($lanCode=='en'){
              $response['message'] = "<strong>Error!</strong> DOB could not be current date or future date.";
            }else{
              $response['message'] = "<strong>Error!</strong> DOB kann kein aktuelles oder zukünftiges Datum sein.";
            }
          }else{
           update_user_meta($user_id,'first_name',$_POST['first_name']);
           update_user_meta($user_id,'dob',$_POST['dob']);
           update_user_meta($user_id,'email',$_POST['email']);
           update_user_meta($user_id,'gender',$_POST['gender']);
           update_user_meta($user_id,'company',$_POST['company']);
           update_user_meta($user_id,'mobilenum',$_POST['mobilenum']);
           update_user_meta($user_id,'user_type',$_POST['user_type']);
           update_user_meta($user_id,'comp_vat',$_POST['comp_vat']);
           update_user_meta($user_id,'address',$_POST['address']);
           update_user_meta($user_id,'location',$_POST['location']);

           update_user_meta($user_id,'alternateemail',$_POST['alternateemail']);
           $user_email = $_POST['email'];
           $updateSql = "UPDATE " . $table_name ." SET user_email ='$user_email' where ID = '$user_id'";
           $wpdb->query($updateSql);

           $img = $_FILES['profile_pic']['name'];
           $tmp = $_FILES['profile_pic']['tmp_name'];
           $this->upload_profile_image($img,$tmp);
           $lanCode = ICL_LANGUAGE_CODE;
            $response['status'] = 'success';
            if($lanCode=='en'){
              $response['message'] = "<strong>Thanks!</strong> Your profile has been successfully updated.";
            }else{
              $response['message'] = "<strong>Vielen Dank!</strong> Dein Profil wurde erfolgreich aktualisiert.";
            }
          }

          wp_send_json_success($response);
          wp_die();
        }

        public function upload_profile_image($img,$tmp){

            if(!empty($img)){
            // gives us access to the download_url() and wp_handle_sideload() functions
            require_once(ABSPATH . 'wp-admin/includes/file.php');

            $timeout_seconds = 5;
            // download file to temp dir
            $temp_file = $tmp;

            if (!is_wp_error( $temp_file )) {
              // array based on $_FILE as seen in PHP file uploads
              $file = array(
                'name' => basename($img), // ex: wp-header-logo.png
                'type' => 'image/png',
                'tmp_name' => $temp_file,
                'error' => 0,
                'size' => filesize($temp_file),
              );

              $overrides = array(
              // will be no form fields
              'test_form' => false,

              // setting this to false lets WordPress allow empty files, not recommended
              'test_size' => true,
               // There should be no reason to override this one.
              'test_upload' => true, 
                );

              // move the temporary file into the uploads directory
              $results = wp_handle_sideload( $file, $overrides );
              if($results){
              $user_id = get_current_user_id(); 
              update_user_meta($user_id,'user_picImage',$results['url']);
              }
              }
              }
              }

            /*
            * @Trilochan
            * Submit Template function
            */
            public function post_template(){

                global  $current_user, $wpdb;

                $table_name = $wpdb->prefix . "cloning_assert";
                $user_id = get_current_user_id();
                $obj= new UserReports();
                $featured_image_id = $_POST['featured_image_id'];
                $temp_title = $_POST['temp_title'];
                $temp_price = $_POST['temp_price'];
                $temp_description = $_POST['temp_description'];
                $post_image = $_POST['product_image_gallery'];
                $postimages = explode(',', $post_image);
                $imgdata    = maybe_serialize($postimages);
                $post_template = $_POST['template_value'];
                $assert_category = $_POST['category_name'];
                $category_id = $_POST['category_name'];
                $asset_name = $_POST['asset_name'];
                $asset_link = addhttp($_POST['asset_link']);
                $template=12;
                $business_name='IMAGE BUSINESS';
                $assert_clone_id = $_POST['assert_clone_id'];
                $template_id = $_POST['template_id']; 
                $subplan = $_POST['subplan'];
                $subs_id = CheckPlanforAsset($_POST['template_id'], $user_id );
                $clone_cost = $obj->get_current_subscription_data($subs_id, 'clones');
                $post_status_checked = isset($_POST['post_status_checked']);               
              if($post_status_checked=='on')
               {               
                $my_posts = array(
                  'post_title'    => wp_strip_all_tags( $_POST['temp_title'] ),
                  'post_content'  => $_POST['short_desc'],                  
                  'tax_input'     => array('asset-detail' => array($template),'category' => array($assert_category)),
                  'post_type'     => 'assets',
                  'post_status'   => 'publish',                  
                );
               }
               else{
                  $my_posts = array(
                  'post_title'    => wp_strip_all_tags( $_POST['temp_title'] ),
                  'post_content'  => $_POST['short_desc'],                  
                  'tax_input'     => array('asset-detail' => array($template),'category' => array($assert_category)),
                  'post_type'     => 'assets',
                  'post_status'   => 'draft',
                );
               }

                $date = date('Y-m-d');
                               
                // Insert the post into the database
                $insert_id = wp_insert_post($my_posts);

                update_post_meta($insert_id,'short_description',$_POST['temp_description']);
                update_post_meta($insert_id,'business_name',$business_name);
                update_post_meta($insert_id,'name',$asset_name);
                update_post_meta($insert_id,'asset_link',$asset_link);
                update_post_meta($insert_id,'subscription_plan_for_this_asset',$subplan);
                add_post_meta($insert_id,'plan_of_asset',$subplan);
                
                add_post_meta( $insert_id, 'price', $temp_price );
                if(!empty($featured_image_id)){
                add_post_meta( $insert_id, '_thumbnail_id', $featured_image_id );
                }
                add_post_meta( $insert_id, '_select_image', 'field_5a82adc4dbb8b' );
                add_post_meta( $insert_id, 'select_image', $imgdata );
                $lanCode = ICL_LANGUAGE_CODE;
                if($lanCode=='en'){
                 $assetMsg ='Assert created successfully';
                 $view_asset ='View Asset';
                }
                else{
                 $assetMsg ='Assert wurde erfolgreich erstellt';
                 $view_asset ='Asset anzeigen';
                }

                $this_permalink =  get_permalink($insert_id);
                if(!empty($_POST['cloning'])){
                  $insertSQL = "INSERT INTO " . $table_name . " SET user_id = '$user_id', post_id = '$insert_id', Template_name='$business_name', assert_clone_id ='$assert_clone_id',template_id='$template_id',date='$date',clone_cost='$clone_cost',category_id='$category_id'";
                 $results = $wpdb->query($insertSQL);
                }
                $post_status = get_post_status ( $insert_id );
                if($post_status=='publish')
                {
                echo json_encode( array( 'status'=>"Success", 'message'=>__( 'Assert created successfully.<a class="asset-view-detail-btn" href="'.$this_permalink.'">View Asset</a>'), 'redirect_permalink'=>$this_permalink ));
                  die(0);
                }else{
                echo json_encode( array( 'status'=>"Success", 'message'=>__( 'Assert created successfully.<a class="asset-view-detail-btn" href="'.$this_permalink.'">View Asset</a>'), 'redirect_permalink'=>$this_permalink ));
                  die(0);            
                }
                die(0);
                }

                /*
                * @kaleshwar
                * Submit Technical Template function
                */
                public function technical_post_template(){
              //      echo "<pre>";
              // print_r($_POST);
              // exit;
                global  $current_user, $wpdb;
                $table_name = $wpdb->prefix . "cloning_assert";
                $user_id = get_current_user_id();
                $obj= new UserReports();
                $assert_clone_id = $_POST['assert_clone_id'];
                $featured_image_id = $_POST['featured_image_id'];
                $temp_title = $_POST['temp_title'];
                $order_link = $_POST['order_link'];
                $temp_description = $_POST['short_desc'];
                $post_image = $_POST['product_image_gallery'];
                $postimages = explode(',', $post_image);
                $imgdata = maybe_serialize($postimages);
                $post_template=$_POST['template_value'];
                $assert_category = $_POST['category_name'];
                $category_id = $_POST['category_name'];
                $asset_name = $_POST['asset_name'];
                $asset_link = addhttp($_POST['asset_link']);
                $template=7;
                $business_name='ELECTRONIC BUSINESS';
                $assert_clone_id = $_POST['assert_clone_id'];
                $template_id = $_POST['template_id'];  
                $subplan = $_POST['subplan']; 
                $date = date('Y-m-d');
                $subs_id = CheckPlanforAsset($_POST['template_id'], $user_id );
                $clone_cost = $obj->get_current_subscription_data($subs_id, 'clones');

                $post_status_checked = isset($_POST['post_status_checked']);               
                if($post_status_checked=='on')
                {               
                $my_post = array(
                  'post_title'    => wp_strip_all_tags( $_POST['temp_title'] ),
                  'post_content'  => $_POST['short_desc'],                  
                  'tax_input'     => array('asset-detail' => array($template),'category' => array($assert_category)),
                  'post_type'     => 'assets',
                  'post_status'   => 'publish',
                );
               }
               else{
                  $my_post = array(
                  'post_title'    => wp_strip_all_tags( $_POST['temp_title'] ),
                  'post_content'  => $_POST['short_desc'],                  
                  'tax_input'     => array('asset-detail' => array($template),'category' => array($assert_category)),
                  'post_type'     => 'assets',
                  'post_status'   => 'draft',
                );
               }            
                // Insert the post into the database
                $insert_id = wp_insert_post( $my_post );

                update_post_meta($insert_id,'short_description',$_POST['temp_description']);
                update_post_meta($insert_id,'business_name',$business_name);
                update_post_meta($insert_id,'name',$asset_name);
                add_post_meta( $insert_id, 'link', $order_link );
                update_post_meta($insert_id,'asset_link',$asset_link);
                update_post_meta($insert_id,'subscription_plan_for_this_asset',$subplan);
                add_post_meta($insert_id,'plan_of_asset',$subplan);

                if(!empty($featured_image_id)){
                add_post_meta($insert_id, '_thumbnail_id', $featured_image_id);
                }
                add_post_meta( $insert_id, '_select_image', 'field_5a82adc4dbb8b' );
                add_post_meta( $insert_id, 'select_image', $imgdata );
                
                $this_permalink =  get_permalink($insert_id);
                $lanCode = ICL_LANGUAGE_CODE;
                if($lanCode=='en'){
                 $assetMsg ='Assert created successfully';
                 $view_asset ='View Asset';
                }
                else{
                 $assetMsg ='Assert wurde erfolgreich erstellt';
                 $view_asset ='Asset anzeigen';
                }
                if(!empty($_POST['cloning'])){
                  $insertSQL = "INSERT INTO " . $table_name . " SET user_id = '$user_id', post_id = '$insert_id', Template_name='$business_name', assert_clone_id ='$assert_clone_id',template_id='$template_id', date='$date', clone_cost='$clone_cost', category_id='$category_id'";
                  $results = $wpdb->query($insertSQL);
                  //$this_permalink =  get_permalink($insert_id);
                }
                echo json_encode( array( 'status'=>"Success", 'message'=>__( 'Assert created successfully.<a class="asset-view-detail-btn" href="'.$this_permalink.'">View Asset</a>'), 'redirect_permalink'=>$this_permalink ));
                  die(0);
                }

                /*
                * @kaleshwar
                * Submit small Template function
                */
                public function small_template(){

                global  $current_user, $wpdb;
                $table_name = $wpdb->prefix . "cloning_assert";
                $obj= new UserReports();
                $user_id = get_current_user_id();
                $assert_clone_id = $_POST['assert_clone_id'];
                $featured_image_id = $_POST['featured_image_id'];
                $temp_title = $_POST['temp_title'];
                $short_desc = $_POST['short_desc'];
                $post_image = $_POST['product_image_gallery'];
                $postimages = explode(',', $post_image);
                $imgdata = maybe_serialize($postimages);
                $post_template=$_POST['template_value'];
                $assert_category = $_POST['category_name'];
                $category_id = $_POST['category_name'];
                $asset_link = addhttp($_POST['asset_link']);
                $template=6;
                $asset_name = $_POST['asset_name'];
                $business_name='SMALL BUSINESS';
                $assert_clone_id = $_POST['assert_clone_id'];
                $template_id = $_POST['template_id'];
                $subplan = $_POST['subplan'];
                $subs_id = CheckPlanforAsset($_POST['template_id'], $user_id );
                
                $clone_cost = $obj->get_current_subscription_data($subs_id, 'clones');    
                               
               // Create post object
                $post_status_checked = isset($_POST['post_status_checked']);               
                if($post_status_checked=='on')
                {               
                $my_posts = array(
                  'post_title'    => wp_strip_all_tags( $_POST['temp_title'] ),
                  'post_content'  => $_POST['short_desc'],                  
                  'tax_input'     => array('asset-detail' => array($template),'category' => array($assert_category)),
                  'post_type'     => 'assets',
                  'post_status'   => 'publish',
                );
               }
               else{
                  $my_posts = array(
                  'post_title'    => wp_strip_all_tags( $_POST['temp_title'] ),
                  'post_content'  => $_POST['short_desc'],                  
                  'tax_input'     => array('asset-detail' => array($template),'category' => array($assert_category)),
                  'post_type'     => 'assets',
                  'post_status'   => 'draft',
                );
               }           

                $date = date('Y-m-d');
                // Insert the post into the database
                $insert_id = wp_insert_post($my_posts);

                update_post_meta($insert_id,'short_description',$_POST['short_desc']);
                update_post_meta($insert_id,'temp_description',$_POST['temp_description']);
                update_post_meta($insert_id,'description_business',$_POST['second_description']);
                
                update_post_meta($insert_id,'business_name',$business_name);
                update_post_meta($insert_id,'name',$asset_name);

                update_post_meta($insert_id,'asset_link',$asset_link);
                update_post_meta($insert_id,'subscription_plan_for_this_asset',$subplan);
                add_post_meta($insert_id,'plan_of_asset',$subplan);
                
                if(!empty($featured_image_id)){
                add_post_meta( $insert_id, '_thumbnail_id', $featured_image_id );
                }
                add_post_meta( $insert_id, '_select_image', 'field_5a82adc4dbb8b' );
                add_post_meta( $insert_id, 'select_image', $imgdata );
                $this_permalink =  get_permalink($insert_id);
                $lanCode = ICL_LANGUAGE_CODE;
                if($lanCode=='en'){
                 $assetMsg ='Assert created successfully';
                 $view_asset ='View Asset';
                }
                else{
                 $assetMsg ='Assert wurde erfolgreich erstellt';
                 $view_asset ='Asset anzeigen';
                }
                if(!empty($_POST['cloning'])){
                $insertSQL = "INSERT INTO " . $table_name . " SET user_id = '$user_id', post_id = '$insert_id', Template_name='$business_name', assert_clone_id ='$assert_clone_id',template_id='$template_id',date='$date',clone_cost='$clone_cost',category_id='$category_id'";
                $results = $wpdb->query($insertSQL);
                }
                echo json_encode( array( 'status'=>"Success", 'message'=>__('Assert created successfully.<a class="asset-view-detail-btn" href="'.$this_permalink.'">View Asset</a>'), 'redirect_permalink'=>$this_permalink ));
                   $img = $_FILES['downloadfile']['name'];
                   $tmp = $_FILES['downloadfile']['tmp_name'];
                   $this->download_attachment_image($img,$tmp,$insert_id);
                   die(0);
                }


          public function download_attachment_image($img,$tmp,$postid){

            if(!empty($img)){
            // gives us access to the download_url() and wp_handle_sideload() functions
            require_once(ABSPATH . 'wp-admin/includes/file.php');

            $timeout_seconds = 5;
            // download file to temp dir
            $temp_file = $tmp;

            if (!is_wp_error( $temp_file )) {
              // array based on $_FILE as seen in PHP file uploads
              $file = array(
                'name' => basename($img), // ex: wp-header-logo.png
                'type' => 'image/png',
                'tmp_name' => $temp_file,
                'error' => 0,
                'size' => filesize($temp_file),
              );

              $overrides = array(
              // will be no form fields
              'test_form' => false,

              // setting this to false lets WordPress allow empty files, not recommended
              'test_size' => true,
               // There should be no reason to override this one.
              'test_upload' => true, 
                );

              // move the temporary file into the uploads directory
              $results = wp_handle_sideload( $file, $overrides );
               $results['url'];
              if($results){
              update_post_meta($postid,'download_file',$results['url']);
              }
              }
              }
              }



                function publish_assert(){
                   $post = get_post($_POST['postID']);
                   if($post->post_status=='draft'){
                      $status ='publish';
                    }
                    else {
                     $status ='draft';  
                    }
                    $my_post = array(
                    'ID'           => $_POST['postID'],
                    'post_status'   => $status,
                    );
                    wp_update_post($my_post);
                    $response = array(
                      'current_status'  => $status,
                      'message'         => 'Status succesfully changed',
                      'ID'              => $post,
                  );
                  wp_send_json_success( $response );
                }

                function delete_assert(){
                   $status = wp_delete_post($_POST['postID']);
                   if($status){
                    echo"Deleted successfully";
                   }
                   die;
                }

            function plan_subscription(){
                // echo "<pre>";
                // print_r($_POST);
                // exit;
                global $current_user,$wpdb;
                $table_name = $wpdb->prefix . "subscription_plan";
                $username = $current_user->user_login;
                $email_id = $current_user->user_email;
                $user_id = get_current_user_id() ;
                $price = $_POST['price'];
                $plan_name = $_POST['plan_name'];
                $plan_id   =  $_POST['plan_id'];
                $template_name = $_POST['business_template'];
                $expiry = $_POST['choosen_plan'];
                // $date = strtotime("+$expiry day");
                $expiry_date = date('Y-m-d',$date);
                $template_id = $_POST['template_id'];
                $date = date('Y-m-d');
                $active = 1;
                $functionality = "Call, message, download, clone, reminder.";
                $lanCode = ICL_LANGUAGE_CODE;
                if($lanCode=='en'){
                 $PaymentDone ='Payment done successfully!.';
                 $Paymentfailed ='Payment failed!.';
                 $ourplan ='Your plan have upgraded successfully!.';
                }
                else{
                 $PaymentDone ='Zahlung erfolgreich abgeschlossen';
                 $Paymentfailed ='Bezahlung fehlgeschlagen!.';
                 $ourplan ='Ihr Plan wurde erfolgreich aktualisiert!.';
                }
                $user_exits = $wpdb->get_row("SELECT * FROM $table_name where user_id=$user_id AND template_id=$template_id");
                if($user_exits->user_id==$user_id){

                    $updateSql = "UPDATE " . $table_name ." SET Plan_name = '$plan_name', price = '$price',plan_id='$plan_id', Template='$template_name',plan_expire='$expiry_date', status='$active' WHERE user_id = '$user_id' AND template_id=$template_id";
                    $result = $wpdb->query($updateSql);
                    if($result){
                     echo json_encode( array( 'status'=>"Success", 'message'=>$ourplan));
                    }
                  }
                  else {
                    $insertSQL = "INSERT INTO " . $table_name . " SET Plan_name = '$plan_name', price = '$price', Template='$template_name', user_id ='$user_id', plan_id='$plan_id', plan_expire='expiry_date',template_id='$template_id',sub_date='$date',status='$active'";
                     $results = $wpdb->query($insertSQL);
                     if($results){
                      echo json_encode( array( 'status'=>"Success", 'message'=>$PaymentDone));
                      }
                     else {
                      echo json_encode( array( 'status'=>"Success", 'message'=>$Paymentfailed));
                      }
                      }
                die;
            }


          function send_msg_to_owner(){
            global  $current_user, $wpdb;
            $current_user = wp_get_current_user();


           $assetInfo =  get_post($_POST['postid']);
           $url = get_permalink($_POST['postid']);
           $assetDesc = $assetInfo->post_content;
           $receive_id =  trim($_POST['receive_id']);
           // $usertoowner = $_POST['usertoowner'];
           $usertoowner = $receive_id;
           $asset_ownername = $_POST['asset_ownername'];
           $post_id = $_POST['postid'];
           $u_name = $_POST['u_name'];
           $m_number = $_POST['m_number'];
           $assert_name  = $_POST['post_title'];
           $senderMail = $_POST['user_emailid'];
           $email = $_POST['email'];
           $sender_email = $_POST['sender'];
           $to = $_POST['email'];
           $template_id = $_POST['template_id'];
           $category_id = $_POST['category_id'];
           $business_tmp = get_field('business_name',$_POST['postid']);
           $ImageUrl = $_POST['gallery'];
           //$ImageUrl = wp_get_attachment_image_src( get_post_thumbnail_id($_POST['postid']), 'full');
           $subject = 'T2I - New user message on one of your Assets';
           $sender = $_POST['sender'];
           $msg = $_POST['message'];
           $address = $_POST['address'];
           $homeUrl = home_url();
           $site_logo = get_template_directory_uri()."/assets/images/kai_logo.png";

            $qr = new QR_BarCode();
            $asset_image = get_parent_theme_file_path()."/qrcode/images/qr-code.png";
            $asset_site_image_path = get_stylesheet_directory_uri()."/qrcode/images/qr-code.png";
            $urlasset = get_permalink($_POST['postid']);             
            $qr->url($urlasset); 
            $qr->qrCode(350,$asset_image);
           
           $headers[] = 'MIME-Version: 1.0' . "\r\n";
           $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
           $headers[] = "X-Mailer: PHP \r\n";
           $headers[] = 'From:< '.$to.'>' . "\r\n";
           $headers[] = 'Cc:< '.$sender.'>' . "\r\n";

           $lanCode = ICL_LANGUAGE_CODE;
           if($lanCode=='en'){
           $Yourmessage ='Your message successfully submitted. Thank you, I will get back to you soon!';
           $errorM = 'There was an error while submitting the form. Please try again later';
           $Sendermessage ="Sender of this massage";
           $MobileNo ='Mobile No';
           $EmailId ='Email Id';
           $Address ="Address";
           $Thankyou ="Thank you for using T2I, Your T2I team";
           $Openassetlink ="Open asset link";
           $clickviewasset ="Click below to view asset";
           $Description ="Description";
           $emailcomes ="This email comes from T2I. A potential customer opened your Asset and sent the following message on your asset ";
           }
           else {
           $Yourmessage ='Ihre Nachricht wurde erfolgreich übermittelt. Vielen Dank, ich werde mich bald bei Ihnen melden!';
           $errorM = 'Ihre Nachricht wurde erfolgreich übermittelt. Vielen Dank, ich werde mich bald bei Ihnen melden!...';
           $Sendermessage ="Absender dieser Massage";
           $MobileNo = "Mobile Nr";
           $EmailId ='E-Mail-ID';
           $Address ="Adresse";
           $Thankyou ="Vielen Dank, dass Sie T2I, Ihr T2I-Team, verwenden";
           $Openassetlink ="Asset-Link öffnen";
           $clickviewasset ="Klicken Sie unten, um das Asset anzuzeigen";
           $Description ="Beschreibung";
           $emailcomes ="Diese E-Mail stammt von T2I. Ein potenzieller Kunde hat Ihr Asset geöffnet und die folgende Nachricht an Ihr Asset gesendet ";


           }

          // message that will be displayed when everything is OK :)
          $okMessage = $Yourmessage;

          // If something goes wrong, we will display this message.
          $errorMessage = $errorM;

          // ReCaptch Secret
          $recaptchaSecret = '6LfjWXsUAAAAAG27sMjx5_3B-_GUCs38lYaO1TlB';

          // let's do the sending

          // if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
        error_reporting(E_ALL & ~E_NOTICE);

        try {
        if (!empty($_POST)) {

        // validate the ReCaptcha, if something is wrong, we throw an Exception,
        // i.e. code stops executing and goes to catch() block
        
        if (!isset($_POST['g-recaptcha-response'])) {
            throw new \Exception('ReCaptcha is not set.');
        }
        // do not forget to enter your secret key from https://www.google.com/recaptcha/admin        
        $recaptcha = new \ReCaptcha\ReCaptcha($recaptchaSecret, new \ReCaptcha\RequestMethod\CurlPost());        
        // we validate the ReCaptcha field together with the user's IP address
        
        $response = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);


        if (!$response->isSuccess()) {
            throw new \Exception('ReCaptcha was not validated.');
        }        
        // everything went well, we can compose the message, as usually
       /* $message = '<table  cellspacing="0" cellpadding="0" border="0"  style="margin:0 auto; width:100%; max-width:650px;" class="wrapper">
                <tr style="padding: 0;margin: 0;border: 0;">  
                    <td colspan="3" width="100%">
                        <table>
                              <tr style="padding: 15px; float: left; width: 100%; margin-bottom: 0px;">
                                <td style="margin-bottom: 25px;">Dear Petar/'.$asset_ownername.',</td>
                            </tr>
                            <tr style="padding: 15px; float: left; width: 100%;">
                                <td>
                                    '.$emailcomes.' „'.$assert_name.'“.
                                </td>
                            </tr>
                            <tr style="background-color:#fff2cc; padding: 15px; float: left; margin-bottom: 10px;">
                                <td width="50%">
                                    <u>Message:</u><br>'.$msg.'
                                </td>
                                
                            </tr>

                            <tr style="background-color:#f5f5f5;padding: 15px; float: left; margin-bottom: 25px">
                                <td  width="50%"><u>'.$sender.':('.$usertoowner.')</td>
                            </tr>
                            <tr style="padding: 0;margin: 0;border: 0;">
                                <td align="left" width="50%" style="vertical-align: top">
                                    
                                </td>
                            </tr>
                            <tr style="padding: 0px; float: left; width: 100%;">
                                <td style="padding: 0 15px; float: left; width: 100%;"><u>'.$Sendermessage.'</u></td>
                            </tr>
                            <tr>
                                <td>
                                    <table border="1" border-spacing="0" cellpadding="15" cellspacing="0" style="border-collapse:collapse;border-color: #171515;border: none; width:100%;">
                                        <tr style="background-color:#f5f5f5; border:0;">
                                            <td>Name</td><td>'.$u_name.'</td>
                                        </tr>
                                        <tr>
                                            <td>'.$MobileNo.'</td><td>'.$m_number.'</td>
                                        </tr>
                                        <tr style="background-color:#f5f5f5; border:0;">
                                            <td>'.$EmailId.'</td><td>'.$to.'</td>
                                        </tr>
                                        <tr>
                                            <td>'.$Address.'</td><td>'.$address.'</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr style="padding: 0 15px; float: left; width: 100%;">
                                <td style="padding: 0px; margin-top: 10px; float: left; width: 100%;"><u>Asset:</u></td>
                            </tr>
                            <tr>
                                <table>
                                    <tr>
                                        <td align="left" width="20%" style="vertical-align: top">
                                            <img src="'.$ImageUrl.'" style="max-width:100%;width:100%;">
                                        </td>
                                        <td style="background-color:#f5f5f5;">
                                            <u>Name:</u> '.$assert_name.'<br>
                                            <u>'.$Description.':</u> '.$assetDesc.'<br><br>
                                            <u><a href="'.get_permalink($_POST['postid']).'" target="_blank">'.$Openassetlink.'</a>
                                        </td>
                                        <td align="left" width="20%" style="vertical-align: top">
                                            <img src="'.$asset_site_image_path.'" style="max-width:100%;width:100%;">
                                        </td>
                                    </tr>
                                    
                                </table>
                                <tr style="background-color:#f5f5f5; padding: 20px; float: left;">
                                        <td>'.$Thankyou.'</td>
                                        
                                        <td style="width: 20%; text-align: right;">
                                            <img src="'.$site_logo.'" style="max-width:100%;width:50%; float: right;">
                                        </td>
                                    </tr>
                            </tr>
                            
                             <tr>
                                <td colspan="2" style="padding:20px 0px;text-align:center;"><a href="'.get_permalink($_POST['postid']).'" target="_blank" style="color:#1891d8;text-decoration:none;">'.$clickviewasset.'</a></td>
                            </tr> 
                        </table>
                    </td>
                </tr>
            </table>
            </body>
            </html>';

        //echo $message;

        //$mailSent = wp_mail($sender_email, $subject, $message, $headers);
        $mail = wp_mail($to, $subject, $message, $headers);*/

        		  /*  ob_start();
                // echo "Testing Email Body";
                get_template_part( 'template-parts/emails/content', 'owener-message-email' );
                $ownerMessage = ob_get_contents();
                ob_end_clean();*/

                $messageLink = '<p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><strong> See Message: </strong> <a href="'.network_home_url( '/private-message' ).'" style="color:#324bd2; text-decoration:underline;" target="_blank">'.$_POST['post_title'].'</a><p>';
                $owener_email_templ = $_POST['email_tpl_id'];
                $owenerTempl = get_post($owener_email_templ);
                $emailOwenerTempl = str_replace('{subject}', $owenerTempl->post_title, $owenerTempl->post_content); 
                $emailOwenerTempl = str_replace('{name}', $_POST['u_name'], $emailOwenerTempl); 
                $emailOwenerTempl = str_replace('{from}', $_POST['email'], $emailOwenerTempl); 
                $emailOwenerTempl = str_replace('{mobile_number}', $_POST['m_number'], $emailOwenerTempl); 
                $emailOwenerTempl = str_replace('{address}', $_POST['address'], $emailOwenerTempl); 
                $emailOwenerTempl = str_replace('{message}', $_POST['message'], $emailOwenerTempl); 
                $emailOwenerTempl = str_replace('{message_link}', $messageLink, $emailOwenerTempl); 

                // $to = 't2i@getnada.com';
                $to = 'wevo@getnada.com';
                $subject  = $owenerTempl->post_title;
                $admin_email = get_option( 'admin_email' );
                // $sender    = get_bloginfo( 'name' );
                $sender    = $_POST['email'];
                $headers[] = 'MIME-Version: 1.0' . "\r\n";
  		          $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  		          $headers[] = "X-Mailer: PHP \r\n";
  		          $headers[] = 'From: '.$to.' < '.$to.'>' . "\r\n";
		          // mail($to, $subjectMessage, $ownerMessage);
                // $mail = wp_mail($to, $subject, $emailsReminder, $headers);
                $mail = wp_mail($to, $subject, $emailOwenerTempl, $headers);

                /*if($mail){
                  wp_send_json( array( 'status'=>"Success", 'class'=>"status", 'message'=>$Thankyou));   
                }else{
                  wp_send_json(array( 'status'=>"Failed", 'class'=>"status", 'message'=>"Sorry, email not send!"));
                }*/

            if($mail){                
                 $table_name = $wpdb->prefix . "asset_message";
                 $user_id = $current_user->ID;
                  $obj = new UserReports();
                  // $subs_id = CheckPlanforAsset($_POST['template_id'], $user_id ); 
                  $subs_id = CheckPlanforAsset($_POST['template_id'], $receive_id ); 
                  $message_cost = $obj->get_current_subscription_data($subs_id, 'message_costs');
                 $insertSQL = "INSERT INTO " . $table_name . " SET post_id ='$post_id', user_id ='$user_id', message='$msg',Email='$email',asset_ownerid='$usertoowner',template_id='$template_id', category_id='$category_id', per_cost ='$message_cost', sender_email='$sender_email', message_name='$u_name', message_email='$senderMail', message_mobile_no='$m_number', message_address='$address'";
                 $results = $wpdb->query($insertSQL);
                 $responseArray = array('type' => 'success', 'message' => $okMessage);
             //die();
                }
              }
            } catch (\Exception $e) {
                $responseArray = array('type' => 'danger', 'message' => $e->getMessage());
            }

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $encoded = json_encode($responseArray);

                header('Content-Type: application/json');

                echo $encoded;
            } else {
                echo $responseArray['message'];
            }
            die(0);
            }



            function send_msg(){
              global $wpdb, $post, $current_user; 
              $current_user = wp_get_current_user();
                $lanCode = ICL_LANGUAGE_CODE;
                if($lanCode=='en'){
                  $subjectMessage ='T2I - Thank you for your feedback'; 
                  $Thankyou ='Thank you! Your message has been sent.';
                  $Sorrymail ='Sorry mail server is not configured.'; 
                }
                else 
                {
                  $subjectMessage ='T2I - Thank you for your feedback';
                  $Thankyou ='Vielen Dank! Ihre Nachricht wurde gesendet.'; 
                  $Sorrymail ='Der Mailserver ist leider nicht konfiguriert.';
                }
              
                $feedback_email_templ = $_POST['email_tpl_id'];
                $feedbackTempl = get_post($feedback_email_templ);
                $emailFeedbackTempl = str_replace('{subject}', $feedbackTempl->post_title, $feedbackTempl->post_content); 
                $emailFeedbackTempl = str_replace('{name}', 'User', $emailFeedbackTempl); 
                $emailFeedbackTempl = str_replace('{from}', $_POST['email'], $emailFeedbackTempl); 
                $emailFeedbackTempl = str_replace('{feedback_subject}', $_POST['subject'], $emailFeedbackTempl); 
                $emailFeedbackTempl = str_replace('{message}', $_POST['message'], $emailFeedbackTempl); 
                // $to = 't2i@getnada.com';
                // $to = 'wevo@getnada.com';
                $from = $_POST['email'];
                $subject  = $_POST['subject'];
                $admin_email = get_option( 'admin_email' );
                // $sender    = get_bloginfo( 'name' );
                $sender    = $_POST['email'];
                $headers[] = 'MIME-Version: 1.0' . "\r\n";
  		          $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  		          $headers[] = "X-Mailer: PHP \r\n";
  		          $headers[] = 'From: '.$sender.' < '.$from.'>' . "\r\n";
		          // mail($to, $subjectMessage, $emailsFeedback);
                // $mail = wp_mail($to, $subject, $emailFeedbackTempl, $headers);
                $mail = wp_mail($admin_email, $subject, $emailFeedbackTempl, $headers);

                if($mail){
                  wp_send_json( array( 'status'=>"Success", 'class'=>"status", 'message'=>$Thankyou));   
                }else{
                  wp_send_json(array( 'status'=>"Failed", 'class'=>"status", 'message'=>$Sorrymail));
                }
              // wp_die();
               
        }

        function edit_assets(){

               $featured_image_id = $_POST['featured_image_id'];
               $order_link = $_POST['order_link'];
               $temp_description = $_POST['short_desc'];
               $post_image = $_POST['product_image_gallery'];
               $postimages = explode(',', $post_image);
               $imgdata = maybe_serialize($postimages);
               $asset_name = $_POST['asset_name'];
               $price = $_POST['temp_price'];
               $downloadfile = $_POST['downloadfile'];
               $asset_link = $_POST['asset_link'];
               $post_category[] = $_POST['asset-cat'];
    
               $post_status_checked = isset($_POST['post_status_checked']);
               $lanCode = ICL_LANGUAGE_CODE;
                if($lanCode=='en'){
                    $sucess ='Asset info updated successfully!';
                    $wrong ='There is somthing wrong';
                }
                else 
                {
                    $sucess ='Asset-Info erfolgreich aktualisiert!';
                    $wrong ='Asset-Info erfolgreich aktualisiert!...';
                }

               if($post_status_checked=='on')
               {
                $my_posts = array(
                    'ID'           => $_POST['asset_id'],
                    'post_title'    => wp_strip_all_tags( $_POST['temp_title'] ),
                    'post_content'  => $_POST['short_desc'],
                    'post_status'   => 'publish',
                    );
               }
               else{
                  $my_posts = array(
                    'ID'           => $_POST['asset_id'],
                    'post_title'    => wp_strip_all_tags( $_POST['temp_title'] ),
                    'post_content'  => $_POST['short_desc'],
                    'post_status'   => 'draft',
                    );
               }               
               // Update the post into the database
               $update_id = wp_update_post( $my_posts );
               // print_r($_POST);
               // exit;

                if($update_id){
                
                update_post_meta($update_id,'short_description',$_POST['short_desc']);
                update_post_meta($update_id,'temp_description',$_POST['temp_description']);
                update_post_meta($update_id,'description_business',$_POST['second_description']);
                
                update_post_meta($update_id,'name',$asset_name);
                update_post_meta($update_id,'price',$price);
                update_post_meta($update_id,'downloadfile',$downloadfile);
                update_post_meta($update_id, 'link', $order_link );
                update_post_meta($update_id, 'asset_link', $asset_link );
                
                if(!empty($featured_image_id)){
                update_post_meta($update_id, '_thumbnail_id', $featured_image_id );   
                }
                update_post_meta($update_id, '_select_image', 'field_5a82adc4dbb8b' );
                update_post_meta($update_id, 'select_image', $imgdata );
                wp_set_post_categories($update_id, $post_category);
                echo $sucess;
               }
               else {
                echo $wrong;
               }

            die;
        }

        function add_favorite(){

           global  $current_user, $wpdb;
           $table_name = $wpdb->prefix . "favorite_asset";
           $user_id = get_current_user_id();

            $lanCode = ICL_LANGUAGE_CODE;
            if($lanCode=='en'){
              $UnFavorite ='Un-Favorite';
            }
            else 
            {
              $UnFavorite ='Favorit nicht';
            }

           $post_id = $_POST['favorit_id'];
           $template_id = $_POST['template_id'];
           $category_id = $_POST['category_id'];
           $status = 1;
           $date = date('Y-m-d');
           $obj= new UserReports();
           $subs_id = CheckPlanforAsset($_POST['template_id'], $user_id );
           $favorits_cost = $obj->get_current_subscription_data($subs_id, 'favorits'); 
           $favorite_list = $wpdb->get_row("SELECT * FROM $table_name where user_id='$user_id' and post_id = '$post_id'");
           if($favorite_list->post_id==$post_id){
            $updateSql = "UPDATE " . $table_name ." SET status = '1' WHERE user_id =$user_id and post_id = '$post_id',template_id='$template_id',date='$date',category_id='$category_id', per_cost='$favorits_cost'"; 
             $wpdb->query($updateSql);?>
                <a href="javascript:void(0);" onclick="unfavorite_like('<?php echo $post_id; ?>');">
                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_4.png" alt="">
                <p class='favorite'><?php echo $UnFavorite; ?></p>
               </a>
           <?php }
           else {
           if($favorite_list->post_id!=$post_id){
            $insertSQL = "INSERT INTO " . $table_name . " SET post_id ='$post_id', user_id ='$user_id', status='$status',template_id='$template_id',date='$date',category_id='$category_id', per_cost='$favorits_cost'";
            $results = $wpdb->query($insertSQL);
            if($results){?>
                <a href="javascript:void(0);" onclick="unfavorite_like('<?php echo $post_id; ?>');">
                <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_4.png" alt="">
                <p class='favorite'><?php echo $UnFavorite; ?></p>
               </a>
          <?php                
            } 
        }
     }
         die;
    }
        function unfavorite_like(){

           global  $current_user, $wpdb;
           $table_name = $wpdb->prefix . "favorite_asset";
           $user_id = get_current_user_id();
           $postid = $_POST['favorit_id'];
           $deletefavorite = "DELETE FROM " . $table_name . " WHERE post_id = ".$postid ." and user_id='$user_id'";
           $results = $wpdb->query($deletefavorite);
           $lanCode = ICL_LANGUAGE_CODE;
            if($lanCode=='en'){
              $favorite ='Add to favorite';
            }
            else 
            {
              $favorite ='Zu den Favoriten hinzufügen';
            }

           ?>
          <a  href="javascript:void(0);" onclick="favorite_like('<?php echo $post_id; ?>');">
          <img class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/activity_4.png" alt="">
          <p class='favorite'><?php echo $favorite; ?></p>
          </a>
        <?php   die;
        }

   function asset_favorite(){

           global  $current_user, $wpdb;
           $table_name = $wpdb->prefix . "favorite_asset";
           $user_id = get_current_user_id();
           $postid = $_POST['favorit_id'];
           $lanCode = ICL_LANGUAGE_CODE;
            if($lanCode=='en'){
              $UnFavorite ='Un-Favorite';
            }
            else 
            {
              $UnFavorite ='Favorit nicht';
            }
           $status = 1;
           $favorite_list = $wpdb->get_row("SELECT * FROM $table_name where user_id='$user_id' and post_id = '$postid'");
           if($favorite_list->post_id==$postid){
            $updateSql = "UPDATE " . $table_name ." SET status = '1' WHERE user_id =$user_id and post_id = '$postid'"; $wpdb->query($updateSql);?>
                <a href="javascript:void(0);" onclick="asset_unfavorite(this,'<?php echo $postid; ?>');" class="favorite un ajaxres"><span><i class="fa fa-star" aria-hidden="true"></i></span><?php echo $UnFavorite; ?></a>
           <?php }
           else {
           if($favorite_list->post_id!=$postid){
            $insertSQL = "INSERT INTO " . $table_name . " SET post_id ='$postid', user_id ='$user_id', status='$status'";
            $results = $wpdb->query($insertSQL);
            if($results){?>
                <a href="javascript:void(0);" onclick="asset_unfavorite(this,'<?php echo $postid; ?>');" class="favorite un ajaxres"><span><i class="fa fa-star" aria-hidden="true"></i></span><?php echo $UnFavorite; ?></a>
               
               </a>
          <?php                
            } 
        }
     }
         die;
    }

    function asset_unfavorite(){
       global  $current_user, $wpdb;
       $table_name = $wpdb->prefix . "favorite_asset";
       $user_id = get_current_user_id();
       $postid = $_POST['favorit_id'];
       $deletefavorite = "DELETE FROM " . $table_name . " WHERE post_id = ".$postid ." and user_id='$user_id'";
       $results = $wpdb->query($deletefavorite);
       die;
    }

    function delete_favorite(){
       global  $current_user, $wpdb;
       $table_name = $wpdb->prefix . "favorite_asset";
       $user_id = get_current_user_id();
       $postid = $_POST['favorit_id'];
       $deletefavorite = "DELETE FROM " . $table_name . " WHERE post_id = ".$postid ." and user_id='$user_id'";
       $results = $wpdb->query($deletefavorite);
       die;
    }

    function assert_remainder(){
       session_start();
       global  $current_user, $wpdb;
       $table_name = $wpdb->prefix . "remainder";

       $current_user = wp_get_current_user();
       $user_id = get_current_user_id();
       $post_id= $_POST['post_id'];
       $Msg = $_POST['message'];
       $stdate = $_POST['remainder_date'];
       $enddate = $_POST['remainder_date'];
       $days_text = $_POST['event-type'];
       $template_id = $_POST['template_id'];
       $category_id = $_POST['category_id'];
        $obj= new UserReports();
        $subs_id = CheckPlanforAsset($_POST['template_id'], $user_id );
        $reminder_cost = $obj->get_current_subscription_data($subs_id, 'reminder');
       $end_date = date('Y-m-d', strtotime($stdate));
       $st_date = date('Y-m-d');

       $date1 = date_create($st_date);
       $date2 = date_create($end_date);
       //difference between two dates
       $diff = date_diff($date1,$date2);
       $d = $diff->format("%a");

        if($_POST['event-type']=='daily'){
        $days = $d+1;
        }
        else if($_POST['event-type']=='weekly'){
        $days = $d+7;
        }
        else if($_POST['event-type']=='monthly'){
        $days = $d+30;
        }
        else if($_POST['event-type']=='quarterly'){
        $days = $d+4;
        }
        else if($_POST['event-type']=='yearly'){
        $days = $d+365;
        }else{
          $days = $d+0;
        }
        $date = date('Y-m-d');

        $expiry_date = date('Y-m-d', strtotime("+$days days"));

        $reminder = $wpdb->get_row("SELECT * FROM $table_name where user_id='$user_id' and post_id = '$post_id' and days='$days_text'");
 
      if(count($reminder)==0){

        //Our YYYY-MM-DD date string.
        // $selectedDate = "2019-06-24 15:49";
        // $selectedDate = "2019-05-23";
        $selectedDateTime = explode(" ", $stdate);
        $selectedDate = $selectedDateTime[0];
        $cronTime = $selectedDateTime[1];
         
        //Convert the date string into a unix timestamp.
        $unixTimestamp = strtotime($selectedDate);
         
        //Get the day of the week using PHP's date function.
        $cronDayName = date("l", $unixTimestamp); // cronDayName meand  "Sunday, Monday etc"
         
        //Print out the day that our date fell on.
        // echo $selectedDate . ' fell on a ' . $cronDayName.'<br>';

        if($_POST['event-type']=='daily'){
          $cronDate = $cronDateDaily = date('Y-m-d', strtotime('+1 day', strtotime($selectedDate))); // Cron date daily
        }
        else if($_POST['event-type']=='weekly'){
          $cronDate = $cronDateWeek = date('Y-m-d', strtotime('next thursday', strtotime($selectedDate))); // Cron date every week
        }
        else if($_POST['event-type']=='monthly'){
          $cronDate = $cronDateMonth = date('Y-m-d', strtotime('+1 month', strtotime($selectedDate))); // Cron date every month
        }
        else if($_POST['event-type']=='quarterly'){
          $cronDate = $cronDateQuarterly = date('Y-m-d', strtotime('+3 month', strtotime($selectedDate))); // Cron date every quarterly
        }
        else if($_POST['event-type']=='yearly'){
          $cronDate = $cronDateYaer = date('Y-m-d', strtotime('+1 year', strtotime($selectedDate))); // Cron date every year 
        }else{
          $cronDate = $selectedDate; // Cron date only once 
        }

         $insertSQL = "INSERT INTO " . $table_name . " SET post_id ='$post_id', user_id ='$user_id', Message='$Msg', stardate='$stdate', next_cron_date='$cronDate', cron_day='$cronDayName', cron_time='$cronTime', enddate='$enddate', expire_date='$expiry_date', days='$days_text',template_id='$template_id',date='$date',category_id='$category_id', per_cost='$reminder_cost'";
        $results = $wpdb->query($insertSQL);
        $lanCode = ICL_LANGUAGE_CODE;
        if($lanCode=='en'){
          $Thankyou ='Thank you! Your Reminder has been set.';
          $Sorry = 'Sorry! already you have set reminder for this assert.';
        }
        else 
        {
          $Thankyou ='Vielen Dank! Ihre Erinnerung wurde eingestellt.';
          $Sorry = 'Es tut uns leid! Sie haben bereits eine Erinnerung für diese Zusicherung festgelegt';
        }

       if($results){
          wp_send_json( array( 'status'=>"Success", 'class'=>"status", 'message'=>$Thankyou));   
        }
      }else {
           wp_send_json( array( 'status'=>"Failed", 'class'=>"error", 'message'=>$Sorry));  
      }

        die;
    }

    function delete_reminder(){
       global  $current_user, $wpdb;
       $table_name = $wpdb->prefix . "remainder";
       $user_id = get_current_user_id();
       $postid = $_POST['reminder_id'];
       $deletefavorite = "DELETE FROM " . $table_name . " WHERE id = ".$postid ." and user_id='$user_id'";
       $results = $wpdb->query($deletefavorite);
       die;
    }

    function share_assert_byemail(){

            global  $current_user, $wpdb;
            $table_name = $wpdb->prefix . "share_asset";
            $obj= new UserReports();
            $user_id = get_current_user_id();
            $assert_url = $_POST['assert_url'];
            $email_assert = $_POST['email_assert'];
            $msg_assert  = $_POST['msg_assert'];
            $postid = $_POST['post_id'];
            $template_id = $_POST['template_id'];
            $to = $email_assert;
            $subject = 'Thanks for sharing assert';
            $admin_email = get_option( 'admin_email' );
            $sender = get_bloginfo( 'name' );
            $share_date = date('Y-m-d');
            $category_id = $_POST['category_id'];
            // $ImageUrl = wp_get_attachment_image_src( get_post_thumbnail_id($_POST['post_id']), 'full');
            $ImageUrl = $_POST['gallery'];
            $short_des = get_field('short_description', $_POST['post_id'], true);
            $my_post_content = strip_tags($short_des);
            //print_r($ImageUrl);

            $subs_id = CheckPlanAssetsViewPost($_POST['template_id']);
            $shares_cost = $obj->get_current_subscription_data($subs_id, 'shares');

            $qr = new QR_BarCode();
            
            $imgId = $_POST['post_id'];
            $asset_image = get_parent_theme_file_path()."/qrcode/images/qr-code-{$imgId}.png";
            $asset_site_image_path = get_stylesheet_directory_uri()."/qrcode/images/qr-code-{$imgId}.png";

            if (!file_exists($asset_site_image_path)) {
                $urlasset = get_permalink($_POST['post_id']);             
                $qr->url($urlasset); 
                $qr->qrCode(350,$asset_image);
            }
            $attachments = array($asset_image);

            $logourl = site_url();

            $lanCode = ICL_LANGUAGE_CODE;
            if($lanCode=='en'){
              $emailcomes ="This email comes from T2I. A user has shared the following asset and message with you:";
              $Message ="Message"; 
              $Asset ="Asset"; 
              $Description ="Description";
              $Openassetlink = "Open asset link";
              $freeMsg="Feel free to check out the asset in more detail directly in our platform under the link above!<br><br>Your T2I Team";
              $Clickviewasset ="Click below to view asset";
            }
            else
            {
             $emailcomes ="Diese E-Mail stammt von T2I. Ein Benutzer hat das folgende Asset und die folgende Nachricht mit Ihnen geteilt:";
             $Message ="Botschaft";
             $Asset ="Asset"; 
             $Description ="Beschreibung";
             $Openassetlink = "Asset-Link öffnen";
             $freeMsg ="Fühlen Sie sich frei, um das Asset direkt in unserer Plattform unter dem Link oben genauer anzusehen! <br> <br> Ihr T2I-Team";
             $Clickviewasset ="Klicken Sie unten, um das Asset anzuzeigen";
            }
            
            $headers[] = 'MIME-Version: 1.0' . "\r\n";
            $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers[] = "X-Mailer: PHP \r\n";
            $headers[] = 'From: '.$sender.' < '.$admin_email.'>' . "\r\n";
            $message = '<!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
              <title>Mailer</title>
            </head>
            <body style="margin: 0px;padding: 0px;font-family: arial;">
             <table  cellspacing="0" cellpadding="0" border="0"  style="margin:0 auto; width:100%; max-width:650px;" class="wrapper">
                <tr style="padding: 0;margin: 0;border: 0;">  
                    <td colspan="3" width="100%">
                        <table width="100%">
                              <tr style="padding: 15px; margin-bottom: 0px;">
                                <td style="margin-bottom: 25px;">Dear Friend,</td>
                            </tr>
                            <tr style="padding: 15px;">
                                <td>
                                    '.$emailcomes.'
                                </td>
                            </tr>
                            <tr style="padding: 0;margin: 0;border: 0;">
                                <td align="left" width="50%" style="vertical-align: top">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr style="background-color:#fff2cc; padding: 15px; margin-bottom: 10px;">
                                <td>
                                    <u>'.$Message.':</u><br>'.$msg_assert.'
                                </td>
                                
                            </tr>
                            
                            <tr style="padding: 0;margin: 0;border: 0;">
                                <td align="left" width="50%" style="vertical-align: top">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px; margin-top: 10px;"><u>Asset:</u></td>
                            </tr>
                            <tr>
                                <table width="100%">
                                    <tr style="background-color:#f5f5f5;">
                                        <td align="left" width="20%" style="vertical-align: top">
                                            <img src="'.$ImageUrl.'" style="max-width:100%;width:100%;">
                                        </td>
                                        <td width="20%">
                                            <u>Name:</u> '.get_the_title($postid).'<br>
                                            <u>'.$Description.':</u> '.$my_post_content.'<br><br>
                                            <u><a href="'.get_permalink($_POST['post_id']).'" target="_blank">'.$Openassetlink.' </a>
                                        </td>
                                        <td align="right" width="20%" style="vertical-align: top"><img src="'.$asset_site_image_path.'" style="display:block; width:100px;">
                                        </td>
                                    </tr>
                                    
                                </table>
                                <tr style="padding: 0;margin: 0;border: 0;">
                                <td align="left" width="50%" style="vertical-align: top">
                                    &nbsp;
                                </td>
                            </tr>
                                <tr cellpadding="2" style="background-color:#f5f5f5; padding: 20px;">
                                        <td>'.$freeMsg.'</td>
                                        
                                        <td style="width: 20%; text-align: right;">
                                            <img src="'.$logourl.'/wp-content/uploads/2018/01/kai_logo.png" style="max-width:100%;width:50%; float: right;">
                                        </td>
                                    </tr>                                    
                            </tr>
                            
                             <tr>
                                <td colspan="2" style="padding:20px 0px;text-align:center;"><a href="'.get_permalink($_POST['postid']).'" target="_blank" style="color:#1891d8;text-decoration:none;">'.$Clickviewasset.'</a></td>
                            </tr> 
                        </table>
                    </td>
                </tr>
            </table>
            </body>
            </html>';
            // echo $message;        
            // exit;    
            $insertSQL = "INSERT INTO " . $table_name . " SET post_id ='$postid', user_id ='$user_id', template_id='$template_id',category_id='$category_id',share_price='$shares_cost', date='$share_date'";
            $results = $wpdb->query($insertSQL);
            $mail = wp_mail($to, $subject, $message, $headers, $attachments);
            if($mail){
             echo $status = 1;
             die;
             }
             die;
    }
    function send_msg_to_owner1(){
      // print_r($_POST);
      //       exit;
           $assetInfo =  get_post($_POST['postid']);
           $url = get_permalink($_POST['postid']);
           $assetDesc = $assetInfo->post_content;
           $usertoowner = $_POST['usertoowner'];
           $asset_ownername = $_POST['asset_ownername'];
           $post_id = $_POST['postid'];
           $u_name = $_POST['u_name'];
           $m_number = $_POST['m_number'];
           $assert_name  = $_POST['post_title'];
           $senderMail = $_POST['user_emailid'];
           $email = $_POST['email'];
           $sender_email = $_POST['sender'];
           $to = $_POST['email'];
           $template_id = $_POST['template_id'];
           $category_id = $_POST['category_id'];
           $business_tmp = get_field('business_name',$_POST['postid']);
           $ImageUrl = wp_get_attachment_image_src( get_post_thumbnail_id($_POST['postid']), 'full');
           $subject = 'Thanks for contacting us';
           $sender = $_POST['sender'];
           $msg = $_POST['message'];
           $address = $_POST['address'];
           $homeUrl = home_url();
           $site_logo = get_template_directory_uri()."/assets/images/kai_logo.png";
           $qrcode_image = get_template_directory_uri()."/assets/images/images/qr.png";
           
           $headers[] = 'MIME-Version: 1.0' . "\r\n";
           $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
           $headers[] = "X-Mailer: PHP \r\n";
           $headers[] = 'From:< '.$sender.'>' . "\r\n";
           $lanCode = ICL_LANGUAGE_CODE;
            if($lanCode=='en'){
               $Message="Message";
               $SenderMSg ="Sender of this massage";
               $mobile_no="Mobile No";
               $EmailId = "Email Id";
               $Address = "Address";
               $Thankyou ="Thank you for using T2I, Your T2I team";
               $Clickviewasset = "Click below to view asset";
               $headingMsg ="This email comes from T2I. A potential customer opened your Asset and sent the following message on your asset";
               $Description ="Description";
             }
             else 
             {
             $Message="Botschaft";
             $SenderMSg ="Absender dieser Massage";
             $mobile_no="Mobile Nr";
             $EmailId = "E-Mail-ID";
             $Address = "Adresse";
             $Thankyou ="Vielen Dank, dass Sie T2I, Ihr T2I-Team, verwenden";
             $Clickviewasset = "Klicken Sie unten, um das Asset anzuzeigen";
             $headingMsg ="Diese E-Mail stammt von T2I. Ein potenzieller Kunde hat Ihr Asset geöffnet und die folgende Nachricht an Ihr Asset gesendet";
             $Description ="Beschreibung";   
             }

           $message = '<!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
              <title>Mailer</title>
            </head>
            <body style="margin: 0px;padding: 0px;font-family: arial;">
             <table  cellspacing="0" cellpadding="0" border="0"  style="margin:0 auto; width:100%; max-width:650px;" class="wrapper">
                <tr style="padding: 0;margin: 0;border: 0;">  
                    <td colspan="3" width="100%">
                        <table>
                              <tr style="padding: 15px; float: left; width: 100%; margin-bottom: 0px;">
                                <td style="margin-bottom: 25px;">Dear Petar/'.$asset_ownername.',</td>
                            </tr>
                            <tr style="padding: 15px; float: left; width: 100%;">
                                <td>
                                    '.$headingMsg.' „'.$assert_name.'“.
                                </td>
                            </tr>
                            <tr style="background-color:#fff2cc; padding: 15px; float: left; margin-bottom: 10px;">
                                <td>
                                    <u>'.$Message.':</u><br>'.$msg.'
                                </td>
                                
                            </tr>

                            <tr style="background-color:#f5f5f5;padding: 15px; float: left; margin-bottom: 25px">
                                <td><u>'.$usertoowner.'</td>
                            </tr>
                            <tr style="padding: 0;margin: 0;border: 0;">
                                <td align="left" width="50%" style="vertical-align: top">
                                    
                                </td>
                            </tr>
                            <tr style="padding: 0px; float: left; width: 100%;">
                                <td style="padding: 0 15px; float: left; width: 100%;"><u>'.$SenderMSg.'</u></td>
                            </tr>
                            <tr>
                                <td>
                                    <table border="1" border-spacing="0" cellpadding="15" cellspacing="0" style="border-collapse:collapse;border-color: #171515;border: none; width:100%;">
                                        <tr style="background-color:#f5f5f5; border:0;">
                                            <td>Name</td><td>'.$u_name.'</td>
                                        </tr>
                                        <tr>
                                            <td>'.$mobile_no.'</td><td>'.$m_number.'</td>
                                        </tr>
                                        <tr style="background-color:#f5f5f5; border:0;">
                                            <td>'.$EmailId.'</td><td>'.$senderMail.'</td>
                                        </tr>
                                        <tr>
                                            <td>'.$Address.'</td><td>'.$address.'</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr style="padding: 0 15px; float: left; width: 100%;">
                                <td style="padding: 0px; margin-top: 10px; float: left; width: 100%;"><u>Asset:</u></td>
                            </tr>
                            <tr>
                                <table>
                                    <tr>
                                        <td align="left" width="20%" style="vertical-align: top">
                                            <img src="'.$ImageUrl[0].'" style="max-width:100%;width:100%;">
                                        </td>
                                        <td style="background-color:#f5f5f5;">
                                            <u>Name:</u> '.$assert_name.'<br>
                                            <u>'.$Description.':</u> '.$assetDesc.'<br><br>
                                            <u><a href="'.get_permalink($_POST['postid']).'" target="_blank">Open asset link </a>
                                        </td>
                                        <td align="left" width="20%" style="vertical-align: top">
                                            <img src="'.$qrcode_image.'" style="max-width:50%;width:50%;">
                                        </td>
                                    </tr>
                                    
                                </table>
                                <tr style="background-color:#f5f5f5; padding: 20px; float: left;">
                                        <td>'.$Thankyou.'</td>
                                        
                                        <td style="width: 20%; text-align: right;">
                                            <img src="'.$site_logo.'" style="max-width:100%;width:50%; float: right;">
                                        </td>
                                    </tr>
                            </tr>
                            
                             <tr>
                                <td colspan="2" style="padding:20px 0px;text-align:center;"><a href="'.get_permalink($_POST['postid']).'" target="_blank" style="color:#1891d8;text-decoration:none;">'.$Clickviewasset.'</a></td>
                            </tr> 
                        </table>
                    </td>
                </tr>
            </table>
            </body>
            </html>';
          
            $mailSent = wp_mail($email, $subject, $message, $headers);
            $lanCode = ICL_LANGUAGE_CODE;
            if($lanCode=='en'){
                $Sorry = 'Sorry! Mail server is not configured.';
                $message ="Thanks, message was sent successfully to assert owner!.";
             }
             else 
             {
                $Sorry ='Es tut uns leid! Mailserver ist nicht konfiguriert.';
                $message = "Danke, die Nachricht wurde erfolgreich gesendet, um den Besitzer zu bestätigen!";
             }
            //$mail     = wp_mail($to, $subject, $message, $headers);
            //$mailSent=1;
            $mail=1;
            if($mail && $mailSent ){
                global  $current_user, $wpdb;
                 $table_name = $wpdb->prefix . "asset_message";
                 $user_id = get_current_user_id();
                  $obj = new UserReports();
                  $subs_id = CheckPlanforAsset($_POST['template_id'], $user_id );
                  
                  $message_cost = $obj->get_current_subscription_data($subs_id, 'message_costs');

                 $insertSQL = "INSERT INTO " . $table_name . " SET post_id ='$post_id', user_id ='$user_id', message='$msg',Email='$email',asset_ownerid='$usertoowner',template_id='$template_id', category_id='$category_id', per_cost ='$message_cost', sender_email='$sender_email', message_name='$u_name', message_email='$senderMail', message_mobile_no='$m_number', message_address='$address'";
                 $results = $wpdb->query($insertSQL);
              echo json_encode( array('status'=>"Success", 'class'=>"status", 'message'=>$message));
             die();
           }
           else {
            echo json_encode( array( 'status'=>"Success", 'class'=>"error", 'message'=>$Sorry)); 
           }
       die();
    }

    function update_reminder(){

      global  $current_user, $wpdb;
      $current_user = wp_get_current_user();
      $table_name = $wpdb->prefix . "remainder";
     // print_r($_REQUEST);
      $user_id = get_current_user_id();
      $post_id = $_POST['post_id'];
      $days_text = $_POST['event-type'];
      $message = $_POST['message'];
      $date = $_POST['remainder_date'];

      $enddate = date('Y-m-d', strtotime($date));
      $st_date = date('Y-m-d');

      $date1 = date_create($st_date);
      $date2 = date_create($enddate);
     //difference between two dates
      $diff = date_diff($date1,$date2);
      $d = $diff->format("%a");

      if($_POST['event-type']=='daily'){
      $days = $d+1;
      }
      else if($_POST['event-type']=='weekly'){
      $days = $d+7;
      }
      else if($_POST['event-type']=='monthly'){
      $days = $d+30;
      }
      else if($_POST['event-type']=='quarterly'){
      $days = $d+4;
      }
      else if($_POST['event-type']=='yearly'){
      $days = $d+365;
      }

     $lanCode = ICL_LANGUAGE_CODE;
     if($lanCode=='en'){
        $Thanks = 'Thanks, Reminder updated successfully!.';
     }
     else 
     {
        $Thanks ='Danke, Erinnerung erfolgreich aktualisiert!.';
     }
      $expiry_date = date('Y-m-d', strtotime("+$days days"));
      $updateSql = "UPDATE " . $table_name ." set Message='$message', days='$days_text', expire_date='$expiry_date', stardate='$date' where user_id='$user_id' and post_id = '$post_id'";
      $wpdb->query($updateSql);

      if($updateSql){       
        wp_send_json(array( 'status'=>"Success", 'class'=>"status", 'message'=>$Thanks));
      }
      die;
      }

     function track_clickedLink(){

      global  $current_user, $wpdb;

      $table_name = $wpdb->prefix . "track_links";
      $user_id = get_current_user_id();
      $post_id = $_POST['post_id'];
      $template_id = $_POST['template_id'];
      $category_id = $_POST['category_id'];
      $date = date('Y-m-d');
      $obj= new UserReports();
      $subs_id = CheckPlanforAsset($_POST['template_id'], $user_id );
      //echo "subs_id~~~~".$subs_id;
      $url_calls_cost = $obj->get_current_subscription_data($subs_id, 'url_calls');
      $insertSQL = "INSERT INTO " . $table_name . " SET post_id ='$post_id', user_id ='$user_id',template_id='$template_id', date='$date',category_id='$category_id', per_cost='$url_calls_cost'";
      $results = $wpdb->query($insertSQL);
      die;
     }
     
     function download_asset(){
       global  $current_user, $wpdb;
       $table_name = $wpdb->prefix . "download_asset";
       $user_id = get_current_user_id();
       $post_id = $_POST['post_id'];
       $template_id = $_POST['template_id'];
       $date = date('Y-m-d');
       $category_id = $_POST['category_id'];
       $obj= new UserReports();
      $subs_id = CheckPlanforAsset($_POST['template_id'], $user_id );
      //echo "subs_id~~~~".$subs_id;
        $downloads_cost = $obj->get_current_subscription_data($subs_id, 'downloads');
       $insertSQL = "INSERT INTO " . $table_name . " SET post_id ='$post_id', user_id ='$user_id',template_id='$template_id', date='$date', per_cost='$downloads_cost', category_id='$category_id'";
       $results = $wpdb->query($insertSQL);
       die;
     }

     function accessLevel(){
       global  $current_user, $wpdb;
       $table_name = $wpdb->prefix . "user_asset_accesslevel";
       //$user_id    = get_current_user_id();
       $user_id    = $_POST['user_id'];
       $post_id    = $_POST['post_id'];
       $message  = trim($_POST['user_note']);
       $type       = $_POST['type'];

       $lanCode = ICL_LANGUAGE_CODE;
       if($lanCode=='en'){
        $successfully = 'You have successfully created notes!';
        $UpdatedMsg ='You have successfully created notes!';
       }
       else 
       {
       $successfully = 'Sie haben erfolgreich Notizen erstellt!';
       $UpdatedMsg ='Erfolgreich geupdated!';
       }
       if($message !=""){
        $insertSQL = "INSERT INTO " . $table_name . " SET post_id ='$post_id', user_id ='$user_id', message='$message', type='$type'";
         $results = $wpdb->query($insertSQL);
          echo json_encode(array( 'status'=>"Success", 'class'=>"status", 'message'=>$successfully));
        }else{
          echo json_encode(array( 'status'=>"Error", 'class'=>"status", 'message'=>"Please enter message!")); 
        }
        die;
       }

       function sendMessageToAssetOwner(){
       global  $current_user, $wpdb;
       $table_name = $wpdb->prefix . "user_asset_accesslevel";
       //$user_id    = get_current_user_id();
       $user_id    = $_POST['user_id'];
       $post_id    = $_POST['post_id'];
       $message  = trim($_POST['owner_message']);
       $type       = $_POST['type'];
             
       $lanCode = ICL_LANGUAGE_CODE;
       if($lanCode=='en'){
        $successfully = 'Your message sent to Asset owner!';
        $UpdatedMsg ='Your message sent to Asset owner!';
       }
       else 
       {
       $successfully = 'Sie haben erfolgreich Notizen erstellt!';
       $UpdatedMsg ='Erfolgreich geupdated!';
       }
       if($message !=""){
        $insertSQL = "INSERT INTO " . $table_name . " SET post_id ='$post_id', user_id ='$user_id', message='$message', type='$type'";
         $results = $wpdb->query($insertSQL);
          echo json_encode(array( 'status'=>"Success", 'class'=>"status", 'message'=>$successfully));
        }else{
          echo json_encode(array( 'status'=>"Error", 'class'=>"status", 'message'=>"Please enter message!")); 
        }
        die;
       }

       function ads_per_template(){

           global  $current_user, $wpdb;
           $table_name     = $wpdb->prefix . "ads_click";
           $user_id        = get_current_user_id();
           $post_id        = $_POST['post_id'];
           $template_id    = $_POST['template_id'];
           $category_id    = $_POST['category_id'];
           $date = date('Y-m-d');
           $insertSQL = "INSERT INTO " . $table_name . " SET post_id ='$post_id', user_id ='$user_id', template_id='$template_id', category_id='$category_id', date='$date'";
          $results = $wpdb->query($insertSQL);
          die;
       }

       function report_per_template(){

           global  $current_user, $wpdb;
           $table_name     = $wpdb->prefix . "click_report";
           $user_id        = get_current_user_id();
           $post_id        = $_POST['post_id'];
           $template_id    = $_POST['template_id'];
           $category_id    = $_POST['category_id'];
            $obj= new UserReports();
            $subs_id = CheckPlanforAsset($_POST['template_id'], $user_id );
            //echo "subs_id~~~~".$subs_id;
            $downloads_cost = $obj->get_current_subscription_data($subs_id, 'report_called');

           $date = date('Y-m-d');
           $insertSQL = "INSERT INTO " . $table_name . " SET post_id ='$post_id', user_id ='$user_id', template_id='$template_id', category_id='$category_id', date='$date', per_cost='$downloads_cost'";
           
          $results = $wpdb->query($insertSQL);
          die;
       }
    }
new Ajax_request_handle();
?>
