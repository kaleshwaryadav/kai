<?php
/*
 * Template Name: Payment Success
 */
get_header();
$mail = '';
if($_POST){
// dd($_POST);
global $current_user;
$username = $current_user->user_login;
$txn_id = $_POST['txn_id'];
$invoice_id = $_POST['item_number'];
$item_name = $_POST['item_name'];
$payer_email = $_POST['payer_email'];
$payer_fullname = $_POST['first_name']." ".$_POST['last_name'];
$payer_address = $_POST['address_name'].", ".$_POST['address_street'].", ".$_POST['address_city'].", ".$_POST['address_state'].", ".$_POST['address_country_code']."-".$_POST['address_zip'];
$payment_status = $_POST['payment_status'];
$payment_currency = $_POST['mc_currency'];
$payment_fee = $_POST['payment_fee'];
$payment_gross = $_POST['payment_gross'];
$payment_status = $_POST['payment_status'];
$payment_type = $_POST['payment_type'];
$payment_date = $_POST['payment_date'];
$business_id = $_POST['business'];
// $payment_responce = print_r($_POST, true);
$payment_responce = serialize($_POST);
$user_id = get_current_user_id();
$reminder_status  = 1;
$isPaymentCompleted = false;
// $created_date = date('d-m-Y H:i:s');
$current_date = date('Y-m-d H:i:s');
$payment_status = $payment_status;
global  $current_user, $wpdb;
$current_user = wp_get_current_user();
$asset_user = get_userdata($current_user->ID);
$user_displayname = $asset_user->user_firstname;
$table_name = $wpdb->prefix . "transaction_log";
$table_name_update = $wpdb->prefix . "montly_payment_report"; 
$isPaymentCompleted = true;
$active = 1;


/*
* Hendle paypal all response like "Completed", "Pending", "Processing", "Declined" except cancel status.
*/
  $payment_status = $payment_status;
  $sql = "SELECT * FROM $table_name where txn_id = '$txn_id'";
  $user_exits = $wpdb->get_row($sql);
  if($user_exits->payment_by_userid == 0){
  // Insert Paypal Response;
  $insertSQL = "INSERT INTO " . $table_name . " SET txn_id = '$txn_id', invoice_id = '$invoice_id', item_name = '$item_name', payment_amount = '$payment_gross', payer_email='$payer_email', payer_fullname='$payer_fullname', payer_address='$payer_address', currency='$payment_currency', payment_fee ='$payment_fee', payment_gross ='$payment_gross', payment_status='$payment_status', payment_type='$payment_type', payment_date='$payment_date', business='$business_id', payment_responce = '$payment_responce', payment_by_userid = '$user_id', reminder_status='1', created_date = NOW()";
  $results = $wpdb->query($insertSQL);
  if(!$results){
    $updateSql = "UPDATE " . $table_name_update ." SET Payment_Status = '$payment_status', Updated_DateTime = NOW() WHERE UserID = '$user_id' and ID='$invoice_id'";
    $update_res = $wpdb->query($updateSql);

    /*ob_start();
    get_template_part("template-parts/emails/content", "payment-email" );
    $emailsPayment = ob_get_contents();
    ob_end_clean();*/


  // $my_current_lang = apply_filters( 'wpml_current_language', NULL );

  // $userPayTemp = get_post(2221);
  $email_templ_id = icl_object_id(2220,'post',false,ICL_LANGUAGE_CODE);
  $userPayTemp = get_post($email_templ_id);
  $netAmt = $_POST['payment_gross'] - $_POST['tax'];
  $emailPaymentTemp = str_replace('{subject}', $userPayTemp->post_title, $userPayTemp->post_content); 
  $emailPaymentTemp = str_replace('{name}', $user_displayname, $emailPaymentTemp); 
  $emailPaymentTemp = str_replace('{payment_date}', date('Y-m-d'), $emailPaymentTemp); 
  $emailPaymentTemp = str_replace('{transaction_id}', $_POST['txn_id'], $emailPaymentTemp); 
  $emailPaymentTemp = str_replace('{payment_status}', $_POST['payment_status'], $emailPaymentTemp); 
  $emailPaymentTemp = str_replace('{paypal_id}', $_POST['payer_email'], $emailPaymentTemp); 
  $emailPaymentTemp = str_replace('{net_amount}', $netAmt, $emailPaymentTemp); 
  $emailPaymentTemp = str_replace('{vat}', $_POST['tax'], $emailPaymentTemp); 
  $emailPaymentTemp = str_replace('{total_amount}', $_POST['payment_gross'], $emailPaymentTemp);


    // $to = 't2i@getnada.com';

    $to = $current_user->user_email;
    $subject = $userPayTemp->post_title.' : Transaction ID :'.$txn_id;
    $admin_email = get_option( 'admin_email' );
    // $sender    = get_bloginfo( 'name' );
    $sender    = $_POST['email'];
    $message   = $emailsReminder;
    $headers[] = 'MIME-Version: 1.0' . "\r\n";
    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers[] = "X-Mailer: PHP \r\n";
    $headers[] = 'From: T2i < '.$admin_email.'>' . "\r\n";
    $mailBody= "Subject: $subjects \nMessage: T2i - Payment Received ";
    // $mail = wp_mail($to, $subject, $emailsReminder, $headers);
    $mail = wp_mail($to, $subject, $emailPaymentTemp, $headers);
                    

    if($mail){
      $msg = "<small>Email has been send successfully to your registered email address</small>";
    }else{
      $msg = "something went wrong!";
    }
  }
}

$sql = "SELECT * FROM $table_name where txn_id='$txn_id'";
$transaction = $wpdb->get_row($sql);
$owner_id = $transaction->payment_by_userid;
$asset_user = get_userdata($owner_id);
$user_displayname = $asset_user->user_firstname;
$address =  get_user_meta($owner_id,'address',true);
$payment_responce = maybe_unserialize($transaction->payment_responce);
?>

<div class="template-wrapper">
  <section>
    <!--Model Popup starts-->
    <div class="container">
        <div class="row">
            <div class="modal fade in" id="paymentSuccess" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                         </div>
              
                        <div class="modal-body">                           
                          <div class="thank-you-pop">
                             <img src="<?php bloginfo('template_directory'); ?>/assets/images/Green-Round-Tick.png" alt="">
                              <h1>Thank You!</h1>
                              <?php if( !empty($mail) ){?>
                                <p>Your payment has been "<?php echo $_POST['payment_status'] ?>".</p>
                                <p><?php echo $msg;?></p>
                              <?php } ?>
                              <div class="cupon-pop">
                                <p><?php _e("Your Transaction Id :", "t2i"); ?> <span><?php echo $_POST['txn_id']; ?></span></p>
                                <p><?php _e("Payment Status :", "t2i"); ?> <span><?php echo $_POST['payment_status']; ?></span></p>
                              </div>
                              
                            
                          </div>
                             
                        </div>
              
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Model Popup ends-->
          <div class="container">
              <div class="breadcrumb">
                <?php //echo "responce~~~~~".$responce; ?>
                <h1>Transaction Details</h1>
                <h4>Your payment has been done successfully. </h4>
                <section>
                  <h4 class="payment_success_section">Payment Information</h4>
                  <table style="width:50% !important">
                    <tr>
                      <td width="50%"><?php _e("Transaction", "t2i") ?> #</td>
                      <td width="50%"><b><?php echo $transaction->txn_id ?></b></td>
                    </tr>
                    <tr>
                      <td width="50%"><?php _e("Transaction Date Time", "t2i"); ?> </td>
                      <td width="50%"><b><?php echo $transaction->payment_date ?></b></td>
                    </tr>                    
                    <tr>
                      <td width="50%"><?php _e("Transaction Amount", "t2i"); ?></td>
                      <td width="50%"><b><?php echo $transaction->payment_amount ?></b></td>
                    </tr>
                    <tr>
                      <td width="50%"><?php _e("Currency", "t2i"); ?></td>
                      <td width="50%"><b><?php echo $transaction->currency ?></b></td>
                    </tr>
                    <tr>
                      <td width="50%"><?php _e("Transaction Status", "t2i"); ?></td>
                      <td width="50%"><b><?php echo $transaction->payment_status; ?></b></td>
                    </tr>
                  </table>
                </section>
                 <section>
                  <h4 class="payment_success_section"><?php _e("Invoice Information", "t2i"); ?></h4>
                  <table style="width:50% !important">
                    <tr>
                      <td width="50%"><?php _e("Invoice ID", "t2i"); ?> #</td>
                      <td width="50%"><b><?php echo $transaction->invoice_id ?></b></td>
                    </tr>
                    <tr>
                      <td width="50%"><?php _e("Invoice Title", "t2i"); ?> </td>
                      <td width="50%"><b><?php echo $transaction->item_name ?></b></td>
                    </tr> 
                    <tr>
                      <td width="50%"><?php _e("Net Amount", "t2i"); ?> </td>
                      <td width="50%"><b><?php echo $transaction->payment_amount - $payment_responce['tax']; ?></b></td>
                    </tr>
                    <tr>
                      <td width="50%"><?php _e("Thereof VAT 19%", "t2i"); ?> </td>
                      <td width="50%"><b><?php echo $payment_responce['tax']; ?></b></td>
                    </tr>
                  </table>
                </section>
                <section>
                  <h4 class="payment_success_section"><?php _e("Payer Information", "t2i");?></h4>
                  <table style="width:50% !important">
                    <tr>
                      <td width="50%"><?php _e("Name", "t2i"); ?> </td>
                      <td width="50%"><b><?php echo $transaction->payer_fullname ?></b></td>
                    </tr>
                    <tr>
                      <td width="50%"><?php _e("Email Address", "t2i"); ?>#</td>
                      <td width="50%"><b><?php echo $transaction->payer_email ?></b></td>
                    </tr> 
                    <tr>
                      <td width="50%"><?php _e("Address", "t2i"); ?></td>
                      <td width="50%"><b><?php echo $transaction->payer_address ?></b></td>
                    </tr>
                  </table>
                </section>
                <section>
                  <h4 class="payment_success_section"><?php _e("Asset Owner More Information", "t2i"); ?></h4>
                  <table style="width:50% !important">
                    <tr>
                      <td width="50%"><?php _e("Name", "t2i"); ?> </td>
                      <td width="50%"><b><?php echo $user_displayname ?></b></td>
                    </tr>
                    <tr>
                      <td width="50%"><?php _e("Address", "t2i"); ?> </td>
                      <td width="50%"><b><?php echo $address ?></b></td>
                    </tr>                      
                  </table>
                </section>
              </div>
           </div>
  </section>
</div>
<?php get_footer();
}
else{
  echo "Sorry you are not authorized to view this page.";
}
?>

