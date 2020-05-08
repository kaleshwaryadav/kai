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
</style>
<?php $obj= new UserReports();
 $UserList = $obj->invoice_report_user();
 // $user_id = $_GET['userid'];
 // $asset_user = get_userdata($user_id);
 // $address =  get_user_meta($user_id,'address',true);

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
      if(!empty($filterByDate)){
      $fullm = date('M Y', strtotime($filterByDate));
      }
      else {
      $fullm = date('M Y');
      }
      ?>
     <h2>User asset-User Data Report</h2>
              Filter By (Month and Year):
             <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
             <input type="submit" name="nm" value="Search" onclick="searchfilter();" required="required">

       <div class="month_filter" style="text-align:center;margin-bottom:10px; "><strong>Month:</strong> <?php echo $fullm; ?> </div>
     <?php
     if(!empty($UserList)){
      foreach($UserList as $uid){
         $user_id = $uid->ID;
         $asset_user = get_userdata($uid->ID);
         $address =  get_user_meta($uid->ID,'address',true);
         $filter = array();
         if(!empty($filterByDate)){
         $filterData = UserReports::filter_by_month_year($y,$m,$user_id);
         }
         else {
         $filterData = UserReports::report_of_current_month($user_id);
         }
        if(count($filterData)>0){ 
        ?>
       <table class="table table-bordered" width="100%" cellspacing="0" cellpadding="0">
         <thead>
           <tr>
             <th>Owner Name</th>
             <th>Owner Address</th>
             <th>Total Asset Count</th>
             <th>Asset Name </th>
             <th>Template</th>
             <th>Subscription</th>
             <th>Times asset was opened</th>
             <th>amount of URL calls on this asset</th>
             <th>amount of clones</th>
             <th>amount of shares </th>
             <th>amount of favorits</th>
             <th>amount of reminder</th>
             <th>amount of URL calls</th>
             <th>amount of Downloads</th>
             <th>amount of reports called</th>
             <th>amount of messages sent</th>
             <th>fixed monthly fee</th>
           </tr>
         </thead>
        
             <tbody>
               <tr>
                 <td rowspan="20"><?php echo $asset_user->user_firstname; ?></td>
                 <td rowspan="20"><?php echo $address; ?></td>
                 <td rowspan="20"><?php echo count($filterData); ?></td>
              </tr>
               <?php 
                  foreach($filterData as $item){ 
                   $terms = wp_get_post_terms($item->ID,'asset-detail');

                   foreach($terms as $temp){
                    $template_name = $temp->name;
                    $planid = $temp->term_id;
                   }
                   $sub_plan = array(
                       'post_type' => 'subscription',
                       'posts_per_page'=>-1,
                       'tax_query' => array(
                         'relation' => 'AND',
                        array(
                            'taxonomy' => 'asset-detail',
                            'field' => 'term_id',
                            'terms' => $planid
                        ),
                      ) 
                    );
                   $cloning    = $obj->user_cloning_permonth($user_id,$item->ID,$filterByDate);
                   $shared     = $obj->asset_shared_by_user($user_id,$item->ID,$filterByDate);
                   $favorite   = $obj->asset_favoritebyuser($user_id,$item->ID,$filterByDate);
                   $reminder   = $obj->asset_reminderbyuser($user_id,$item->ID,$filterByDate);
                   $calledurl  = $obj->asset_calledbyuser($user_id,$item->ID,$filterByDate);
                   $downloaded = $obj->asset_downloadedbyuser($user_id,$item->ID,$filterByDate);
                   $report     = $obj->asset_reportbyuser($user_id,$item->ID,$filterByDate);
                   $message    = $obj->Asset_SentMsgByUser($user_id,$item->ID,$filterByDate);
                   ?>
                  <tr>
                   <td><?php echo get_the_title($item->ID); ?></td>
                     <td><?php echo $template_name; ?></td>
                     <td>Gold</td>
                     <td><strong>76</strong></td>
                     <td>3</td>
                     <td><?php echo count($cloning); ?></td>
                     <td><?php echo count($shared); ?></td>
                     <td><?php echo count($favorite); ?></td>
                     <td><?php echo count($reminder); ?></td>
                     <td><?php echo count($calledurl); ?></td>
                     <td><?php echo count($downloaded); ?></td>
                     <td><?php echo count($report); ?></td>
                     <td><?php echo count($message); ?></td>
                     <td>2</td>   
                  </tr>
                 <?php } ?>
              </tbody>

            </table>
         <?php } } } ?>
        <?php //if(count($filterData)==0){ ?>
        <!-- <div style='color:red; text-align:center; margin-top:20px;'>Sorry no records found!</div> -->
        <?php //} ?>
        <!-- <div style="float:right; margin-top:20px;">
       <a href="<?php //echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset&report_action=invoicereport">Go Back</a>
       </div> -->
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
</script>
