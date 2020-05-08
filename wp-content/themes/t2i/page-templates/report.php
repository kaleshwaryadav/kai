<?php
/*
 * Template Name: user report
 */

get_header(); 
if(!is_user_logged_in()) {
$url = esc_url( home_url( '/' ) );?>
<script>
 document.location.href = "<?php echo $url;  ?>";
</script>
<?php } 
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
?>
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

<!-- main-body section starts here -->
<?php
$lanCode = ICL_LANGUAGE_CODE;
    if($lanCode=='en'){
        $UserAsset ="User Asset Data Report";
        $Filter = "Filter By (Month and Year):";
        $Monthly = "Monthly Payment Report";
        $OwnerDetails ="Owner Details";
        $month ="Month";
        $SrNo="Sr.No.";
        $AssetID ="Asset ID";
        $AssetName ="Asset Name";
        $Template ="Template";
        $Subscription ="Subscription";
        $TotalViews ="Total Views";
        $Clones ="Clones";
        $Shares ="Shares";
        $Favorits ="Favorits";
        $Reminder ="Reminder";
        $URLCalls ="URL Calls";
        $Downloads ="Downloads";
        $ReportsCalled ="Reports Called";
        $MessagesSent ="Messages Sent";
        $MonthlyFee = "Monthly Fee";
        $TotalCost ="Total Cost";
        $Sorry = "Sorry no records found!";
        $Search ="Search";
    }
    else
    {
        $UserAsset = "User Asset Data-Bericht";
        $Filter    = "Filtern nach (Monat und Jahr):";
        $Monthly   = "Monatlicher Zahlungsbericht";
        $OwnerDetails ="Besitzer Details";
        $month = "Monat";
        $SrNo = "Sr.No.";
        $AssetID = "Bestands-ID";
        $AssetName ="Asset-Name";
        $Template ="Vorlage";
        $Subscription ="Abonnement";
        $TotalViews ="Gesamtansichten";
        $Clones ="Klone";
        $Shares ="Anteile";
        $Favorits ="Favorits";
        $Reminder ="Erinnerung";
        $URLCalls ="URL-Aufrufe";
        $Downloads ="Downloads";
        $ReportsCalled ="Angerufene Berichte";
        $MessagesSent ="Gesendete Nachrichten";
        $MonthlyFee = "Monatliche Gebühr";
        $TotalCost ="Gesamtkosten";
        $Sorry = "Leider keine Datensätze gefunden!";
        $Search ="Suche";
    }