<?php if( !empty($mail) ){?>
<script type="text/javascript">
    jQuery(window).on('load',function(){
        jQuery('#paymentSuccess').modal().fadeIn('show');
    });
</script>
<?php } ?>
  <style type="text/css">
    /*--thank you pop starts here--*/
.thank-you-pop{
  width:100%;
  padding:20px;
  text-align:center;
}
.thank-you-pop img{
  width:76px;
  height:auto;
  margin:0 auto;
  display:block;
  margin-bottom:25px;
}

.thank-you-pop h1{
  font-size: 42px;
    margin-bottom: 25px;
  color:#5C5C5C;
}
.thank-you-pop p{
  font-size: 20px;
    margin-bottom: 27px;
  color:#5C5C5C;
}
.thank-you-pop .cupon-pop{
  font-size: 25px;
    margin-bottom: 40px;
  color:#222;
  display:inline-block;
  text-align:center;
  padding:10px 20px;
  border:2px dashed #222;
  clear:both;
  font-weight:normal;
}
.thank-you-pop .cupon-pop span{
  color:#03A9F4;
}
.thank-you-pop a{
  display: inline-block;
    margin: 0 auto;
    padding: 9px 20px;
    color: #fff;
    text-transform: uppercase;
    font-size: 14px;
    background-color: #8BC34A;
    border-radius: 17px;
}
.thank-you-pop a i{
  margin-right:5px;
  color:#fff;
}
#paymentSuccess .modal-header{
    border:0px;
}
/*--thank you pop ends here--*/

  </style>