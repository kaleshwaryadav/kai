<?php
global  $current_user, $wpdb;
$admin_email = get_option( 'admin_email' );
$toName    = get_bloginfo( 'name' );
$current_user = wp_get_current_user();
$from = $_POST['email'];
$address = $_POST['address'];
$subject = "T2I - New user message on one of your Assets";
$bodyMessage = $_POST['message'];
 $lanCode = ICL_LANGUAGE_CODE;
  if($lanCode=='en'){
  $submitFeedback ="Submit Feedback to the T2i Team";
  $yourEmail = "your Email";
  $Subject="Subject";
  $Message ="Message";
  $send="send";
  }else{
    $submitFeedback ="Senden Sie Feedback an das T2i-Team";
    $yourEmail = "deine E-Mail";
    $subject = "T2I - New user message on one of your Assets";
    $Message ="Botschaft";
    $send="senden";
  }
?>
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>T2I - Feedback</title>
   
  </head>
  <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <?php $logo = 'http://d3.iworklab.com/t2iwp1/wp-content/uploads/2018/01/kai_logo.png'; ?>
      <?php wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ); ?>
            <table class="body-wrap" style="width:97% !important;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;">
              <tbody><tr>
                <td class="container" style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;">
                  <!-- Message start -->
                  <table style="width:100% !important;border-collapse:collapse;">
                    <tbody>         
                    <tr>
                      <td class="masthead" style="padding-top:80px;padding-bottom:80px;padding-right:0;padding-left:0;background-color:#2a333b;background-image:url('<?php echo esc_html($logo); ?>');background-repeat:no-repeat;background-position:center 15px;background-attachment:scroll;color:white;border-radius:10px 10px 0 0;" align="center">
                        <h1 style="line-height:1.25;font-size:32px;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:90%;color: #fff;"><?php echo esc_html($subject); ?></h1>
                      </td>
                    </tr>
                    <tr>
                      <td class="content" style="background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:20px;padding-left:20px;">
                       <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><?php echo esc_html("Dear"); ?>, <?php echo esc_html($user_login); ?> '</p>
                        <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php echo esc_html("A message from one of the users of your assets appeared."); ?></p>
                          <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><strong> From: </strong> <?php _e($_POST['u_name'], 't2i'); ?></p>
                          <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><strong> Subject: </strong> <?php _e($subject, 't2i'); ?><p>
                          <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><strong> Mobile Number: </strong> <?php _e($_POST['m_number'], 't2i'); ?><p>
                          <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><strong> Address: </strong> <?php _e($address, 't2i'); ?><p>
                          <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><strong> Message: </strong> <?php _e($bodyMessage, 't2i'); ?><p>
                          <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><strong> See Message: </strong> <a href="<?php echo network_home_url( '/private-message' ); ?>" style="color:#324bd2; text-decoration:underline;" target="_blank"><?php _e($_POST['post_title'], 't2i'); ?></a><p>
                          <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><?php echo esc_html("Please follow the link above, to open that message." ); ?></p>
                        </p>      
                         <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><?php echo esc_html("Yours Sincerly"); ?></p>
                        <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><?php echo esc_html("T2I Team "); ?></p>
                        <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><a href="<?php echo network_home_url( '/' ); ?>" style="color:#324bd2; text-decoration:underline;" target="_blank"><?php echo esc_html("(www.thing2inter.net)"); ?></a></p>
                        <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"></p>
                      </td>
                    </tr>
                  </tbody></table>
                  <!-- body end -->
                </td>
              </tr> 
              </tbody>
            </table>
  </body>
</html>