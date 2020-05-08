<?php
/*
 * Template Name: Transaction Details
 */

get_header();
if(!empty($_GET['invoice_id']) && !empty($_GET['userid'])){
$invoice_id = $_GET['invoice_id'];
$userid = $_GET['userid'];

$current_date = date('Y-m-d H:i:s');
global $wpdb;
$table_name = $wpdb->prefix . "transaction_log";
$sql = "SELECT * FROM $table_name where payment_by_userid='$userid' and invoice_id='$invoice_id'";
$transaction = $wpdb->get_row($sql);
$payment_responce = unserialize($transaction->payment_responce);


$owner_id = $transaction->payment_by_userid;
$asset_user = get_userdata($owner_id);
$user_displayname = $asset_user->user_firstname;
$address =  get_user_meta($owner_id,'address',true);
?>
<div class="template-wrapper">
  <section>
          <div class="container">
              <div class="breadcrumb">
                <?php //echo "responce~~~~~".$responce; ?>
                <h1>Transaction Details</h1>
                <!-- <h4>Your payment has been done successfully. </h4> -->
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
                      <td width="50%"><?php _e("Invoice Amount", "t2i"); ?> </td>
                      <td width="50%"><b><?php echo $transaction->payment_amount ?></b></td>
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
<?php
}
else{?>
<div class="template-wrapper">
  <section>
          <div class="container">
              <div class="breadcrumb">
  <?php 
  _e("Sorry you are not authorized to view this page.","t2i");
  ?>
  </div>
           </div>
  </section>
</div>
<?php 
}
get_footer();
?>