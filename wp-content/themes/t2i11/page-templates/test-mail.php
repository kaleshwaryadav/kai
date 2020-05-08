<?php
/*
 * Template Name: test mail
 */

get_header(); ?>

<?php

                  $subjectMessage ='Feedback to the T2i Team'; 
                  $thankyou ='Thank you! Your message has been sent.';
                  $Sorrymail ='Sorry mail server is not configured.'; 
                    $subject  = $subjectMessage;
                    $subjects   = $_POST['subject'];
                    $admin_email = get_option( 'admin_email' );
                    $sender    = get_bloginfo( 'name' );
                    $message   = $_POST['message'];
                    $headers[] = 'MIME-Version: 1.0' . "\r\n";
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers[] = "X-Mailer: PHP \r\n";
                    $headers[] = 'From: '.$sender.' < '.$admin_email.'>' . "\r\n";
                    $mailBody= "Subject: $subjects \nMessage: $message ";
                   if(wp_mail($to, $subject, $mailBody, $headers)){
                    echo"Thanks you ";
                   }


 get_footer(); ?>
