<?php
require_once('/var/www/html/t2iwp1/wp-config.php');
$obj= new UserReports();
$UserList = $obj->invoice_report_user();
// $filterByDate = date('Y-m', strtotime(date('Y-m')." -1 month"));
$filterByDate = date('Y-m', strtotime(date('Y-m')." -1 week"));
//$filterByDate = date('Y-m', strtotime(date('Y-m')));
    $datefilter = explode('-',$filterByDate);
    $y = $datefilter[0];
    $m = $datefilter[1];
    $d = $datefilter[2];
    global  $current_user, $wpdb;
    $table_name = $wpdb->prefix . "montly_payment_report";
    $Selectsql = "SELECT * FROM $table_name where Month='$m' and Year='$y'";
    $results = $wpdb->query($Selectsql); 
    if($results==0)
    {
    if(!empty($filterByDate)){
    $fullm = date('M Y', strtotime($filterByDate));
    }
    else {
    $fullm = "";
    }
    if(!empty($UserList)){
      foreach($UserList as $uid){
         $user_id = $uid->ID;
         $asset_user = get_userdata($uid->ID);
         $address =  get_user_meta($uid->ID,'address',true);
         $filter = array();
         if(!empty($filterByDate)){
          // echo "year~~~".$y;
          // echo "<br>";
          // echo "month~~~~".$m;
          $filterData = UserReports::filter_by_month_year($y,$m,$user_id);
          //print_r($filterData);
      if(count($filterData)>0){       
               $count_total_rec= count($filterData); 
                  foreach($filterData as $item){//$total_views = 0;
                   $terms = wp_get_post_terms($item->ID,'asset-detail');
                   //print_r($terms);
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
                   //echo "planid".$planid;
                   $subs_id    = CheckPlanforAsset($planid,$user_id);
                   //operation data

                   $f_total_views+= get_post_meta($item->ID,'wpb_post_views_count',true);

                    $total_clone="";
                    $clone = (int)count($cloning);                    
                    $f_total_clone +=$clone;
                    //print_r($cloning);
                    foreach ($cloning as $clone_key) {
                    $total_clone +=$clone_key->clone_cost;                  
                    }
                    //echo "total_clone~~~".$total_clone;

                    $shared_total="";
                    $share = (int)count($shared);
                    $f_total_share +=$share;
                    foreach ($shared as $share_key) {
                    $shared_total +=$share_key->share_price;                  
                    }  

                    $favorite_total="";
                    $favoritecount = (int)count($favorite);
                    $f_favorite_total +=$favoritecount;
                    foreach ($favorite as $favorite_key) {
                    $favorite_total +=$favorite_key->per_cost;                 
                    }

                    $reminder_total="";
                    $reminder_count = (int)count($reminder);
                    $f_reminder_total +=$reminder_count;
                    foreach ($reminder as $reminder_key) {
                    $reminder_total +=$reminder_key->per_cost;                 
                    }

                    $calledurl_total = "";
                    $calledurl_count = (int)count($calledurl);
                    $f_calledurl_total +=$calledurl_count;
                    foreach ($calledurl as $calledurl_key) {
                    $calledurl_total +=$calledurl_key->per_cost;              
                    }

                    $downloaded_total = "";
                    $download = (int)count($downloaded);                    
                    $f_downloaded_total +=$download;
                    foreach ($downloaded as $downloaded_key) {
                    $downloaded_total +=$downloaded_key->per_cost;
                    }

                    $report_total="";
                    $reportcount = (int)count($report);
                    $f_report_total +=$reportcount;
                    foreach ($report as $report_key) {
                    $report_total +=$report_key->per_cost;
                    }

                    $message_total ="";
                    $message_count = (int)count($message);                    
                    $f_message_total +=$message_count;
                    foreach ($message as $message_key) {
                    $message_total +=$message_key->per_cost;
                    }
                    $total_cost = get_post_meta($subs_id,'monthly_costs',true);
                    $total_monthly_costs+=get_post_meta($subs_id,'monthly_costs',true);

                    $total_earning = $total_clone+$shared_total+$favorite_total+$total_reminder+$total_calledurl+$downloaded_total+$report_total+$message_total+$total_cost;
                    $total_earn += $total_earning;
                }
        global  $current_user, $wpdb;
        $table_name = $wpdb->prefix . "montly_payment_report";
        //$user_id = get_current_user_id();
        $asset_filter_date = $filterByDate;
        $asset_userid = $user_id;
        $year = date('Y', strtotime($asset_filter_date));
        $month = date('m', strtotime($asset_filter_date));
        $price_reduction = get_price_reduction_by_month($month,$asset_userid);
        $currentdateTime = date('Y/m/d H:i:s');
        $date = 1;
        $new_date = date('y-m-d', strtotime($year."-".$month."-".$date));
        $filter = $asset_filter_date;        
        $insertSQL = "INSERT INTO " . $table_name . " 
        SET
        UserID = '$asset_userid',
        Month = '$month',
        Year = '$year',
        YearMonth = '$new_date',
        TotalNoAssets = '$count_total_rec',
        Total_Views = '$f_total_views',
        Total_Clones = '$f_total_clone',
        Total_Shares = '$f_total_share',
        Total_Favorits = '$f_favorite_total',
        Total_Reminder = '$f_reminder_total',
        Total_Url_Calls = '$f_calledurl_total',
        Total_Downloads = '$f_downloaded_total',
        Total_Report_Calls = '$f_report_total',
        Total_Message_Sent ='$f_message_total',
        PriceReduction = '$price_reduction',
        Total_Earning = '$total_earn',
        Last_Fetch_Report_DateTime = '$currentdateTime'";

        // $deletesql = "Delete from ".$table_name." where UserID=".$asset_userid." and Month=".$month." and Year=".$year."";                
        //echo $insertSQL;
        $results = $wpdb->query($insertSQL);        
        if($results==true){
          // $to = 'trilochan.bhatt@mail.vinove.com';
          // $subject = 'Test my 1-minute cron job';
          // $message = 'If you received this message, it means that your 3-minute cron job has worked! <img draggable="false" class="emoji" alt="🙂" src="https://s.w.org/images/core/emoji/11/svg/1f642.svg"> ';
          // $message.= "<br>";
          // //$message.= print_r($UserList);
          // $message.= $current_date;
          // //echo $message;
          // wp_mail( $to, $subject, $message );
        }else{
        }                 
        $total_assets_count= 0;
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
        }
        }               
      }
    }
  } 
?>