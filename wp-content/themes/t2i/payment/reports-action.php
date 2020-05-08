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
.go-back-button {
    float: right; font-size: 18px;
}
.custom_message{
    text-align: center;
    color: #0073aa;
    padding: 6px 0 0 0;
    font-size: 14px;
}
</style>
<?php $obj= new UserReports();//echo'<pre>'; print_r($_REQUEST); echo'</pre>';?>
<div class="container" style="margin:auto;">
  <div id="dashboard-widgets-wrap">
    <div id="dashboard-widgets" class="metabox-holder">
      <?php
      if($_REQUEST['action']=='userpermonth'){ ?>
      <div id="postbox-container-1" class="postbox-container">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">
            <h2 class="hndle ui-sortable-handle">
              <span>Amount of new user per month
              </span>
              <div class="go-back-button"><a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset">Go Back</a></div>
            </h2>
            <div class="inside">
              <div class="main">
             <table border="1" class="tablewp">
              <thead>
              <tr>
               <th>New user register per month</th><th>Amount of new user per month</th><th>Count</th>
              </tr>
              </thead>
              <tbody>
                 <?php 
                  $PerMonthUserData = UserReports::register_user_perMonth();
                  $sum=0;
                  if(!empty($PerMonthUserData)){
                  foreach($PerMonthUserData as $item){ $sum+=$item['total']; ?>
                  <tr>
                      <td><?php echo date('M-Y', strtotime($item['user_registered'])) ?> </td>
                      <td><?php echo $item['total'];?></td>
                      <td></td>
                  </tr>

                  <?php } echo'<tr><td>Total</td><td></td><td>'.$sum.' </td></tr>'; } ?>
                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
     <?php }
     if($_REQUEST['action']=='totalamt_tmp'){ ?>
      <div id="postbox-container-1" class="postbox-container">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">
            <h2 class="hndle ui-sortable-handle">
              <span>Amount of Template
              </span>
                <div class="go-back-button"><a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset">Go Back</a></div></h2>
            <div class="inside wphaedingfilter">
              <div class="main">
              <table border="1" class="tablewp">
              <thead>
              <tr>
               <th width="50" style="text-align: center;">Sr.No</th>
               <th width="300" style="text-align: left;">Template Name</th>
               <th width="300" style="text-align: center;">Count</th>
              </tr>
              </thead>
              <tbody>
               <?php 
                  $Listoftemplate = UserReports::number_of_template();
                  //print_r($Listoftemplate);
                  if($_GET['lang']=="de"){
                    $lang = " [German]";
                  }else{                    
                    $lang = " [English]";
                  }
                  $count=1;
                  if(!empty($Listoftemplate)){
                  foreach($Listoftemplate as $tmp){ ?>
                  <tr>
                      <td style="text-align: center;"><?php echo $count; ?>.</td>
                      <td><?php echo $tmp->name. $lang;?></td>
                      <td style="text-align: center;"><?php echo $tmp->count;?></td>
                  </tr>
                  <?php $count++;
                      $total += $tmp->count;
                    } 
                  }  
                  ?>
                  <tr>
                    <td colspan="2" style="text-align: right;"><b>Total Assets:</b></td>
                    <td style="text-align: center;"><b><?php echo $total;?></b></td>
                  </tr>
                 </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
     <?php } 
     if($_REQUEST['action']=='amtexitpertmp'){ ?>
      <div id="postbox-container-1" class="postbox-container">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">
            <h2 class="hndle ui-sortable-handle">
              <span>Amount of existing asset per template 
              </span>
              <div class="go-back-button"><a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset">Go Back</a></div>
            </h2>
            <div class="inside">
              <div class="main">
              <?php
              $filterByDate = $_GET['filter'] ? $_GET['filter'] : "";
              $datefilter = explode('-',$filterByDate);
              $y = $datefilter[0];
              $m = $datefilter[1];
              $fullm = date('F', strtotime($filterByDate));
              ?>
              Filter By (Month and Year):
              <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
              <input type="submit" name="nm" value="Search" onclick="searchfilter();" required="required">
              <table border="1" class="tablewp">
              <thead>
              <tr>
               <th>Template</th><th>Category</th><th>Count</th>
              </tr>
              </thead>
              <tbody>
              <?php $Listoftemplate = UserReports::number_of_template(); 
              if(!empty($y) && !empty($m)){
              $datequery = array(
                array(
                    'year' => $y,
                    'month' =>$m
                     )
                ); 
               }
               else {
                $datequery = array();
               }
               $sum = 0;
               foreach($Listoftemplate as $tmp){
                $args = array(
                'post_type' => 'assets',
                'posts_per_page' =>-1,
                'post_status' => 'publish',
                'suppress_filters' => false,
                'tax_query' => array(
                     'relation' => 'AND',
                    array(
                        'taxonomy' => 'asset-detail',
                        'field' => 'term_id',
                        'terms' => $tmp->term_id
                    ),
                )
              );
                $data = get_posts($args);
                $post_values = array();
                foreach($data as $item){
                 $terms = wp_get_post_terms($item->ID,'category');
                  $post_values[] = array( 
                    "temp_name"=> $tmp->name, 
                    "category"=> $terms[0]->name, 
                    "count" => UserReports::per_category_assets($tmp->term_id,$terms[0]->term_id,$_GET['filter']),
                  ); 
                }
                $amtemp_array_values = array_unique($post_values, SORT_REGULAR);
                $count=1;
                if(!empty($amtemp_array_values)){
                    foreach($amtemp_array_values as $val){
                    if($count==1){
                      $tem = $val['temp_name'];  
                    }
                    else{
                      $tem = "";  
                    }
                    $sum+=$val['count'];
                    echo'<tr>';
                    echo'<td>'.$tem.'</td>';
                    echo'<td>'.$val['category'].'</td>';
                    echo'<td>'.$val['count'].'</td>';
                    echo'</tr>';
                    $count++;
                    }
                }
              }
              ?>
             <tr><td>Total</td><td></td><td><?php echo $sum; ?></td></tr>

             </tbody>
              </table>
              <p class="custom_message"><?php if(!empty($filterByDate)){ ?> This report Shows the new assets in this month<?php }?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
     <?php  }
     if($_REQUEST['action']=='amtofcalledast'){ ?>
      <div id="postbox-container-1" class="postbox-container">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">
            <h2 class="hndle ui-sortable-handle">
              <span>Amount of called asset per template
              </span>
              <div class="go-back-button"><a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset">Go Back</a></div>
            </h2>
            <div class="inside">
              <div class="main">
              <?php 
              $filterByDate = $_GET['filter'] ? $_GET['filter'] : "";
              $datefilter = explode('-',$filterByDate);
              $y = $datefilter[0];
              $m = $datefilter[1];
              $d = $datefilter[2];
              $fullm = date('F', strtotime($filterByDate));
              ?>
              Filter By (Month and Year):
             <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
             <input type="submit" name="nm" value="Search" onclick="searchfilter();" required="required">
             <table border="1" class="tablewp">
              <thead>
              <tr>
               <th>Template</th><th>Category</th><th>Count</th>
              </tr>
              </thead>
              <tbody>
              <?php $Listoftemplate = UserReports::number_of_template();
                $language = ICL_LANGUAGE_CODE;
                $sum = 0;
               foreach($Listoftemplate as $tmp){
                $args = array(
                'post_type' => 'assets',
                'posts_per_page' =>-1,
                'post_status' => 'publish',
                'suppress_filters' => false,
                'tax_query' => array(
                     'relation' => 'AND',
                    array(
                        'taxonomy' => 'asset-detail',
                        'field' => 'term_id',
                        'terms' => $tmp->term_id
                    ),
                )
              );
                $data = get_posts($args);
                $post_values = array();
                foreach($data as $item){
                  $count_key = 'wpb_post_views_count';
                  $terms = wp_get_post_terms($item->ID,'category');
                  $term_id = $terms[0]->term_id;
                  $totalOpen = count($opened);
                  $post_values[] = array( 
                    "temp_name"=> $tmp->name, 
                    "category"=> $terms[0]->name, 
                    "count" => UserReports::opened_asset_per_template($tmp->term_id,$terms[0]->term_id,$_GET['filter'])

                  ); 
                }
                $amtemp_array_values = array_unique($post_values, SORT_REGULAR);
                $count=1;
                if(!empty($amtemp_array_values)){
                    foreach($amtemp_array_values as $val){
                    if($count==1){
                      $tem = $val['temp_name'];  
                    }
                    else{
                      $tem = "";  
                    }
                    $sum+=$val['count'];
                    echo'<tr>';
                    echo'<td>'.$tem.'</td>';
                    echo'<td>'.$val['category'].'</td>';
                    echo'<td>'.$val['count'].'</td>';
                    echo'</tr>';
                    $count++;
                    }
                }
             }
              ?>
              <tr><td>Total</td><td></td><td><?php echo $sum; ?></td></tr>
             </tbody>
              </table>
               <p class="custom_message"><?php if(!empty($filterByDate)){ ?> This report Shows the new assets in this month<?php }?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
     <?php  }
     if($_REQUEST['action']=='realcalledast'){ ?>
      <div id="postbox-container-1" class="postbox-container">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">
            <h2 class="hndle ui-sortable-handle">
              <span>Amount of real used asset per template
              </span>
              <div class="go-back-button"><a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset">Go Back</a></div>
            </h2>
            <div class="inside">
              <div class="main">
              <?php 
               
              $filterByDate = $_GET['filter'] ? $_GET['filter'] : "";
              $datefilter = explode('-',$filterByDate);
              $y = $datefilter[0];
              $m = $datefilter[1];
              $d = $datefilter[2];
              $fullm = date('F', strtotime($filterByDate));
              ?>
              Filter By (Month and Year):
             <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
             <input type="submit" name="nm" value="Search" onclick="searchfilter();" required="required">
             <table border="1" class="tablewp">
              <thead>
              <tr>
               <th>Template</th><th>Category</th><th>Count</th>
              </tr>
              </thead>
              <tbody>
              <?php 
              $Listoftemplate = UserReports::number_of_template();
              //echo UserReports::RealUsedAssetPerTemplate(7,21,$_GET['filter']); echo'<br>';
               $sum = 0;
               foreach($Listoftemplate as $tmp){
                $args = array(
                'post_type' => 'assets',
                'posts_per_page' =>-1,
                'post_status' => 'publish',
                'suppress_filters' => false,
                'tax_query' => array(
                     'relation' => 'AND',
                    array(
                        'taxonomy' => 'asset-detail',
                        'field' => 'term_id',
                        'terms' => $tmp->term_id
                    ),
                )
              );
                $data = get_posts($args);
                $post_values = array();
                foreach($data as $item){
                 $terms = wp_get_post_terms($item->ID,'category');
                  $post_values[] = array( 
                    "temp_name"=> $tmp->name, 
                    "category"=> $terms[0]->name, 
                    "count" => UserReports::RealUsedAssetPerTemplate($tmp->term_id,$terms[0]->term_id,$_GET['filter']),
                  ); 
                }
                $amtemp_array_values = array_unique($post_values, SORT_REGULAR);
                $count=1;
                if(!empty($amtemp_array_values)){
                    foreach($amtemp_array_values as $val){
                    if($count==1){
                      $tem = $val['temp_name'];  
                    }
                    else{
                      $tem = "";  
                    }
                    $sum+=$val['count'];
                    echo'<tr>';
                    echo'<td>'.$tem.'</td>';
                    echo'<td>'.$val['category'].'</td>';
                    echo'<td>'.$val['count'].'</td>';
                    echo'</tr>';
                    $count++;
                    }
                }
             }
              ?>
              <tr><td>Total</td><td></td><td><?php echo $sum; ?></td></tr>
             </tbody>
              </table>
              <p class="custom_message"><?php if(!empty($filterByDate)){ ?> This report Shows the new assets in this month<?php }?></p>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
     <?php } 
     if($_REQUEST['action']=='sharedtmp'){?>
      <div id="postbox-container-1" class="postbox-container">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">
            <h2 class="hndle ui-sortable-handle">
              <span>Amount of shared per template
              </span>
              <div class="go-back-button"><a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset">Go Back</a></div>
            </h2>
            <div class="inside">
              <div class="main">
              <?php  $filterByDate = $_GET['filter'] ? $_GET['filter'] : ""; ?>
               Filter By Month:
              <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
              <input type="submit" name="nm" value="Search" onclick="searchfilter();" required>
              <table border="1" class="tablewp">
              <thead>
              <tr>
                  <th>Template</th><th>Category</th><th>Count</th>
              </tr>
              </thead>
              <tbody>
              <?php
                  $filterByDate = $_GET['filter'] ? $_GET['filter'] : "";
                  $Listofshare = UserReports::number_of_template();
                  $post_values = array();
                  if(!empty($Listofshare)){
                  foreach($Listofshare as $tmp){ 
                    $totalshare = UserReports::share_per_template($tmp->term_id);
                    foreach($totalshare as $shareItem){
                         $terms = wp_get_post_terms($shareItem['post_id'],'category');
                         $post_values[] = array( 
                         "temp_name"=> $tmp->name, 
                         "category"=> $terms[0]->name, 
                         "count" => UserReports::share_per_template_category($tmp->term_id,$terms[0]->term_id,$filterByDate),
                      );
                    }
                 }
                 $share_array_values = array_unique($post_values, SORT_REGULAR);
                    $j=1;
                    $sum = 0;
                    $count = 0;
                    foreach($share_array_values as $share_val){
                        $count+=$share_val['count'];
                    }
                    foreach($share_array_values as $share_val){
                     $sum+=$share_val['count']; 
                    echo'<tr>';
                    echo'<td>'.$share_val['temp_name'].'</td>';
                    echo'<td>'.$share_val['category'].'</td>';
                    echo'<td>'.$share_val['count'].'</td>';
                    echo'</tr>';
                    $j++;
                    }
                    ?>
                <?php  } ?>
                  <tr><td>Total</td><td></td><td><?php echo $sum; ?></td></tr>
                </tbody>
              </table>
              <p class="custom_message"><?php if(!empty($filterByDate)){ ?> This report Showing monthly data 
              <?php } ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
     <?php }
     if($_REQUEST['action']=='clonestempl'){?>
      <div id="postbox-container-1" class="postbox-container">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">
            <h2 class="hndle ui-sortable-handle">
              <span>Amount of clones per template
              </span>
              <div class="go-back-button"><a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset">Go Back</a></div>
            </h2>
            <div class="inside">
              <div class="main">
              <?php  $filterByDate = $_GET['filter'] ? $_GET['filter'] : ""; ?>
               Filter By Month:
              <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
              <input type="submit" name="nm" value="Search" onclick="searchfilter();" required>
              <table border="1" class="tablewp">
              <thead>
              <tr>
                  <th>Template</th><th>Category</th><th>Count</th>
              </tr>
              </thead>
              <tbody>
              <?php
                  $filterByDate = $_GET['filter'] ? $_GET['filter'] : "";
                  $Listofclone = UserReports::number_of_template();
                  $post_values = array();
                  if(!empty($Listofclone)){
                  foreach($Listofclone as $tmp){ 
                    $totalsclone = UserReports::clone_per_template($tmp->term_id);
                    foreach($totalsclone as $cloneItem){
                         $terms = wp_get_post_terms($cloneItem['post_id'],'category');
                         $post_values[] = array( 
                         "temp_name"=> $tmp->name, 
                         "category"=> $terms[0]->name, 
                         "count" => UserReports::clones_per_template_category($tmp->term_id,$terms[0]->term_id,$filterByDate),
                      );
                    }
                 }
                 $clones_array_values = array_unique($post_values, SORT_REGULAR);
                    $j=1;
                    $sum = 0;
                    $count = 0;
                    foreach($clones_array_values as $val){
                        $count+=$val['count'];
                    }

                    foreach($clones_array_values as $val){
                     $sum+=$val['count']; 
                    echo'<tr>';
                    echo'<td>'.$val['temp_name'].'</td>';
                    echo'<td>'.$val['category'].'</td>';
                    echo'<td>'.$val['count'].'</td>';
                    echo'</tr>';
                    $j++;
                    }
                    ?>
                <?php  } ?>
                  <tr><td>Total</td><td></td><td><?php echo $sum; ?></td></tr>
                </tbody>
              </table>
              <p class="custom_message"><?php if(!empty($filterByDate)){ ?> This report Showing monthly data 
              <?php } ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
     <?php } 
      if($_REQUEST['action']=='favoriteItem'){?>
      <div id="postbox-container-1" class="postbox-container">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">
            <h2 class="hndle ui-sortable-handle">
              <span>Amount of favorite per template
              </span>
              <div class="go-back-button"><a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset">Go Back</a></div>
            </h2>
            <div class="inside">
            <div class="main">
              <?php  $filterByDate = $_GET['filter'] ? $_GET['filter'] : ""; ?>
               Filter By (Month and Year) :
              <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
              <input type="submit" name="nm" value="Search" onclick="searchfilter();" required>
              <table border="1" class="tablewp">
              <thead>
              <tr>
                  <th>Template</th><th>Category</th><th>Count</th>
              </tr>
              </thead>
              <tbody>
              <?php
                  $filterByDate = $_GET['filter'] ? $_GET['filter'] : "";
                  $Listoffavorite = UserReports::number_of_template();
                  $post_values = array();
                  if(!empty($Listoffavorite)){
                  foreach($Listoffavorite as $tmp){ 
                    $totalsfavorite = UserReports::favorite_per_template($tmp->term_id);

                    foreach($totalsfavorite as $favoriteItem){
                         $terms = wp_get_post_terms($favoriteItem['post_id'],'category');
                         $post_values[] = array( 
                         "temp_name"=> $tmp->name, 
                         "category"=> $terms[0]->name, 
                         "count" => UserReports::favorite_per_template_category($tmp->term_id,$terms[0]->term_id,$filterByDate),
                      );
                    }
                 }
                 // echo count($totalsfavorite);
                 $favorite_array_values = array_unique($post_values, SORT_REGULAR);
                    $j=1;
                    $sum = 0;
                    $count = 0;
                    foreach($favorite_array_values as $val){
                        $count+=$val['count'];
                    }

                    foreach($favorite_array_values as $val){
                     $sum+=$val['count']; 
                    echo'<tr>';
                    echo'<td>'.$val['temp_name'].'</td>';
                    echo'<td>'.$val['category'].'</td>';
                    echo'<td>'.$val['count'].'</td>';
                    echo'</tr>';
                    $j++;
                    }
                    ?>
                <?php  } ?>
                  <tr><td>Total</td><td></td><td><?php echo $sum; ?></td></tr>
                </tbody>
              </table>
              <p class="custom_message"><?php if(!empty($filterByDate)){ ?> This report Showing monthly data 
              <?php } ?></p>
              </div>
            
            </div>
          </div>
        </div>
      </div>
     <?php }
     if($_REQUEST['action']=='reminderstemp'){?>
      <div id="postbox-container-1" class="postbox-container">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">
            <h2 class="hndle ui-sortable-handle">
              <span>Amount of reminders per template
              </span>
              <div class="go-back-button"><a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset">Go Back</a></div>
            </h2>
            <div class="inside">
            <div class="main">
              <?php  $filterByDate = $_GET['filter'] ? $_GET['filter'] : ""; ?>
               Filter By (Month and Year) :
              <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
              <input type="submit" name="nm" value="Search" onclick="searchfilter();" required>
              <table border="1" class="tablewp">
              <thead>
              <tr>
                  <th>Template</th><th>Category</th><th>Count</th>
              </tr>
              </thead>
              <tbody>
              <?php
                  $filterByDate = $_GET['filter'] ? $_GET['filter'] : "";
                  $Listofreminder = UserReports::number_of_template();
                  $post_values = array();
                  if(!empty($Listofreminder)){
                  foreach($Listofreminder as $tmp){ 
                    $totalsreminder = UserReports::reminders_per_template($tmp->term_id);
                    foreach($totalsreminder as $reminderItem){
                         $terms = wp_get_post_terms($reminderItem['post_id'],'category');
                         $post_values[] = array( 
                         "temp_name"=> $tmp->name, 
                         "category"=> $terms[0]->name, 
                         "count" => UserReports::reminders_per_template_category($tmp->term_id,$terms[0]->term_id,$filterByDate),
                      );
                    }
                 }
                 $reminder_array_values = array_unique($post_values, SORT_REGULAR);
                    $j=1;
                    $sum = 0;
                    $count = 0;
                    foreach($reminder_array_values as $val){
                        $count+=$val['count'];
                    }
                    foreach($reminder_array_values as $val){
                     $sum+=$val['count']; 
                    echo'<tr>';
                    echo'<td>'.$val['temp_name'].'</td>';
                    echo'<td>'.$val['category'].'</td>';
                    echo'<td>'.$val['count'].'</td>';
                    echo'</tr>';
                    $j++;
                    }
                    ?>
                <?php  } ?>
                  <tr><td>Total</td><td></td><td><?php echo $sum; ?></td></tr>
                </tbody>
              </table>
              <p class="custom_message"><?php if(!empty($filterByDate)){ ?> This report Showing monthly data 
              <?php } ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
     <?php } 
     if($_REQUEST['action']=='calltemplate'){?>
      <div id="postbox-container-1" class="postbox-container">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">
            <h2 class="hndle ui-sortable-handle">
              <span>Amount of URL call per template
              </span>
              <div class="go-back-button"><a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset">Go Back</a></div>
            </h2>
            <div class="inside">
            <div class="main">
              <?php  $filterByDate = $_GET['filter'] ? $_GET['filter'] : ""; ?>
               Filter By (Month and Year) :
              <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
              <input type="submit" name="nm" value="Search" onclick="searchfilter();" required>
              <table border="1" class="tablewp">
              <thead>
              <tr>
                  <th>Template</th><th>Category</th><th>Count</th>
              </tr>
              </thead>
              <tbody>
              <?php
                  $filterByDate = $_GET['filter'] ? $_GET['filter'] : "";
                  $Listofcalled = UserReports::number_of_template();
                  $post_values = array();
                  if(!empty($Listofcalled)){
                  foreach($Listofcalled as $tmp){ 
                    $totalscalled = UserReports::url_per_template($tmp->term_id);
                    foreach($totalscalled as $callsItem){
                         $terms = wp_get_post_terms($callsItem['post_id'],'category');
                         $post_values[] = array( 
                         "temp_name"=> $tmp->name, 
                         "category"=> $terms[0]->name, 
                         "count" => UserReports::url_call_per_template_category($tmp->term_id,$terms[0]->term_id,$filterByDate),
                      );
                    }
                 }
                 $calls_array_values = array_unique($post_values, SORT_REGULAR);
                    $j=1;
                    $sum = 0;
                    $count = 0;
                    foreach($calls_array_values as $val){
                        $count+=$val['count'];
                    }
                    foreach($calls_array_values as $val){
                     $sum+=$val['count']; 
                    echo'<tr>';
                    echo'<td>'.$val['temp_name'].'</td>';
                    echo'<td>'.$val['category'].'</td>';
                    echo'<td>'.$val['count'].'</td>';
                    echo'</tr>';
                    $j++;
                    }
                    ?>
                <?php  } ?>
                  <tr><td>Total</td><td></td><td><?php echo $sum; ?></td></tr>
                </tbody>
              </table>
              <p class="custom_message"><?php if(!empty($filterByDate)){ ?> This report Showing monthly data 
              <?php } ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
     <?php  }
     if($_REQUEST['action']=='downloadtemp'){?>
      <div id="postbox-container-1" class="postbox-container">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">
            <h2 class="hndle ui-sortable-handle">
              <span>Amount of Downloads per template
              </span>
              <div class="go-back-button"><a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset">Go Back</a></div>
            </h2>
            <div class="inside">
              <div class="main">
              <?php  $filterByDate = $_GET['filter'] ? $_GET['filter'] : ""; ?>
               Filter By (Month and Year) :
              <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
              <input type="submit" name="nm" value="Search" onclick="searchfilter();" required>
              <table border="1" class="tablewp">
              <thead>
              <tr>
                  <th>Template</th><th>Category</th><th>Count</th>
              </tr>
              </thead>
              <tbody>
              <?php
                  $filterByDate = $_GET['filter'] ? $_GET['filter'] : "";
                  $Listofcalled = UserReports::number_of_template();
                  $post_values = array();
                  if(!empty($Listofcalled)){
                  foreach($Listofcalled as $tmp){ 
                    $totalscalled = UserReports::downloads_per_template($tmp->term_id);
                    foreach($totalscalled as $callsItem){
                         $terms = wp_get_post_terms($callsItem['post_id'],'category');
                         $post_values[] = array( 
                         "temp_name"=> $tmp->name, 
                         "category"=> $terms[0]->name, 
                         "count" => UserReports::downloads_per_template_category($tmp->term_id,$terms[0]->term_id,$filterByDate),
                      );
                    }
                 }
                 $calls_array_values = array_unique($post_values, SORT_REGULAR);
                    $j=1;
                    $sum = 0;
                    $count = 0;
                    foreach($calls_array_values as $val){
                        $count+=$val['count'];
                    }

                    foreach($calls_array_values as $val){
                     $sum+=$val['count']; 
                    echo'<tr>';
                    echo'<td>'.$val['temp_name'].'</td>';
                    echo'<td>'.$val['category'].'</td>';
                    echo'<td>'.$val['count'].'</td>';
                    echo'</tr>';
                    $j++;
                    }

                    ?>
                <?php  } ?>
                  <tr><td>Total</td><td></td><td><?php echo $sum; ?></td></tr>
                </tbody>
              </table>
              <p class="custom_message"><?php if(!empty($filterByDate)){ ?> This report Showing monthly data 
              <?php } ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
     <?php }
     if($_REQUEST['action']=='adspertemp'){?>
      <div id="postbox-container-1" class="postbox-container">
        <div id="normal-sortables" class="meta-box-sortables ui-sortable">
          <div id="dashboard_right_now" class="postbox postboxheight">
            <h2 class="hndle ui-sortable-handle">
              <span>Amount of ads calls per template Active
              </span>
              <div class="go-back-button"><a href="<?php echo site_url(); ?>/wp-admin/edit.php?post_type=assets&page=report_asset">Go Back</a></div>
            </h2>
            <div class="inside">
              <div class="main">
              <?php
              $filterByDate = $_GET['filter'] ? $_GET['filter'] : "";
              $datefilter = explode('-',$filterByDate);
              $y = $datefilter[0];
              $m = $datefilter[1];
              $d = $datefilter[2];
              $fullm = date('F', strtotime($filterByDate));
              ?>
              Filter By (Month and Year):
              <input type="month" id="month" name="searcfilter" value="<?php echo $filterByDate; ?>">
              <input type="submit" name="nm" value="Search" onclick="searchfilter();" required="required">

               <table border="1" class="tablewp">
              <thead>
              <tr>
               <th>Template</th><th>Category</th><th>Ad-Element</th><th>Clicked Count</th><th>Count</th>
              </tr>
              </thead>
              <tbody>
              <?php $addlisttemplate = UserReports::number_of_template(); 
              if(!empty($y) && !empty($m)){
              $datequery = array(
                array(
                    'year' => $y,
                    'month' =>$m
                     )
                ); 
               }
               else {
                $datequery = array();
               }
               $sum = 0;
               foreach($addlisttemplate as $tmp){
                $args = array(
                'post_type' => 'adds',
                'posts_per_page' =>-1,
                'post_status' => 'publish',
                'suppress_filters' => false,
                 'tax_query' => array(
                     'relation' => 'AND',
                    array(
                        'taxonomy' => 'asset-detail',
                        'field' => 'term_id',
                        'terms' => $tmp->term_id
                    ),
                )
              );
                $addsdata = get_posts($args);
                $post_values = array();

                foreach($addsdata as $item){
                 $terms = wp_get_post_terms($item->ID,'category');
                  $post_values[] = array( 
                    "temp_name"=> $tmp->name, 
                    "category"=> $terms[0]->name,
                    "term_id"=> $terms[0]->term_id,
                    "temp_id"=> $tmp->term_id,
                    "count" => UserReports::ads_calls_per_template_active($tmp->term_id,$terms[0]->term_id,$_GET['filter']),
                  ); 
                }
                $amtemp_array_values = array_unique($post_values, SORT_REGULAR);
                $count=1;
                
                if(!empty($amtemp_array_values)){
                    foreach($amtemp_array_values as $val){
                    //echo $val['term_id']; 
                     $ads_name = UserReports::list_per_category_items($val['temp_id'],$val['term_id'],$_GET['filter']); 

                    if($count==1){
                      $tem = $val['temp_name'];  
                    }
                    else {
                      $tem = "";  
                    }
                    $sum+=$val['count'];

                    echo'<tr>';
                    echo'<td>'.$tem.'</td>';
                    echo'<td>'.$val['category'].'</td>';
                    if(count($ads_name)>1){ echo'<td class="no-padding"><table width="100%" >'; 
                    foreach($ads_name as $add){ echo'<tr><td>'.get_the_title($add).'</td></tr>';} echo '</table></td>';
                    echo'<td class="no-padding"><table width="100%" >'; 
                    foreach($ads_name as $add){ 
                    echo'<tr><td>'.UserReports::ads_count_per_click_template($add,$val['temp_id'],$val['term_id'],$_GET['filter']).'</td></tr>';} echo '</table></td>';
                    } 
                    else {
                        echo'<td>'.get_the_title($ads_name[0]).'</td><td>'.UserReports::ads_call_per_template($add,$val['temp_id'],$val['term_id'],$_GET['filter']).'</td>';
                    }
                    echo'<td>'.$val['count'].'</td>';
                    echo'</tr>';

                    $count++;
                    }
                }
              }
               
              ?>
            <tr><td>Total</td><td></td><td></td><td></td><td><?php echo $sum; ?></td></tr>
             </tbody>
              </table>
                <p class="custom_message"><?php if(!empty($filterByDate)){ ?> This report Showing monthly data 
              <?php } ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
     <?php } ?>
     
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





