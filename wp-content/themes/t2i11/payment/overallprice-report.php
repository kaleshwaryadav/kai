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
.go-back-button {
    float: right; font-size: 18px;
    
}

</style>


<?php $obj= new UserReports();?>
<div id="htprint">
<div class="container" style="width:1350px; margin:auto;">
  <div id="dashboard-widgets-wrap">
    <div id="dashboard-widgets" class="metabox-holder">
<?php if($_REQUEST['price_action']=='openasset'){ ?>
<div class="tb">
<h2 class="hndle ui-sortable-handle" style="border-bottom: 1px solid #e2e2e2;">
<span>T2I intern-Overall Price Report
</span>
<div class="go-back-button"><a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset">Go Back</a></div>
</h2>
    <?php
    $filterByDate = $_GET['filter'] ? $_GET['filter'] : "";
    $datefilter = explode('-',$filterByDate);
    $y = $datefilter[0];
    $m = $datefilter[1];
    $fullm = date('F', strtotime($filterByDate));
    ?>
    <div style="margin-left: 10px;">
    Filter By (Month and Year):
    <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
    <input type="submit" name="nm" value="Search" onclick="searchfilter();" required="required">
    <input type="button" onclick="printDiv()" value="Print Report">

    </div>

    <?php  $Listoftemplate = UserReports::number_of_template();
       if(!empty($Listoftemplate)){ 
        $j=0;
         foreach($Listoftemplate as $temp){?>
    <ul class="tableul reporttable<?php echo $j; ?>">
    <li class="hidesecnd"><span>Template </span>
      <ul class="tableul2">
        <li><span><?php echo $temp->name; ?></span></li>
       <?php 
       $categoryList = UserReports::get_used_categorybytemplate($temp->term_id);
       foreach($categoryList as $val){?>
        <li><span></span></li>
        <li><span></span></li>
        <li><span></span></li>
        <li><span></span></li>
        <li><span></span></li>
        <li><span></span></li>
        <li> <span></span></li>
        <li> <span></span></li>
        <li> <span></span></li>
        <?php  }
        for($p=1; $p<=count($categoryList)-1; $p++){
         echo'<li> <span></span></li>';   
        }
        ?>

      </ul>
    </li>
    <li class="hidesecnd"><span>Subscription </span>
      <ul class="tableul2">
      <?php $sub_plan = array(
           'post_type' => 'subscription',
           'posts_per_page'=>-1,
           'post_status' => 'publish',
           'suppress_filters' => false,
           'tax_query' => array(
                 'relation' => 'AND',
                array(
                    'taxonomy' => 'asset-detail',
                    'field' => 'term_id',
                    'terms' => $temp->term_id
                ),
              )
          );

        $plan_detail =  get_posts($sub_plan);
        $planIds = array();
        if($plan_detail){
       echo'<li><span><select name="plan" id="plan" onchange="filter_plan(this);">';
      foreach($plan_detail as $plan){
             $planarg[] = $plan->ID;
             $planIds[] = $plan->ID;
            ?>
            <option value="<?php echo $plan->ID; ?>" <?php if($_GET['plan_filter']==$plan->ID){ echo"selected";} ?> ><?php echo get_the_title($plan->ID); ?></option>
         <?php  }                    
       echo'</select></span></li>';
       }

         ?>
         <?php 
       $categoryList1 = UserReports::get_used_categorybytemplate($temp->term_id);
       foreach($categoryList1 as $val){?>
        <li><span></span></li>
        <li><span></span></li>
        <li> <span></span></li>
        <li> <span></span></li>
        <li> <span></span></li>
        <li><span></span></li>
        <li><span></span></li>
        <li><span></span></li>
        <li><span></span></li>
       <?php } 
       for($p1=1; $p1<=count($categoryList1)-1; $p1++){
         echo'<li> <span></span></li>';   
        } ?>

      </ul>
    </li>
    <li class="hidesecnd"><span>Category</span>
      <ul class="tableul2">
     <?php  $categoryList2 = UserReports::get_used_categorybytemplate($temp->term_id);
            foreach($categoryList as $item){?>
                <li><span><?php echo $item['category']; ?></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li> <span></span></li>
                <li> <span></span></li>
                <li> <span></span></li>
           <?php } 
           for($p3=1; $p3<=count($categoryList2); $p3++){
            echo'<li> <span> </span></li>';
           }
         ?>
       
       </ul>
    </li>
      <li class="hidesecnd"> <span>Function</span>
     <?php $categoryList = UserReports::get_used_categorybytemplate($temp->term_id);
       foreach($categoryList as $item){ $val= 10;?>
      <ul class="tableul2">
        <li> <span>Open asset </span></li>
        <li> <span>Open URl   </span></li>
        <li> <span>Share </span></li>
        <li> <span>Download </span></li>
        <li> <span>Message </span></li>
        <li> <span>Favorites </span></li>
        <li> <span>Cloning </span></li>
        <li> <span>Reminder </span></li>
        <li> <span>Monthly </span></li>
        <li> <span>Reports </span></li>
      </ul>
      <?php } ?>
    </li>
    <li class="hidesecnd"> <span>Count </span>
    <?php $categoryList = UserReports::get_used_categorybytemplate($temp->term_id);
     foreach($categoryList as $item){
          if($temp->term_id==7){
          $planID =  get_field('electronic_template','option');
          foreach($planID as $p){
             if(in_array($_GET['plan_filter'],$planIds)){
                $plan_id = $_GET['plan_filter']; 
             }
            else {
                $plan_id = $p->ID; 
            }
           $price =  get_post_meta($plan_id,'open_asset',true); 
           $p1 = get_post_meta($plan_id,'url_call',true);
           $sp = get_post_meta($plan_id,'share_costs',true);
           $sdwon = get_post_meta($plan_id,'download_costs',true);
           $fav = get_post_meta($plan_id,'favorites_costs',true);
           $msg = get_post_meta($plan_id,'message_costs',true);
           $clone = get_post_meta($plan_id,'clone-costs',true);
           $reminder = get_post_meta($plan_id,'reminder-costs',true);
           $monthly_costs = get_post_meta($plan_id,'monthly_costs',true);
           $reports_costs = get_post_meta($plan_id,'reports_costs',true);
           
          }  
               
        }
        else if($temp->term_id==6){
         $planID =  get_field('small_business_template','option');
          foreach($planID as $p){
            if(in_array($_GET['plan_filter'],$planIds)){
                $plan_id = $_GET['plan_filter']; 
            }
            else {
                $plan_id = $p->ID; 
            }
           $price =  get_post_meta($plan_id,'open_asset',true); 
           $p1 = get_post_meta($plan_id,'url_call',true); 
           $sp = get_post_meta($p->ID,'share_costs',true);
           $sdwon = get_post_meta($plan_id,'download_costs',true);
           $fav = get_post_meta($plan_id,'favorites_costs',true);
           $msg = get_post_meta($plan_id,'message_costs',true);
           $clone = get_post_meta($plan_id,'clone-costs',true);
           $reminder = get_post_meta($plan_id,'reminder-costs',true);
           $monthly_costs = get_post_meta($plan_id,'monthly_costs',true);
           $reports_costs = get_post_meta($plan_id,'reports_costs',true);
          }  
        }
        else if($temp->term_id==12) {
          $planID =  get_field('image_business_template','option');
          foreach($planID as $p){
            if(in_array($_GET['plan_filter'],$planIds)){
                $plan_id = $_GET['plan_filter']; 
            }
            else {
                $plan_id = $p->ID; 
            }
           $price =  get_post_meta($plan_id,'open_asset',true); 
           $p1 = get_post_meta($plan_id,'url_call',true); 
           $sp = get_post_meta($plan_id,'share_costs',true);
           $sdwon = get_post_meta($plan_id,'download_costs',true);
           $fav = get_post_meta($plan_id,'favorites_costs',true);
           $msg = get_post_meta($plan_id,'message_costs',true);
           $clone = get_post_meta($plan_id,'clone-costs',true);
           $reminder = get_post_meta($plan_id,'reminder-costs',true);
           $monthly_costs = get_post_meta($plan_id,'monthly_costs',true);
           $reports_costs = get_post_meta($plan_id,'reports_costs',true);

           
          }  

        }
        //$planprice = UserReports::PlanPrice($temp->term_id);
    $total_share = UserReports::overall_share_template_category($temp->term_id,$item['term_id'],$_GET['filter']);
    $total_down  = UserReports::overall_down_per_template_category($temp->term_id,$item['term_id'],$_GET['filter']);
    $totalcount  = UserReports::overall_open_asset_perCategory( $temp->term_id,$item['term_id'],$_GET['filter']);
    $totalUrl    = UserReports::overall_open_url_perCategory($temp->term_id,$item['term_id'],$_GET['filter']);
    $total_fav   = UserReports::overall_favorite_category($temp->term_id,$item['term_id'],$_GET['filter']);
    $total_msg   = UserReports::overall_message_per_category($temp->term_id,$item['term_id'],$_GET['filter']);
    $totalclone  = UserReports::overall_clones_per_category($temp->term_id,$item['term_id'],$_GET['filter']);
    $tot_remin   = UserReports::overall_reminders_per_category($temp->term_id,$item['term_id'],$_GET['filter']);
    $all_report   = UserReports::report_per_template($temp->term_id,$item['term_id'],$_GET['filter']);
        ?> 
        <ul class="tableul2">
          <li><span><?php echo $totalcount; ?></span></li>
          <li><span><?php echo $totalUrl; ?></span></li>
          <li><span><?php echo $total_share; ?></span></li>
          <li><span><?php echo $total_down; ?></span></li>
          <li><span><?php echo $total_msg; ?></span></li>
          <li> <span><?php echo $total_fav; ?></span></li>
          <li> <span><?php echo $totalclone; ?></span></li>
          <li> <span><?php echo $tot_remin; ?></span></li>
          <li> <span><?php echo $monthly_costs; ?></span></li>
          <li> <span><?php echo $all_report; ?></span></li>
        </ul>
        <?php } ?>
    </li>
     <li class="hidesecnd"><span>Single price </span>
    <?php $categoryList = UserReports::get_used_categorybytemplate($temp->term_id);
     foreach($categoryList as $item){?>
          <ul class="tableul2">
          <li><span>$<?php echo $price; ?></span></li>
          <li><span>$<?php echo $p1;?></span></li>
          <li><span>$<?php echo $sp;?></span></li>
          <li><span>$<?php echo $sdwon;?></span></li>
          <li><span>$ <?php echo $msg; ?></span></li>
          <li> <span>$ <?php echo $fav; ?></span></li>
          <li> <span>$ <?php echo $clone; ?></span></li>
          <li> <span>$ <?php echo $reminder; ?></span></li>
          <li> <span>$<?php echo $monthly_costs; ?></span></li>
          <li> <span>$<?php echo $reports_costs; ?></span></li>
        </ul> 
        <?php } ?>
    </li>
    <li class="hidesecnd"><span>Total amount</span>
    <?php $categoryList = UserReports::get_used_categorybytemplate($temp->term_id);
     foreach($categoryList as $item){ 
        $total_share = UserReports::overall_share_template_category($temp->term_id,$item['term_id'],$_GET['filter']);
        $total_down  = UserReports::overall_down_per_template_category($temp->term_id,$item['term_id'],$_GET['filter']);
        $totalcount  = UserReports::overall_open_asset_perCategory( $temp->term_id,$item['term_id'],$_GET['filter']);
        $totalUrl    = UserReports::open_url_perCategory($temp->term_id,$item['term_id']);
        $total_fav   = UserReports::overall_favorite_category($temp->term_id,$item['term_id'],$_GET['filter']);
        $total_msg   = UserReports::overall_message_per_category($temp->term_id,$item['term_id'],$_GET['filter']);
        $totalclone  = UserReports:: overall_clones_per_category($temp->term_id,$item['term_id'],$_GET['filter']);
        $tot_remin   = UserReports::overall_reminders_per_category($temp->term_id,$item['term_id'],$_GET['filter']);
        $all_report   = UserReports::report_per_template($temp->term_id,$item['term_id'],$_GET['filter']);
            ?>
          <ul class="tableul2">
          <li><span>$<?php echo $price*$totalcount; ?></span></li>
          <li><span>$<?php echo $p1*$totalUrl; ?></span></li>
          <li><span>$<?php echo $sp*$total_share; ?></span></li>
          <li><span>$<?php echo $sdwon*$total_down; ?></span></li>
          <li><span>$<?php echo $msg*$total_msg; ?></span></li>
          <li> <span>$<?php echo $fav*$total_fav; ?></span></li>
          <li> <span>$<?php echo$totalclone*$clone; ?></span></li>
          <li> <span>$<?php echo$tot_remin*$reminder; ?> </span></li>
          <li> <span>$<?php echo $monthly_costs; ?></span></li>
          <li> <span>$<?php echo $reports_costs*$all_report; ?></span></li>
          </ul> 
          <?php } ?>
      </li>
  </ul>
     
  <?php $j++; }  }
         ?>
</div>
</div>
</div>
</div>
<?php } ?>

 </div>
  </div>
</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
jQuery('select').change(function() {
    var siteUrl ="<?php echo admin_url(); ?>";
    var plan = $(this).val();
    var Url = siteUrl+'edit.php'+document.location.search+'&plan_filter='+plan+'';
    window.location.href=Url;
    return true;
});
function searchfilter(){
    var siteUrl ="<?php echo admin_url(); ?>";
    //var date = document.getElementById("date").value;
    var date = document.getElementById("month").value;
    var Url = siteUrl+'edit.php'+document.location.search+'&filter='+date+'';
    window.location.href=Url;
    return true;
 }

 function printDiv() {
     window.print();
}
</script>


