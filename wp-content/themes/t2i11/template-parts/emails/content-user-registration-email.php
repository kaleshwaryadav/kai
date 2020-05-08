<table class="body-wrap" style="width:97% !important;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;">
  <tbody><tr>
    <td class="container" style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;">
      <!-- Message start -->
      <table style="width:100% !important;border-collapse:collapse;">
        <tbody>         
        <tr>
          <td class="masthead" style="padding-top:80px;padding-bottom:80px;padding-right:0;padding-left:0;background-color:#2a333b;background-image:url('http://d3.iworklab.com/t2iwp1/wp-content/uploads/2018/01/kai_logo.png');background-repeat:no-repeat;background-position:center 15px;background-attachment:scroll;color:white;border-radius:10px 10px 0 0;" align="center">
            <h1 style="line-height:1.25;font-size:32px;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:90%;"><?php _e("T2I - You are now registered");?></h1>
          </td>
        </tr>
        <tr>
          <td class="content" style="background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:20px;padding-left:20px;">
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("Dear, ", "t2i"); ?> <?php echo $_POST["username"]; ?>,</p>
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("We inform you about your successful registration on the T2I platform.  Congratulations!", "t2i"); ?></p>
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"> <a href="<?php echo $activation_link; ?>" style="color:#324bd2; text-decoration:underline;" target="_blank"><?php _e("Click here", "t2i"); ?> </a> <?php _e("to active your account, ", "t2i"); ?> </p>
             <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">
                <?php _e("User ID :", "t2i"); ?> <?php echo $_POST["username"]; ?><br>
                <?php _e("Password :", "t2i"); ?><?php echo $_POST["user_password"]; ?><br>
              </p>  
            <p style="font-size:14px;font-weight:normal;margin-bottom:20px;"><?php _e("Please feel free to create your first own thing in the internet!  Start now at  www.thing2inter.net", "t2i"); ?></a></p>
             <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><?php _e("Sincerly yours,", "t2i"); ?></p>
            <p style="font-size:14px;font-weight:normal;margin-bottom:10px;"><?php _e("2I Team ,", "t2i"); ?></p>
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