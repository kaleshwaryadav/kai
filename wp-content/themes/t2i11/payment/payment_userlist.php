<script src="<?php echo get_template_directory_uri(); ?>/datatable/js/jquery-1.12.4.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/datatable//js/jquery.dataTables.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/datatable//js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/datatable/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/datatable/css/dataTables.bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<h1>User Payment History</h1>
<?php do_action('custom_admin_notice');?>
        <div class='notice notice-error' style="display: none;">
            <p>Uh oh! We just received an error. Something went wrong!</p>
        </div>
        
        <div class='notice notice-success' style="display: none;">
            <p>Status hes been changed & email has been send successfully to user registered email address!</p>
        </div>
       
<table id="payment" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><?php _e("Sl No ", "t2i"); ?></th>
                <th><?php _e("User Details", "t2i"); ?></th>
                <th><?php _e("Paypal Account Details", "t2i"); ?></th>
                <th><?php _e("Invoice ID", "t2i"); ?></th>
                <th><?php _e("Transaction ID", "t2i"); ?></th>
                <th><?php _e("Item Name", "t2i"); ?></th>
                <th><?php _e("Price", "t2i"); ?></th>
                
                <th><?php _e("Payment Status", "t2i"); ?></th>
                <th><?php _e("Payment On", "t2i"); ?></th>                           
                
            </tr>
        </thead>
 
        <tbody>
        <?php global $wpdb;
         $table_name = $wpdb->prefix . "transaction_log";
         $result = $wpdb->get_results("SELECT * FROM $table_name ORDER BY ID DESC");
         //print_r($result);
         $j=1;
         if(!empty($result)){
            foreach($result as $item){
                $asset_user = get_userdata($item->payment_by_userid);
                $user_displayname = $asset_user->user_firstname;
                $user_email = $asset_user->user_email;
                
                /*if($item->payment_status==1){
                    $payment_status = "Complete";
                }else{
                    $payment_status = "Incomplete";
                }*/
                ?>
              <tr>
                <td><?php echo $j;  ?></td>
                
                 <td><?php echo $user_displayname."<br>".$user_email; ?></td>
                 <td><?php echo $item->payer_fullname."<br>".$item->payer_email."<br>".$item->payer_address."<br>"; ?>
                     <?php echo $item->payer_fullname;?>
                 </td>
                <td>#<?php echo  $item->invoice_id;?></td>
                <td><?php echo $item->txn_id;?></td>
                <td><?php echo $item->item_name;?></td>
                <td><?php _e("&euro;", "t2i"); ?><?php echo  $item->payment_gross;  ?></td>               
                
                <td>
                    <?php //echo $item->payment_status;  ?>
                    <div class="btn-group">
                        <select name="payment_status" class="payment_status_js" class="form-control" data-user_id="<?php echo $item->payment_by_userid;?>" data-id="<?php echo $item->ID;?>"  data-tax_id="<?php echo $item->txn_id;?>" data-email-templ="<?php echo icl_object_id(2221,'post',false,ICL_LANGUAGE_CODE); ?>">
                          <option value="Completed" <?php echo ($item->payment_status == "Completed") ? "selected" : ""; ?>>Completed</option>
                          <option value="Pending" <?php echo ($item->payment_status == "Pending") ? "selected" : ""; ?>>Pending</option>
                          <option value="Processing" <?php echo ($item->payment_status == "Processing") ? "selected" : ""; ?>>Processing</option>
                          <option value="Declined" <?php echo ($item->payment_status == "Declined") ? "selected" : ""; ?>>Declined</option>
                        </select>
                    </div>
                </td>

                <td><?php echo  $item->payment_date;  ?></td>
                
            </tr>

           <?php $j++; }
         }
         ?> 
      
        </tbody>
    </table>
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>

                </button>
                 <h4 class="modal-title">Message Form</h4>

            </div>
            <form id="myform" class="form-horizontal" role="form" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label popup-label">To</label>
                            <input required type="text" class="form-control" name="email" value="deepak.singh@karmatech.in" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label popup-label">Message</label>
                            <textarea class="form-control" name="message"></textarea>
                        </div>
                    </div>
                    <div id="error">
                        <div class="alert alert-danger"> <strong>Error!</strong> There Are Too Many Errors</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="submitForm">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="reset">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<div id="thanks"></div>
<div id="overlayCls" class="" style="display: none;">
  <div id="overlayText">Please wait...</div>
</div>
<style>
#overlayCls {
  position: fixed;
  display: block;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}

#overlayText{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 50px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
</style>
<script>
$(document).ready(function() {
    $('#payment').DataTable();
} );

jQuery(document).ready(function() {
    jQuery(".payment_status_js").change(function() {
        jQuery("#overlayCls").show();
        var id = jQuery(this).attr('data-id');
        var tax_id = jQuery(this).attr('data-tax_id');
        var user_id = jQuery(this).attr('data-user_id');
        var data_email_templ = jQuery(this).attr('data-email-templ');
        var status = jQuery(this).val();
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'JSON',
            data: {
                "action": "t2i_handle_payment_status",
                'id' : id,
                'tax_id' : tax_id,
                'user_id' : user_id,
                'status' : status,
                'email_templ' : data_email_templ,
            },
            success: function(res){
                if(res.data.status == true){
                    jQuery(".notice.notice-success").show().fadeOut(5000);
                }else{
                    jQuery(".notice.notice-error").show().fadeOut(5000);
                }
                jQuery("#overlayCls").hide();
            }
        });
    });
});

</script>