?>
<div class="template-wrapper extended">
	<section>
		<div class="container">
			<div class="breadcrumb">
				<?php if(function_exists('bcn_display'))
				{
					bcn_display();
				}?>
               
			</div>
          <?php $obj= new UserReports();
         $UserList = $obj->invoice_report_user();
         $user_id = $user_id;
         $asset_user = get_userdata($user_id);
         $address =  get_user_meta($user_id,'address',true);
       ?>

          <div id="dashboard-widgets-wrap">
            <div id="dashboard-widgets" class="metabox-holder">
            <div class="tableSec report-t2iwp">
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
              $filter = array();
              $newdate = date("Y-m", strtotime("-1 months"));
              $filter_custom = date("Y-m", strtotime($y."-".$m));

              if(!empty($filterByDate)){

               $filterData = UserReports::front_filter_by_month_year($y,$m,$user_id);

              }
              else {

                 $filterData = UserReports::frontend_report_of_user($user_id);
              }
              // echo'<pre>';
              // print_r($filterData);
              // echo'</pre>';

              ?>
            <h2><?php echo $UserAsset; ?></h2>
             <?php echo $Filter; ?>:
             <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
             <input type="submit" name="nm" value="<?php echo $Search; ?>" onclick="searchfilter();" required="required">
             <?php
             $payment_url = site_url()."/payment-report/";
             ?>
              <a href="<?php echo $payment_url; ?>" class="monthwise-report-btn"><?php echo  $Monthly; ?></a>


       <div class="month_filter" style="margin-bottom:10px; "><strong><?php echo $month; ?>:</strong> <?php echo $fullm; ?> </div>
       <p style="margin-bottom: 10px;">
      <strong><?php echo $OwnerDetails; ?>:</strong> <?php echo $asset_user->user_firstname; ?> <?php echo $address; ?>       
    </p>
    <div class="table-responsive">
       <table class="table table-bordered" width="100%" cellspacing="0" cellpadding="0">
         <thead>
           <tr>
             <th><?php echo $SrNo; ?></th>
             <th><?php echo $AssetID; ?>#</th>
             <th><?php echo $AssetName;?> </th>
             <th><?php echo $Template; ?></th>
             <th><?php echo $Subscription; ?></th>
             <th><?php echo $TotalViews; ?></th>
             <!-- <th>URL calls on this asset</th> -->
             <th><?php echo $Clones; ?></th>
             <th><?php echo $Shares; ?></th>
             <th><?php echo $Favorits; ?></th>
             <th><?php echo $Reminder ?></th>
             <th><?php echo $URLCalls; ?></th>
             <th><?php echo $Downloads; ?></th>
             <th><?php echo $ReportsCalled; ?></th>
             <th><?php echo $MessagesSent; ?></th>
             <th><?php echo $MonthlyFee; ?></th>
             <th><?php echo $TotalCost; ?></th>
           </tr>
         </thead>
        
             <tbody>
               <!-- <tr>
                 <td rowspan="20"><?php echo $asset_user->user_firstname; ?></td>
                 <td rowspan="20"><?php echo $address; ?></td>
                 <td rowspan="20"><?php echo count($filterData); ?></td>
              </tr> -->
               <?php
               $count = 1;
               $count_total_rec= count($filterData); 
                  foreach($filterData as $item){ 
                   $terms = wp_get_post_terms($item->ID,'asset-detail');

                   foreach($terms as $temp){
                    $template_name = $temp->name;
                    $planid = $temp->term_id;
                   }
                   $sub_plan = array(
                       'post_type' => 'subscription',
                       'suppress_filters' => false,
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
                   // echo "<pre>";
                   // print_r($cloning);
                   $shared     = $obj->asset_shared_by_user($user_id,$item->ID,$filterByDate);
                   $favorite   = $obj->asset_favoritebyuser($user_id,$item->ID,$filterByDate);
                   $reminder   = $obj->asset_reminderbyuser($user_id,$item->ID,$filterByDate);
                   $calledurl  = $obj->asset_calledbyuser($user_id,$item->ID,$filterByDate);   
                   $report     = $obj->asset_reportbyuser($user_id,$item->ID,$filterByDate);
                   $message    = $obj->Asset_SentMsgByUser($user_id,$item->ID,$filterByDate);
                   // print_r($message);     
                   $downloaded = $obj->asset_downloadedbyuser($user_id,$item->ID,$filterByDate);                  
                   $subs_id    = CheckPlanforAsset($planid, $user_id);
                   $open_assets = $obj->open_by_referal_urls($user_id,$item->ID,$filterByDate);
                   ?>
                  <tr>
                    <td><?php echo $count."."; ?></td>
                           
                  <td><a href=<?php echo get_the_permalink($item->ID); ?> title="<?php echo get_the_title($item->ID); ?>" target="_blank"><?php echo "#".$item->ID; ?></a></td>
                   <td><?php echo get_the_title($item->ID); ?></td>
                     <td><?php echo ucwords(strtolower($template_name)); ?></td>
                     <td><?php echo get_the_title($subs_id); ?></td>
                     <td><strong>
                      <?php
                      $total_open_assets = "";
                     $open_assets_count = (int)count($open_assets);
                     echo $open_assets_count;
                     foreach ($open_assets as $open_key) {
                       $total_views +=$open_key->per_cost;                  
                     }
                     $f_total_views +=$open_assets_count;

                     ?>                       
                     </strong></td>
                     <td><?php
                     $total_clone="";
                     $clone = (int)count($cloning);
                     echo $clone;
                     foreach ($cloning as $clone_key) {
                       $total_clone +=$clone_key->clone_cost;                  
                     }                     
                     ///echo "<br>";
                     $f_total_clone +=$clone;
                     ?></td>
                     <td><?php
                     $shared_total="";
                     $share = (int)count($shared);
                      echo $share;
                     foreach ($shared as $share_key) {
                       $shared_total +=$share_key->share_price;                  
                     }                     
                     //echo "<br>";
                     ///echo $shared_total;
                     $f_total_share +=$share;           
                     ?></td>
                     <td><?php
                     $favorite_total="";
                     $favoritecount = (int)count($favorite);
                     echo $favoritecount;
                     foreach ($favorite as $favorite_key) {
                       $favorite_total +=$favorite_key->per_cost;                 
                     }
                     //echo "<br>";
                     //echo $favorite_total;
                     $f_favorite_total +=$favoritecount; 
                     ?></td>
                     <td><?php
                     $reminder_total="";
                     $reminder_count = (int)count($reminder);
                     echo $reminder_count;
                     foreach ($reminder as $reminder_key) {
                       $reminder_total +=$reminder_key->per_cost;                 
                     }
                      //echo "<br>";
                      //echo $reminder_total;
                      $f_reminder_total +=$reminder_count;

                     ?></td>
                     <td><?php
                     $calledurl_total = "";
                     $calledurl_count = (int)count($calledurl);
                     echo $calledurl_count;
                     foreach ($calledurl as $calledurl_key) {
                       $calledurl_total +=$calledurl_key->per_cost;              
                     }
                    ///echo "<br>";
                    //echo $calledurl_total;
                    $f_calledurl_total +=$calledurl_count;
                     ?></td>
                     <td><?php
                     $downloaded_total = "";
                     $download = (int)count($downloaded);
                     echo $download;                     
                     foreach ($downloaded as $downloaded_key) {
                       $downloaded_total +=$downloaded_key->per_cost;
                     }
                      //echo "<br>";
                      //echo $downloaded_total;
                      $f_downloaded_total +=$download;
                     ?></td>
                     <td><?php
                     $report_total="";
                     $reportcount = (int)count($report);                     
                     echo $reportcount;
                     foreach ($report as $report_key) {
                       $report_total +=$report_key->per_cost;
                     }
                    // echo "<br>";
                     //echo $report_total;
                     $f_report_total +=$reportcount;                  
                     ?></td>
                     <td><?php
                     $message_total ="";
                     $message_count = (int)count($message);
                     echo $message_count;
                     foreach ($message as $message_key) {
                       $message_total +=$message_key->per_cost;
                     }
                     //echo "<br>";
                     //echo $message_total;
                     $f_message_total +=$message_count; 
                     ?></td>
                     <td><?php echo get_post_meta($subs_id,'monthly_costs',true);
                     $total_cost = get_post_meta($subs_id,'monthly_costs',true);
                     $total_monthly_costs+=get_post_meta($subs_id,'monthly_costs',true);
                     ?>&euro;</td>   
                     <td style="font-weight: bold;"><?php $total_earning = $total_views+$total_clone+$shared_total+$favorite_total+$total_reminder+$total_calledurl+$downloaded_total+$report_total+$message_total+$total_cost;
                      echo $total_earning;
                      $total_earn += $total_earning;
                      ?>&euro;</td>
                  </tr>
                 <?php $count++; $total_assets_count+=$count;}?>
                 <tr style="font-weight: bold;">
                   <td colspan="5" style="text-align: right;"><b>All Total :</b></td>
                  <td><?php echo $f_total_views;  ?></td>
                  <td><?php echo $f_total_clone;  ?></td>
                  <td><?php echo $f_total_share; ?></td>
                  <td><?php echo $f_favorite_total; ?></td>
                  <td><?php echo $f_reminder_total;  ?></td>
                  <td><?php echo $f_calledurl_total;  ?></td>
                  <td><?php echo $f_downloaded_total;  ?></td>
                  <td><?php echo $f_report_total; ?></td>
                  <td><?php echo $f_message_total;  ?></td> 
                  <td><?php echo $total_monthly_costs;  ?></td>              
                  <td><?php echo $total_earn; ?>&euro;</td>
                 </tr>                             
              </tbody>
            </table>
            </div>
            <?php            
            $total_views=0;
            $clone_total=0;
            $shared_total=0;
            $favorite_total=0;
            $reminder_total=0;
            $calledurl_total=0;
            $downloaded_total=0;
            $report_total=0; 
            $message_total=0;
            $total_earn=0;

            $f_total_views=0;
            $f_total_clone =0;
            $f_total_share=0;
            $f_favorite_total=0;
            $f_reminder_total=0;
            $f_calledurl_total=0;
            $f_downloaded_total=0;
            $f_report_total=0;
            $f_message_total=0;
            ?>
        <?php if(count($filterData)==0){ ?>
        <div style='color:red; text-align:center; margin-top:20px;'><?php echo  $Sorry; ?></div>
        <?php } ?>
        <!-- <div style="float:right; margin-top:20px;">
        <form action="#" name="payment_now">
        <input type="submit" name="paynow" value="Payment Now">
       </form>
       </div> -->

     </div>

   </div>
 </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
 function searchfilter(){
    var siteUrl ="<?php echo get_permalink(544);?>";
    var date = document.getElementById("month").value;
    var Url = siteUrl+'?filter='+date+'';
    window.location.href=Url;
    return true;
 }
</script>
  </div>	
  </section>
  </div>	<!-- template wrapper ends here -->
<?php get_footer(); ?>
