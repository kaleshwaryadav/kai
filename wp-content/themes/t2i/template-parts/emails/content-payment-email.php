<?php
global  $current_user, $wpdb;
$current_user = wp_get_current_user();
// $current_date = date('Y-m-d H:i:s');
$current_date = date('Y-m-d');
$asset_user = get_userdata($current_user->ID);
$user_displayname = $asset_user->user_firstname;
?>
<table class="body-wrap" style="width:97% !important;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;">
  <tbody><tr>
    <td class="container" style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;">
      <!-- Message start -->
      <table style="width:100% !important;border-collapse:collapse;">
        <tbody><tr>
          <td class="preheader" style="font-size: 10px;color:#adadad;text-align:center; padding:5px;"><?php _e("This is your payment confirmation. ", "t2i"); ?></td>
        </tr>
        <tr>
          <td class="masthead" style="padding-top:80px;padding-bottom:80px;padding-right:0;padding-left:0;background-color:#2a333b;background-image:url('http://d3.iworklab.com/t2iwp1/wp-content/uploads/2018/01/kai_logo.png');background-repeat:no-repeat;background-position:center 15px;background-attachment:scroll;color:white;border-radius:10px 10px 0 0;" align="center">
            <h1 style="line-height:1.25;font-size:32px;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:90%;">Payment Confirmation</h1>
          </td>
        </tr>
        <tr>
          <td class="content" style="background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:20px;padding-left:20px;">
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("Dear, ", "t2i"); ?> <?php echo $user_displayname; ?>,</p>
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("Thank you for payment! A record of your payment information appears below. Please keep this email as the confirmation of your payment.", "t2i"); ?></p>
            <p style="font-size:18px;font-weight:bold;margin-bottom:20px;"><?php _e("PAYMENT INFORMATION", "t2i"); ?></p>
           <!--  <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">Payment Date: <?php echo $current_date ?><br>Transaction ID: <?php echo $_POST['txn_id']; ?><br><?php _e("Payment Status :", "t2i"); ?> <?php echo $_POST['payment_status']; ?>
          </p> -->
          <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">
            <?php _e("Payment Date :", "t2i"); ?> <?php echo $current_date ?><br>
            <?php _e("Transaction ID :", "t2i"); ?> <?php echo $_POST['txn_id']; ?><br>
            <?php _e("Payment Status :", "t2i"); ?><?php echo $_POST['payment_status']; ?><br>
            <?php _e("Paypal ID :", "t2i"); ?> <?php echo $_POST['payer_email']; ?>
          </p>
            <table style="width: 90% margin: 0 auto; margin-bottom: 20px;">
              <tbody><tr style="background-color: #eeeeee;">
                <th style="font-size:13px;font-weight:bold;text-align:left;padding: 3px 6px;" width="70%"><?php _e("Item", "t2i"); ?></th>
                <th style="font-size:13px;font-weight:bold;text-align:right;padding: 3px 6px;" width="30%" align="right"><?php _e("Payment Info", "t2i"); ?></th>
              </tr>
              <tr style="border-bottom: solid 1px #f7f7f7;">
                <td style="font-size:13px;font-weight:normal;padding: 0px 6px;vertical-align:top;"><?php echo $_POST['item_name']; ?>
                <!-- <ul style="margin-left: 20px;font-size:13px;font-weight:normal;list-style-type: none;"><li><?php echo $_POST['item_name']; ?></li></ul> -->
              </td>
              <td style="font-size:13px;font-weight:normal;padding: 0px 6px;vertical-align:top;" align="right"><?php echo $current_date ?></td>
              </tr>
            </tbody></table>
            <table style="width: 40%!important; margin-left: 60%; margin-bottom: 20px;">
              <tbody><tr>
                <td style="font-size:13px;font-weight:normal;padding: 0px 6px;vertical-align:top;" align="right"><?php _e("Net Amount :", "t2i"); ?></td>
                <td style="font-size:13px;font-weight:normal;padding: 0px 6px;vertical-align:top;" align="right"><?php _e("&euro;", "t2i"); ?><?php echo $_POST['payment_gross'] - $_POST['tax']; ?></td>
              </tr>
              <tr>
                <td style="font-size:13px;font-weight:normal;padding: 0px 6px;vertical-align:top;" align="right"><?php _e("Thereof VAT 19% :", "t2i"); ?></td>
                <td style="font-size:13px;font-weight:normal;padding: 0px 6px;vertical-align:top;" align="right"><?php _e("&euro;", "t2i"); ?><?php echo $_POST['tax']; ?></td>
              </tr>
              <tr>
              </tr><tr style="border-top: solid 2px #ccc;">
                <td style="font-size:13px;font-weight:bold;padding: 0px 6px;vertical-align:top;" align="right"><?php _e("Total Payment :", "t2i"); ?></td>
                <td style="font-size:13px;font-weight:bold;padding: 0px 6px;vertical-align:top;" align="right"><?php _e("&euro;", "t2i"); ?><?php echo $_POST['payment_gross']; ?></td>
              </tr>
            </tbody></table>
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("If you have questions about this payment, you can simply reply to this email with your questions and we will get back to you shortly with an answer. You can access a printable receipt for all of your Hover transactions in :", "t2i"); ?> <a href="<?php echo network_home_url( '/dashboard' ); ?>" style="color:#324bd2; text-decoration:underline;" target="_blank"><?php _e("your T2i account.", "t2i"); ?></a></p>
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("Thanks again for your business! We appreciate that you've chosen us.", "t2i"); ?></p>
            
             <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("Yours Sincerly,", "t2i"); ?></p>
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("T2I Team ,", "t2i"); ?></p>
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><a href="<?php echo network_home_url( '/' ); ?>" style="color:#324bd2; text-decoration:underline;" target="_blank"><?php echo esc_html("(www.thing2inter.net)"); ?></a></p>
            <!-- <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("Get help :", "t2i"); ?> <a href="http://d3.iworklab.com/t2iwp1/" style="color:#3ab795;text-decoration:none;">http://d3.iworklab.com/t2iwp1</a><br> -->
              <!-- What's happening at Hover: <a href="https://www.hover.com/blog/" style="color:#3ab795;text-decoration:none;">https://www.hover.com/blog/</a><br>
            Hover is a service of Tucows, an ICANN accredited registrar since 1999.</p> -->
          </td>
        </tr>
      </tbody></table>
      <!-- body end -->
    </td>
  </tr>
  <!-- footer begin -->
 <!--  <tr>
    <td class="container" style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;">
      <table style="width:100% !important;border-collapse:collapse;">
        <tbody><tr>
          <td class="content footer" style="background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:20px;padding-left:20px;" align="center">
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("You were sent this email because you are a customer of", "t2i"); ?> <a href="http://d3.iworklab.com/t2iwp1/"><?php _e("d3.iworklab.com/t2iwp1", "t2i"); ?></a>.<br>
              <?php _e("Mailing address: 96 Lorum ipsum., Lorum, ON M8K 6M2", "t2i"); ?><br>
              <?php _e("Email :", "t2i"); ?> <a href="mailto:t2i@getnada.com" style="color:#3ab795;text-decoration:none;"><?php _e("t2i@getnada.com", "t2i"); ?></a></p>
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr> -->
    <!-- footer end -->
  </tbody></table>