<style>
  .postboxheight{
   height: auto;
 }
 .wp-admin #dashboard_right_now li{width: 100%;}
 .wp-admin #dashboard_right_now li a{float: right;width: 60px;}
 .tablewp{width:100%; vertical-align:top; border-spacing:0px;}
 .tablewp td{vertical-align:top;}
 .wphaedingfilter h4{display:inline-block;}
 .wphaedingfilter select{display:inline-block; margin-left:20px; margin-bottom:10px; display:inline-block;}
 .tablewp tr th{padding:5px 10px;font-size:16px;}
 .tablewp tr th:first-child{text-align:left;}
 .tablewp tr th:last-child{text-align:right;}
 .tablewp tr td:last-child{text-align:right;}
 .tablewp tr td:first-child{text-align:left;}
 .tablewp tr td{padding:8px 10px; font-size:14px;}
 .tablewp tr td span{display:block; padding:5px 0px;}
 .tablewp tr td table td{padding:15px; border-bottom:2px solid #000;}
 .tablewp tr td table tr:last-child td{border:none;}
 .tablewp tr td table{border-spacing:0px;}
 #postbox-container-1{width:100% !important;}
 .tablewp tr td.no-padding{padding:0px;}
 ul.tableul
 {
  width:100%;
  display:table;
}
ul.tableul li
{
  width:200px;
  display:table-cell;
}
ul.tableul li span {
  text-align: center;
  border: 1px solid #000000;
  height:40px;
  line-height:40px;
  display: block;
  color: #000;
  background: #fff;
}
ul.tableul2
{
  width:100%;
  display:table;
}
ul.tableul2 li
{
  display:table-row;
}
li.hidesecnd>span {
  color: #000;
  font-weight: 700;
}
.tb
{
  background:#fff;
}


ul.tableul.reporttable0
{
  margin-bottom:0px;
}
ul.tableul.reporttable1>li>span,ul.tableul.reporttable2>li>span {
  display: none;
}
ul.tableul.reporttable1,ul.tableul.reporttable2
{
  margin-top: 0px;
}

ul.tableul.reporttable1, ul.tableul.reporttable2 {
  margin-bottom: 0px;
  margin-top: 0px;
}

.table-bordered {
  border: 1px solid #ddd; 
}
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th{    border: 1px solid #ddd;}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: middle;
  border-style: solid;
  border-width: 0px 0px 1px 1px;
  border-color: #ddd;
  text-align: center;
}
.table>thead>tr>th:first-child, .table>tbody>tr:first-child td:first-child{
  border-left: 0;
}
.table>tbody>tr:last-child td, .table>tbody>tr:first-child td[rowspan]{border-bottom: 0}
.btn-payment-now{
    background: #03a9f4;
    color: #fff;
    padding: 5px 15px;
    margin-bottom: 10px;
    display: block;
}
.btn-payment-now:hover{color: #fff;}
.btn-payment-view{
  display: inline-table;
  width: 100%;
}
.payment_paid{color: green;}
.overlay_popup_loop {height: 100%; width: 100%; display: none; position: fixed; z-index: 1050; top: 0; left: 0; background-color: rgba(255, 255, 255, 0.9); }
.popupActive {overflow: hidden; }
.popupclose {height: 41px; width: 41px; background-color: #000; border-radius: 2px; opacity: 1; color: #ffff; text-align: center; line-height: 34px; font-size: 28px; float: right; margin: 50px 20px; }
.overlay_popup_loop-content {margin-top: 0; position: absolute; top: 30%; left: 50%; transform: translate(-50%,-50%); -webkit-transform: translate(-50%,-50%); -moz-transform: translate(-50%,-50%); -ms-transform: translate(-50%,-50%); width: 960px; }
.overlay_popup_loop-content{background: #fff; border: 1px solid #ddd; padding: 50px 30px; }
.loading_img {width: 40px;vertical-align: middle;display: none;}
.btn-reminder-sendnow{background: #03A9F4; color: #fff; border: none;
    padding: 5px 25px;}
.reminder_message{color: green;}
  </style>
<?php $obj= new UserReports();
 $UserList = $obj->invoice_report_user();
?>
<div class="container" style="width:1350px; margin:auto;">
  <div id="dashboard-widgets-wrap">
    <div id="dashboard-widgets" class="metabox-holder">
    <div class="tableSec">
    <?php
      $filterByDate = $_GET['filter'] ? $_GET['filter'] : "";
      $datefilter = explode('-',$filterByDate);
      $y = $datefilter[0];
      $m = $datefilter[1];
      $d = $datefilter[2];
      //echo $filterByDate;
      if(!empty($filterByDate)){
      $fullm = date('M Y', strtotime($filterByDate));
      }
      else {
      $fullm = "";      
      }
      ?>
     <h2>Payment Provider-User Invoice Report</h2>
              Filter By (Month and Year):
             <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
             <input type="submit" name="nm" value="Search" onclick="searchfilter();" required="required">
             <?php if(!empty($fullm)){ ?>
       <div class="month_filter" style="margin-bottom:10px; "><strong>Month:</strong> <?php echo $fullm; ?> </div>
     <?php } else{ echo "<br/><br/>";}?>
     <?php
     //
     //function      
    
    ?>
       <table class="table table-bordered" width="100%" cellspacing="0" cellpadding="0">
         <thead>
           <tr>
             <!-- <th>Owner ID#</th> -->
             <th>Owner Name </th>
             <th>Owner Address</th>
             <th>Total Asset Count</th>
             <th>Invoice ID#</th>
             <th>Invoice Duration</th>             
             <th>Outstanding Balance</th>
             <th>Price reduction</th>
             <th>Invoice Value Brutto</th>
             <th>Thereof VAT 19%:</th>
             <th>Invoice Value Netto</th>
             <th width="150px;">Invoice Status</th>
             <!-- <th>Generate Invoice / Requrest Payment</th> -->
             </tr>
         </thead>
        
             <tbody>
              <?php
              global  $current_user, $wpdb;
              $table_name = $wpdb->prefix . "montly_payment_report";
              //echo $fullm;
              if(!empty($filterByDate)){
               $sql = "SELECT * FROM $table_name where Month='$m' and Year='$y' order by YearMonth asc";
              }
              else{                
                $sql = "SELECT * FROM $table_name order by YearMonth asc";
              }
              //echo $sql;
              $result = $wpdb->get_results($sql);
              foreach( $result as $results ) {
                $owner_id = $results->UserID;
                $asset_user = get_userdata($owner_id);
                $user_displayname = $asset_user->user_firstname;
                $user_email = $asset_user->user_email;
                $address =  get_user_meta($owner_id,'address',true);
                $total_asset = $results->TotalNoAssets;
                $invoiceID = $results->ID;
                $invoiceMonth = $results->Year."-".$results->Month;
                $invc_month = strtotime($invoiceMonth);
                //echo $invc_month;
                $convert_date = date('M Y', strtotime($invoiceMonth));
                $total_earning = $results->Total_Earning;
                $start_date = date('01-m-Y', strtotime($invoiceMonth));
                $end_date = date('t-m-Y', strtotime($invoiceMonth)); 
              ?>
                 <tr>
                     <!-- <td><?php echo $owner_id; ?></td> -->
                     <td><?php echo $user_displayname; ?></td>
                     <td><?php echo $address; ?></td>
                     <td><?php echo $total_asset; ?></td>
                     <td><?php echo $invoiceID; ?></td>
                     <td><?php echo $start_date." </br>".$end_date; ?></td>
                     <td><?php echo round($total_earning,2); ?> €</td>
                     <td><?php echo get_price_reduction_by_month($results->Month, $owner_id);?></td>
                     <td>
                      <?php                     
                      

                      $price_reduction = get_price_reduction_by_month($results->Month, $owner_id);
                      $price_reduction_type = substr($price_reduction, -1);
                      if($price_reduction_type=='%'){
                          $invoice_brutto = ($total_earning*$price_reduction)/100;
                          $final_brutto = $total_earning - $invoice_brutto;
                        }
                        else{
                          $final_brutto = $total_earning-$price_reduction;                          
                        }
                      echo round($final_brutto,2);
                      ?>
                     €</td>
                     <td>
                      <?php
                      //$after_vat = ($final_brutto*19)/100;
                      $after_vat = 19/119*$final_brutto;
                      echo round($after_vat,2);
                      ?>

                     €</td>
                     <td><?php
                      $final_payment_amount = $final_brutto - $after_vat;                      
                      echo round($final_payment_amount,2);
                      ?> €</td>
                     <!-- <td><?php echo $results->Payment_Status ?></td> -->
                     <td><?php if($results->Payment_Status=='0'){?>
                      <!-- <a href="" class="btn-payment-now"><span class="dashicons dashicons-email-alt"></span> Send Reminder</a> -->
                      <a class="btn-payment-now popup_open_id_<?php echo $invoiceID; ?>" href="javascript:void(0);" onclick="popup_open_id('<?php echo $invoiceID; ?>')">
                        <span class="dashicons dashicons-email-alt"></span> Send Reminder
                      </a> 
                      <!-- Modal -->
                      <div class="overlay_popup_loop overlay_popup_loop_<?php echo $invoiceID; ?>" style="display: none;">
                        <a href="javascript:void(0);" class="popupclose" onclick="popup_close_id('<?php echo $invoiceID; ?>')"> ×</a>
                          <div class="overlay_popup_loop-content">
                              <h1>Send Reminder To Asset Owner</h1>
                              <table width="100%">
                                  <tr>
                                    <td width="35%" style="text-align: right;">Owner Details</td>
                                    <td width="10%">:</td>
                                    <td width="55%" style="text-align: left;"><?php echo $user_displayname; ?>      
                                      <?php echo $address; ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: right;">Email Address</td>
                                    <td>:</td>
                                    <td style="text-align: left;"><?php echo $user_email; ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: right;">Reminder</td>
                                    <td>:</td>
                                    <td style="text-align: left;"><?php echo $start_date." to ".$end_date; ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/load-more.gif" class="loading_img" id="loading_img"><input type="button" id="btn-reminder-sendnow" class="btn-reminder-sendnow" onclick="send_reminder('<?php echo $invoiceID ?>','<?php echo $convert_date ?>','<?php echo $owner_id ?>')" value="Send Now"></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3">
                                      <span class="reminder_message"></span>
                                    </td>
                                  </tr>
                                  
                              </table>
                              
                          </div>
                      </div>

                      <?php } else if($results->Payment_Status=='1'){?>
                        <span class="payment_paid">&#10003; Paid</span>
                        
                      <?php }?>
                        <a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&report_action=invoicereport&filter=<?php echo $invoiceMonth;  ?>" class="btn-payment-view">View Full Report</a>
                    </td>
                  </tr>
                <?php } ?>

                 </tbody>
            </table>
     </div>

   </div>
 </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
 function searchfilter(){
    var siteUrl ="<?php echo admin_url(); ?>";
    //var date = document.getElementById("date").value;
    var date = document.getElementById("month").value;
    var Url = siteUrl+'edit.php'+document.location.search+'&filter='+date+'';
    window.location.href=Url;
    return true;
 }
 function popup_open_id(id){
    jQuery(".overlay_popup_loop_"+id).show();
    jQuery('body').addClass('popupActive');
    jQuery('.reminder_message').html("");

  }
  function popup_close_id(id){
    jQuery(".overlay_popup_loop_"+id).hide();
    jQuery('body').removeClass('popupActive');
    jQuery('.reminder_message').html("");
  }
  function send_reminder(id, month, userid){
    $('#loading_img').show();
    jQuery.ajax({
    type: "post",
    url: ajaxurl,
    data: {action:'send_payment_reminder', invoice_id:id, month:month, userid:userid},
    success: function (data) {
      $('#loading_img').hide();
      $('.reminder_message').html(data);
      //console.log(data);
    }
    });
  }
</script>
