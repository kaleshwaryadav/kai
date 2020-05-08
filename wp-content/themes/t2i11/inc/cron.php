<?php
/*
 * Template Name: cron job reminder
 */
 ?>
 <?php

 /*
  * @kaleshwar
  * its is used for asset reminder
  */

 global  $current_user, $wpdb;
 $table_name = $wpdb->prefix . "remainder";
 $ReminderSent = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
 $currentdate = date('Y-m-d');
 if(!empty($ReminderSent)){
    foreach($ReminderSent as $item){
        if($item['expire_date']==$currentdate){
           if($item['days']=='daily'){
             $days = 1;
            }
            else if($item['days']=='weekly'){
               $days = 7; 
            }
            else if($item['days']=='monthly'){
               $days = 30; 
            }
            else if($item['days']=='quarterly'){
               $days = 4; 
            }
            else if($item['days']=='yearly'){
               $days = 365; 
            }
            $message     = $item['Message'];
            $days_text   = $item['days'];
            $date        = $item['stardate'];
            $user_id     = $item['user_id'];
            $post_id     = $item['post_id'];
            $expiry_date = date('Y-m-d', strtotime("+$days days"));
            $UserData    = get_user_by('id', $user_id);
            $to = $UserData->data->user_email;
            $updateSql = "UPDATE " . $table_name ." set Message='$message', days='$days_text', expire_date='$expiry_date', stardate='$date' where user_id='$user_id' and post_id = '$post_id'";
            $wpdb->query($updateSql);
            if($updateSql){
               sendMail($to,$post_id,$message);
            }

        }

    }
    
 }

function sendMail($emailID,$postID,$message){
            $to = $emailID;
            $admin_email = get_option( 'admin_email' );
            $sender = get_bloginfo( 'name' );
            $subject = 'Asset reminder';
            $headers[] = 'MIME-Version: 1.0' . "\r\n";
            $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers[] = "X-Mailer: PHP \r\n";
            $headers[] = 'From: '.$sender.' < '.$admin_email.'>' . "\r\n";
            $assert_url = get_permalink($postID);
            $assetName = get_the_title($postID);
            $message = '<!DOCTYPE html>
            <html>
            <head>
            </head>
            <body>
            <table>
            <tr>
            <td>Asset Name:</td>
            <td>'.$assetName.'</td>
            </tr>
            <tr>
            <td>Message: </td>
            <td>'.$message.'</td>
            </tr>
            <tr>
            <td>
            <a href="'.$assert_url.'" style="color:#324bd2; text-decoration:underline;" target="_blank">Click here to view assert !</a></td></tr>
           </table>
            </body>
            </html>';
            $mailSent = wp_mail($to, $subject, $message, $headers);
            

}

?>
