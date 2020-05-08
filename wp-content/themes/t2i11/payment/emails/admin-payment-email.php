<table class="body-wrap" style="width:97% !important;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;">
  <tbody><tr>
    <td class="container" style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;">
      <table style="width:100% !important;border-collapse:collapse;">
        <tbody>
        <tr>
          <td class="masthead" style="padding-top:80px;padding-bottom:80px;padding-right:0;padding-left:0;background-color:#2a333b;background-image:url('http://d3.iworklab.com/t2iwp1/wp-content/uploads/2018/01/kai_logo.png');background-repeat:no-repeat;background-position:center 15px;background-attachment:scroll;color:white;border-radius:10px 10px 0 0;" align="center">
            <h1 style="line-height:1.25;font-size:32px;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:90%;">Payment Confirmation</h1>
          </td>
        </tr>
        <tr>
          <td class="content" style="background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:20px;padding-left:20px;">
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("Dear, ", "t2i"); ?> <?php echo $user_displayname; ?></p>
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("Admin has been changed the payment status of your transaction", "t2i"); ?></p>
            <p style="font-size:18px;font-weight:bold;margin-bottom:20px;"><?php _e("PAYMENT INFORMATION", "t2i"); ?></p>
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">
            	<?php _e("Payment Date :", "t2i"); ?> <?php echo $current_date ?><br>
            	<?php _e("Transaction ID :", "t2i"); ?> <?php echo $transaction->txn_id; ?><br>
            	<?php _e("Payment Status :", "t2i"); ?> <?php echo $status; ?><br>
            	<?php _e("Paypal ID :", "t2i"); ?> <?php echo $transaction->payer_email; ?>
            </p>
            <table style="width: 90% margin: 0 auto; margin-bottom: 20px;">
              <tbody><tr style="background-color: #eeeeee;">
                <th style="font-size:13px;font-weight:bold;text-align:left;padding: 3px 6px;" width="70%"><?php _e("Item", "t2i"); ?></th>
                <th style="font-size:13px;font-weight:bold;text-align:right;padding: 3px 6px;" width="30%" align="right"><?php _e("Payment Info", "t2i"); ?></th>
              </tr>
              <tr style="border-bottom: solid 1px #f7f7f7;">
                <td style="font-size:13px;font-weight:normal;padding: 0px 6px;vertical-align:top;"><?php echo $transaction->item_name; ?>
              </td>
              <td style="font-size:13px;font-weight:normal;padding: 0px 6px;vertical-align:top;" align="right"><?php echo $current_date ?></td>
              </tr>
            </tbody></table>
            <table style="width: 40%!important; margin-left: 60%; margin-bottom: 20px;">
              <tbody>
              	<tr>
                <td style="font-size:13px;font-weight:normal;padding: 0px 6px;vertical-align:top;" align="right"><?php _e("Net Amount :", "t2i"); ?></td>
                <td style="font-size:13px;font-weight:normal;padding: 0px 6px;vertical-align:top;" align="right"><?php _e("&euro;", "t2i"); ?><?php echo $payment_responce['payment_gross'] - $payment_responce['tax']; ?></td>
              </tr>
              <tr>
                <td style="font-size:13px;font-weight:normal;padding: 0px 6px;vertical-align:top;" align="right"><?php _e("Thereof VAT 19% :", "t2i"); ?></td>
                <td style="font-size:13px;font-weight:normal;padding: 0px 6px;vertical-align:top;" align="right"><?php _e("&euro;", "t2i"); ?><?php echo $payment_responce['tax']; ?></td>
              </tr>
              <tr>
              </tr><tr style="border-top: solid 2px #ccc;">
                <td style="font-size:13px;font-weight:bold;padding: 0px 6px;vertical-align:top;" align="right"><?php _e("Total Payment :", "t2i"); ?></td>
                <td style="font-size:13px;font-weight:bold;padding: 0px 6px;vertical-align:top;" align="right"><?php _e("&euro;", "t2i"); ?><?php echo $payment_responce['payment_gross']; ?></td>
              </tr>
            </tbody></table>
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("If you have questions about this email, you can simply reply to this email with your questions and we will get back to you shortly with an answer. You can access a printable receipt for all of your Hover transactions in :", "t2i"); ?> <a href="<?php echo network_home_url( '/dashboard' ); ?>" style="color:#324bd2; text-decoration:underline;" target="_blank"><?php _e("your T2i account.", "t2i"); ?></a></p>
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("Thanks again for your business! We appreciate that you've chosen us.", "t2i"); ?></p>
            <!-- signature begin -->
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("Yours Sincerly,", "t2i"); ?></p>
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("T2I Team ,", "t2i"); ?></p>
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><a href="<?php echo network_home_url( '/' ); ?>" style="color:#324bd2; text-decoration:underline;" target="_blank"><?php _e("(www.thing2inter.net)", "t2i"); ?></a></p>         
          </td>
        </tr>
      </tbody></table>
    </td>
  </tr>
  </tbody></table>