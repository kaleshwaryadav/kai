<?php
global  $current_user, $wpdb;
$current_user = wp_get_current_user();
// print_r($current_user);
$table_name = $wpdb->prefix . "remainder";
$user_id = $current_user->ID;
$post_id =$_POST['post_id'];
$item = $wpdb->get_row("SELECT * FROM $table_name where user_id='$user_id' and post_id = '$post_id'");
$assertInfo = get_post($post_id);
$business_name = get_field('business_name',$item->post_id);
$ImageUrl = wp_get_attachment_image_src( get_post_thumbnail_id( $item->post_id ), 'full');



$lanCode = ICL_LANGUAGE_CODE;
    if($lanCode=='en'){
       $Reminder ="Reminder";
       $Title ="Title";
       $DateTime ="Date & Time";
       $Message ="Message";
       $delete ="delete";
       $sorry ="Sorry there is no assert in reminder List!.";
       $edit ="edit";
    }
    else
    {
    $Reminder ="Erinnerung";
    $Title ="Titel";
    $DateTime ="Terminzeit";
    $Message ="Botschaft";
    $delete ="löschen";
    $sorry ="Entschuldigung, es gibt keine Bestätigung in der Erinnerungsliste !.";
    $edit ="bearbeiten";
    }
?>
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Assets - Remonder</title>
   
  </head>
  <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
          <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>
            <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi, <span style="font-weight: 600;"><?php echo $current_user->display_name; ?></span></p>
                       <!--  <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Sometimes you just want to send a simple HTML email with a simple design and clear call to action. This is it.</p> -->
                          <div class="col-xs-6" style="width: 100%">
                            <div class="flex_box">
                               <img class="img-responsive" src="<?php echo $ImageUrl['0']; ?>" alt="" style="width:50%; ">
                                <div class="image-text">
                                    <p style="font-weight: 600;"><?php echo $business_name; ?></p>
                                </div>
                                <div class="list-box-description">
                                    <div class="list-unstyled ">
                                        <div>
                                            <span style="font-weight: 600;"><?php echo $Reminder; ?> :</span>
                                            <span><?php echo ucwords($item->days); ?></span>
                                        </div>
                                         <div>
                                            <span style="font-weight: 600;"><?php echo $Title; ?> :</span>
                                            <span><?php echo get_the_title($item->post_id); ?></span>
                                        </div>
                                        <div>
                                            <span style="font-weight: 600;"><?php echo $DateTime; ?> :</span>
                                            <span><?php echo date('m/d/Y h:i:s', strtotime($item->stardate)); ?></span>
                                        </div>
                                        <div>
                                            <span style="font-weight: 600;"><?php echo $Message; ?> :</span>
                                            <span><?php echo $item->Message; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                          <tbody>
                            <tr>
                              <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                  <tbody>
                                    <tr>
                                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="http://htmlemail.io" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Call To Action</a> </td>
                                    </tr>
                                  </tbody>
                                </table> -->
                              </td>
                            </tr>
                          </tbody>
                        </table>
                       <!--  <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">This is a really simple email template. Its sole purpose is to get the recipient to click the button with no distractions.</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Good luck! Hope it works.</p> -->
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
           <!--  <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
              <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                <tr>
                  <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                    <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">Company Inc, 3 Abbey Road, San Francisco CA 94102</span>
                    <br> Don't like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #999999; font-size: 12px; text-align: center;">Unsubscribe</a>.
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                    Powered by <a href="http://htmlemail.io" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">HTMLemail</a>.
                  </td>
                </tr>
              </table>
            </div> -->
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>