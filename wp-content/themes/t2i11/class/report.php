<?php
class UserReports{
    
    function ActiveUsers()
        {
        global $current_user, $wpdb;
        $table_name = $wpdb->prefix . "users";
        $is_active = $wpdb->get_results("SELECT * FROM $table_name");
        return $is_active;
        }

        public static function register_user_perMonth()
        {
        global $current_user, $wpdb;
        $table_name = $wpdb->prefix . "users";
        $monthly_data = $wpdb->get_results("SELECT  `user_registered` , COUNT(ID) as total  FROM $table_name GROUP BY MONTH(  `user_registered` ) ORDER BY ID Desc",ARRAY_A);
         return $monthly_data;
        }

        public static function number_of_template()
        {
        global $current_user, $wpdb;
        $TemplateList = get_terms( 'asset-detail', array(
                    'hide_empty' => false,
                    ) );
        return $TemplateList;
        }

        public static function opened_asset_per_template($template_id,$cateid,$filterByDate)
        {
          global $wpdb;
          $table_name = $wpdb->prefix . "asset_views";
          $datefilter = explode('-',$filterByDate);
          $y = $datefilter['0'];
          $m = $datefilter['1'];

          if(!empty($filterByDate) && !empty($y) && !empty($m)){
            $where = "and YEAR(date) ='$y' AND MONTH(date) ='$m'";
            }
           $opened = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
           $totalOpen = count($opened);
           return $totalOpen;
          }


          public static function realproduct($template_id,$cateid,$filterByDate) {
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
                            'terms' => 7
                        ),
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => 21,
                        ),
                    )
               );
           $rel = get_post($args);
           echo'total'. count($rel);
          }


          // It is used for Real User asset per template
          public static function RealUsedAssetPerTemplate($template_id,$cateid,$filterByDate)
            {
              global $wpdb;
              $table_view     = $wpdb->prefix . "asset_views";
              $table_clone    = $wpdb->prefix . "cloning_assert";
              $table_favorite = $wpdb->prefix . "favorite_asset";
              $table_download = $wpdb->prefix . "download_asset";
              $table_report   = $wpdb->prefix . "click_report";
              $table_message  = $wpdb->prefix . "asset_message";
              $table_ads      = $wpdb->prefix . "ads_click";
              $table_share    = $wpdb->prefix . "share_asset";
              $table_remainder    = $wpdb->prefix . "remainder";
              $TotalRealAsset = 0;
              $datefilter = explode('-',$filterByDate);
              $y = $datefilter['0'];
              $m = $datefilter['1'];
               $args = array(
                    'post_type' => 'assets',
                    'posts_per_page' =>-1,
                    'post_status' => 'publish',
                    'tax_query' => array(
                         'relation' => 'AND',
                        array(
                            'taxonomy' => 'asset-detail',
                            'field' => 'term_id',
                            'terms' => array($template_id)
                        ),
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => array($cateid),
                        ),
                    )
               );
               $TotalRealAsset = 0;
               $total =  get_posts($args);
               $data = array(); 
               $cnt = 1;
               if(!empty($filterByDate) && !empty($y) && !empty($m)){
                 $where = "and YEAR(date ) ='$y' AND MONTH(date) ='$m'";
               }

               foreach($total as $postid){
                $data[] = $postid->ID;
                  $post_ids = $postid->ID;
                   $Sql ="SELECT DISTINCT template_id, category_id, post_id,date
                    FROM (
                    SELECT template_id AS template_id, category_id AS category_id, DATE AS DATE, post_id AS post_id
                    FROM $table_share
                    UNION ALL 
                    SELECT template_id, category_id, DATE, post_id
                    FROM $table_clone
                    UNION ALL 
                    SELECT template_id, category_id, DATE, post_id
                    FROM $table_remainder
                    UNION ALL 
                    SELECT template_id, category_id, DATE, post_id
                    FROM $table_message
                    UNION ALL 
                    SELECT template_id, category_id, DATE, post_id
                    FROM $table_report
                    UNION ALL 
                    SELECT template_id, category_id, DATE, post_id
                    FROM $table_download
                    UNION ALL 
                    SELECT template_id, category_id, DATE, post_id
                    FROM $table_favorite
                    )a
                    WHERE template_id = $template_id AND category_id = $cateid AND post_id = $post_ids $where";
                    $clone = $wpdb->get_row($Sql, ARRAY_A);
                    if(is_array($clone)){
                     $tem_total = $cnt++; 
                     $TotalRealAsset = $tem_total ? $tem_total : 0;
                 }
              }
              
              return $TotalRealAsset;
           }

        public static function per_category_assets($tempid,$catid,$filterByDate)
        {
          global $current_user, $wpdb;
          $datefilter = explode('-',$filterByDate);
              $y = $datefilter[0];
              $m = $datefilter[1];
              $fullm = date('F', strtotime($filterByDate));
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
              $args = array(
                    'post_type' => 'assets',
                    'posts_per_page' =>-1,
                    'post_status' => 'publish',
                    'date_query'=> $datequery,
                    'tax_query' => array(
                         'relation' => 'AND',
                        array(
                            'taxonomy' => 'asset-detail',
                            'field' => 'term_id',
                            'terms' => array($tempid)
                        ),
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => array($catid),
                        ),
                    )
               );
                $total =  new WP_Query($args);
                $count = $total->post_count;
                return $count;
                
        }


       public static function callurl($tempid,$catid,$filterByDate)
        {
        global $current_user, $wpdb;
        $datefilter = explode('-',$filterByDate);
              $y = $datefilter[0];
              $m = $datefilter[1];
              // $d = $datefilter[2];
              $fullm = date('F', strtotime($filterByDate));
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
              $args = array(
                    'post_type' => 'assets',
                    'posts_per_page' =>-1,
                    'post_status' => 'publish',
                    'date_query'=> $datequery,
                    'tax_query' => array(
                         'relation' => 'AND',
                        array(
                            'taxonomy' => 'asset-detail',
                            'field' => 'term_id',
                            'terms' => array($tempid)
                        ),
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => array($catid),
                        ),
                    )
               );
                $total = get_posts($args);
                $ids = array();
                if(!empty($total)){
                    foreach($total as $p){
                     $ids[] = $p->ID.'<br>';
                    }
                }

                $postid = array_unique($ids);
                foreach($postid as $id){
                    echo $id;
                      $count_key = 'wpb_post_views_count';
                    //echo get_post_meta($id, $count_key, true).'<br>';
                }
                      
                
        }


       public static function per_template_assets($term_id)
          {
            $args = array(
            'post_type' => 'assets',
            'posts_per_page' =>-1,
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'asset-detail',
                    'field' => 'term_id',
                    'terms' => $term_id
                )
            )
        );
         $total =  new WP_Query($args);
         $count = $total->post_count;
         return $count;
        }

        public static function amt_of_called_asset_per_template($term_id)
             {
                $args = array(
                'post_type' => 'assets',
                'posts_per_page' =>-1,
                'post_status' => 'publish',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'asset-detail',
                        'field' => 'term_id',
                        'terms' => $term_id
                    )
                )
        );
         $total =  new WP_Query($args);
         $count = $total->post_count;
         return $count;
        }
        /*
         * real used to per template 
         */
        public static function real_used_asset_per_template($term_id)
        {
            $args = array(
            'post_type' => 'assets',
            'posts_per_page' =>-1,
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'asset-detail',
                    'field' => 'term_id',
                    'terms' => $term_id
                )
            )
        );
         $total =  new WP_Query($args);
         $count = $total->post_count;
         return $count;
        }

        /*
         * Used to share per template 
         */
        public static function share_per_template($template_id)
        {
           global $current_user, $wpdb;
           $table_name = $wpdb->prefix . "share_asset";
           $sharedata = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id",ARRAY_A);
           return $sharedata;
        }

        public static function share_per_template_category($template_id,$cateid,$filter)
        {
           global $current_user, $wpdb; 
           $table_name = $wpdb->prefix . "share_asset";
           
           $data = explode('-',$filter);
           $y = $data['0'];
           $m = $data['1'];
           if(!empty($filter) && !empty($y) && !empty($m)){
           $where = "and YEAR(date ) ='$y' AND MONTH(date) ='$m'";
           }
           //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where";
          $sharedata = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
            $totalCat = count($sharedata);
           return $totalCat;
         
        }


        public static function clone_per_template($template_id)
        {
           global $current_user, $wpdb;
           $table_name = $wpdb->prefix . "cloning_assert";
           //echo "SELECT * FROM $table_name where template_id=$template_id";
           $sharedata = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id",ARRAY_A);
           return $sharedata;
        }

        /*
         * Used to clones per template 
         */
        public static function clones_per_template_category($template_id,$cateid,$filter)
        {
           global $current_user, $wpdb;
           $table_name = $wpdb->prefix . "cloning_assert";
           
           $data = explode('-',$filter);
           $y = $data['0'];
           $m = $data['1'];
           if(!empty($filter) && !empty($y) && !empty($m)){
           $where = "and YEAR(date ) ='$y' AND MONTH(date) ='$m'";
           }
           //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where";
          $sharedata = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
            $totalCat = count($sharedata);
           return $totalCat;
        }

         public static function favorite_per_template($template_id)
          {
           global $current_user, $wpdb;
           $table_name = $wpdb->prefix . "favorite_asset";
           $sharedata = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id",ARRAY_A);
           return $sharedata;
          }

        /*
         * Used to favorite per template 
         */
        public static function favorite_per_template_category($template_id,$cateid,$filter)
        {
               global $current_user, $wpdb;
               $table_name = $wpdb->prefix . "favorite_asset";
               
               $data = explode('-',$filter);
               $y = $data['0'];
               $m = $data['1'];
               if(!empty($filter) && !empty($y) && !empty($m)){
               $where = "and YEAR(date) ='$y' AND MONTH(date) ='$m'";
               }
               //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where";
              $data = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
                $totalCat = count($data);
               return $totalCat;
       
        }


         public static function reminders_per_template($template_id)
          {
           global $current_user, $wpdb;
           $table_name = $wpdb->prefix . "remainder";
           $sharedata = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id",ARRAY_A);
           return $sharedata;
          }

        /*
         * Used to reminders per template 
         */
        public static function reminders_per_template_category($template_id,$cateid,$filter)
        {

        global $current_user, $wpdb;
               $table_name = $wpdb->prefix . "remainder";
               
               $data = explode('-',$filter);
               $y = $data['0'];
               $m = $data['1'];
               if(!empty($filter) && !empty($y) && !empty($m)){
               $where = "and YEAR(date) ='$y' AND MONTH(date) ='$m'";
               }
               //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where";
              $data = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
                $totalCat = count($data);
               return $totalCat;
        }


        public static function url_per_template($template_id)
          {
           global $current_user, $wpdb;
           $table_name = $wpdb->prefix . "track_links";
           $sharedata = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id",ARRAY_A);
           return $sharedata;
          }


        /*
         * Used to URL clicked per template 
         */
        public static function url_call_per_template_category($template_id,$cateid,$filter)
        {
        global $current_user, $wpdb;
               $table_name = $wpdb->prefix . "track_links";
               
               $data = explode('-',$filter);
               $y = $data['0'];
               $m = $data['1'];
               if(!empty($filter) && !empty($y) && !empty($m)){
               $where = "and YEAR(date) ='$y' AND MONTH(date) ='$m'";
               }
               //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where";
              $data = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
                $totalCat = count($data);
               return $totalCat;
        }


         public static function downloads_per_template($template_id)
          {
           global $current_user, $wpdb;
           $table_name = $wpdb->prefix . "download_asset";
           $data = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id",ARRAY_A);
           return $data;
          }

        /*
         * Used to downloads clicked per template 
         */
        public static function downloads_per_template_category($template_id,$cateid,$filter)
        {
               global $current_user, $wpdb;
               $table_name = $wpdb->prefix . "download_asset";
               
               $data = explode('-',$filter);
               $y = $data['0'];
               $m = $data['1'];
               if(!empty($filter) && !empty($y) && !empty($m)){
               $where = "and YEAR(date) ='$y' AND MONTH(date) ='$m'";
               }
               //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where";
              $data = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
                $totalCat = count($data);
               return $totalCat;
       
        }

        /*
         * Used to check amout of add calls per template
         */
        public static function ads_calls_per_template_active($tempid,$catid,$filterByDate)
        {
              global $current_user, $wpdb;
              $datefilter = explode('-',$filterByDate);
              $y = $datefilter[0];
              $m = $datefilter[1];
              $fullm = date('F', strtotime($filterByDate));
              if(!empty($y) && !empty($m)){
              $datequery = array(
                array(
                        'year'  => $y,
                        'month' => $m,
                    ),
                ); 
               }
               else {
                $datequery = array();
               }
                 $args = array(
                    'post_type' => 'adds',
                    'posts_per_page' =>-1,
                    'post_status' => 'publish',
                    'date_query'=> $datequery,
                    'tax_query' => array(
                         'relation' => 'AND',
                        array(
                            'taxonomy' => 'asset-detail',
                            'field' => 'term_id',
                            'terms' => array($tempid)
                        ),
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => array($catid),
                        ),
                    )
               );
                $total =  new WP_Query($args);
                $count = $total->post_count;
                return $count;
        
        }

        /*
         * Used to list ads per category
         */
        public static function list_per_category_items($tempid,$catid,$filterByDate)
        {
              global $current_user, $wpdb;
              $datefilter = explode('-',$filterByDate);
              $y = $datefilter[0];
              $m = $datefilter[1];
              $fullm = date('F', strtotime($filterByDate));
              if(!empty($y) && !empty($m)){
              $datequery = array(
                array(
                        'year'  => $y,
                        'month' => $m,
                    ),
                ); 
               }
               else {
                $datequery = array();
               }
                 $args = array(
                    'post_type' => 'adds',
                    'posts_per_page' =>-1,
                    'post_status' => 'publish',
                    'date_query'=> $datequery,
                    'tax_query' => array(
                         'relation' => 'AND',
                        array(
                            'taxonomy' => 'asset-detail',
                            'field' => 'term_id',
                            'terms' => array($tempid)
                        ),
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => array($catid),
                        ),
                    )
               );
                $itemList =  get_posts($args);
                $ads= array();
                foreach($itemList as $item){
                   $ads[] = $item->ID;
                   
                }
               return $ads;
        
        }


        // Over all reposrt section start from Here
        /*
         * used to get used category per template 
         */
        public static function get_used_categorybytemplate($category_id){
                $post_values = array();
                 $catarg = array(
                'post_type' => 'assets',
                'posts_per_page' =>-1,
                'post_status' => 'publish',
                'suppress_filters' => false,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'asset-detail',
                        'field' => 'term_id',
                        'terms' => $category_id
                    )
                )
                );
                $categoryarg = get_posts($catarg);
                 if($categoryarg){
                    foreach($categoryarg as $postids){
                         $terms = wp_get_post_terms($postids->ID,'category');
                         $post_values[] = array( 
                         "category"=> $terms[0]->name,
                         "term_id"=> $terms[0]->term_id,  
                         );
                     }
                }


        $categoryList = array_unique($post_values, SORT_REGULAR);
        return $categoryList;
    }

        /*
         * ads calling per template 
         */
        public static function ads_call_per_template($postid,$template_id,$cateid,$filter)
        {   
               global $current_user, $wpdb;
               $table_name = $wpdb->prefix . "ads_click";
               
               $data = explode('-',$filter);
               $y = $data['0'];
               $m = $data['1'];
               if(!empty($filter) && !empty($y) && !empty($m)){
               $where = "and YEAR(date) ='$y' AND MONTH(date) ='$m'";
               }
               // echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid and post_id=$postid $where";
              $data = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid  $where", ARRAY_A);
                $totalCat = count($data);
               return $totalCat;
       
        }

        /*
         * ads calling per template 
         */
        public static function ads_count_per_click_template($postid,$template_id,$cateid,$filter)
        {   
               global $current_user, $wpdb;
               $table_name = $wpdb->prefix . "ads_click";
               
               $data = explode('-',$filter);
               $y = $data['0'];
               $m = $data['1'];
               if(!empty($filter) && !empty($y) && !empty($m)){
               $where = "and YEAR(date) ='$y' AND MONTH(date) ='$m'";
               }
              $data = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid and post_id=$postid $where", ARRAY_A);
                $totalCat = count($data);
               return $totalCat;
       
        }



   /*
    * opened asset per category
    * @author:kaleshwar
    */
   public static function open_asset_perCategory($tempid,$category_id){

    $args = array(
                'post_type' => 'assets',
                'posts_per_page' =>-1,
                'post_status' => 'publish',
                'tax_query' => array(
                     'relation' => 'AND',
                    array(
                        'taxonomy' => 'asset-detail',
                        'field' => 'term_id',
                        'terms' => array($tempid)
                    ),
                    array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => array($category_id),
                    ),
                    )
               );
           $count =  count(get_posts($args));

      return $count ? $count :0;
   }

   /*
    * opened asset per category
    * @author:kaleshwar
    */
   public static function overall_open_asset_perCategory($template_id,$cateid,$filter){

           global $current_user, $wpdb; 
           $table_name = $wpdb->prefix . "asset_views";
           $data = explode('-',$filter);
           $y = $data['0'];
           $m = $data['1'];
           if(!empty($filter) && !empty($y) && !empty($m)){
           $where = "and  YEAR(date ) ='$y' AND MONTH(date) ='$m'";
           }
           //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid";
          $sharedata = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
            $totalCat = count($sharedata);
           return $totalCat;
   }



   /*
    * Open how many times opened asset per category
    * @author:kaleshwar
    */
   public static function open_url_perCategory($tempid,$category_id){

    $args = array(
                'post_type' => 'assets',
                'posts_per_page' =>-1,
                'post_status' => 'publish',
                'tax_query' => array(
                     'relation' => 'AND',
                    array(
                        'taxonomy' => 'asset-detail',
                        'field' => 'term_id',
                        'terms' => array($tempid)
                    ),
                    array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => array($category_id),
                    ),
                    )
               );
      $data =  get_posts($args);


      $count = 0;
      if(!empty($data)){
        foreach($data as $item){
             $count_key = 'wpb_post_views_count';
             $toaltviewed = get_post_meta($item->ID, $count_key, true);
             $count+=$toaltviewed;
        }
      }
      return $count ? $count :0;
   }


    /*
    * Open how many times opened asset per category
    * @author:kaleshwar
    */
   public static function overall_open_url_perCategory($template_id,$cateid,$filter){

    global $current_user, $wpdb; 
           $table_name = $wpdb->prefix . "track_links";
           
           $data = explode('-',$filter);
           $y = $data['0'];
           $m = $data['1'];
           if(!empty($filter) && !empty($y) && !empty($m)){
             $where = "and  YEAR(date ) ='$y' AND MONTH(date) ='$m'";
           }
           //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid";
          $sharedata = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
            $totalCat = count($sharedata);
           return $totalCat;
   }


   /*
    * Open how many times opened asset per category
    * @author:kaleshwar
    */

    public static function overall_share_template_category($template_id,$cateid,$filter)
        {
           global $current_user, $wpdb; 
           $table_name = $wpdb->prefix . "share_asset";
           
           $data = explode('-',$filter);
           $y = $data['0'];
           $m = $data['1'];
           if(!empty($filter) && !empty($y) && !empty($m)){
           $where = "and  YEAR(date ) ='$y' AND MONTH(date) ='$m'";
           }
           //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid";
          $sharedata = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
            $totalCat = count($sharedata);
           return $totalCat;
         
        }

     /*
         * Used to downloads clicked per template 
         */
        public static function overall_down_per_template_category($template_id,$cateid,$filter)
        {
               global $current_user, $wpdb;
               $table_name = $wpdb->prefix . "download_asset";
               
               $data = explode('-',$filter);
               $y = $data['0'];
               $m = $data['1'];
               if(!empty($filter) && !empty($y) && !empty($m)){
               $where = "and  YEAR(date) ='$y' AND MONTH(date) ='$m'";
               }
              // echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid";
              $data = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
                $totalCat = count($data);
               return $totalCat;
       
        }

         /*
         * Used to favorite per template 
         */
        public static function overall_favorite_category($template_id,$cateid,$filter)
        {
               global $current_user, $wpdb;
               $table_name = $wpdb->prefix . "favorite_asset";
               
               $data = explode('-',$filter);
               $y = $data['0'];
               $m = $data['1'];
               if(!empty($filter) && !empty($y) && !empty($m)){
               $where = "and  YEAR(date) ='$y' AND MONTH(date) ='$m'";
               }
               //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid";
              $data = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
                $totalCat = count($data);
               return $totalCat;
       
        }

        /*
         * Used to favorite per template 
         */
        public static function overall_message_per_category($template_id,$cateid,$filter)
        {
               global $current_user, $wpdb;
               $table_name = $wpdb->prefix . "asset_message";
               $data = explode('-',$filter);
               $y = $data['0'];
               $m = $data['1'];
               if(!empty($filter) && !empty($y) && !empty($m)){
               $where = "and  YEAR(date) ='$y' AND MONTH(date) ='$m'";
               }
               //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid";
              $data = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
                $totalCat = count($data);
               return $totalCat;
       
        }

        /*
         * Used to get overall clones per category 
         */
        public static function overall_clones_per_category($template_id,$cateid,$filter)
        {
           global $current_user, $wpdb;
           $table_name = $wpdb->prefix . "cloning_assert";
           $data = explode('-',$filter);
           $y = $data['0'];
           $m = $data['1'];
           if(!empty($filter) && !empty($y) && !empty($m)){
           $where = "and  YEAR( date ) ='$y' AND MONTH(date) ='$m'";
           }
           //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where";
          $overalclone = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
            $totalCat = count($overalclone);
           return $totalCat;
        }

         /*
         * Used to reminders per template 
         */
        public static function overall_reminders_per_category($template_id,$cateid,$filter)
        {

        global $current_user, $wpdb;
               $table_name = $wpdb->prefix . "remainder";
               
               $data = explode('-',$filter);
               $y = $data['0'];
               $m = $data['1'];
               if(!empty($filter) && !empty($y) && !empty($m)){
               $where = "and  YEAR(date) ='$y' AND MONTH(date) ='$m'";
               }
               //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where";
              $data = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where", ARRAY_A);
                $totalCat = count($data);
               return $totalCat;
        }


        /*
         * Used to reminders per template 
         */
        public static function report_per_template($template_id,$cateid,$filter)
        {
               global $current_user, $wpdb;
               $table_name = $wpdb->prefix . "click_report";
               $data = explode('-',$filter);
               $y = $data['0'];
               $m = $data['1'];
               if(!empty($filter) && !empty($y) && !empty($m)){
               $where = "and  YEAR(date) ='$y' AND MONTH(date) ='$m'";
               }
               //echo "SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where";
              $data = $wpdb->get_results("SELECT * FROM $table_name where template_id=$template_id and category_id=$cateid $where ", ARRAY_A);
                $totalCat = count($data);
               return $totalCat;
        }


   public static function PlanName($tempid){
    $args = array(
                'post_type' => 'assets',
                'posts_per_page' =>-1,
                'post_status' => 'publish',
                'tax_query' => array(
                     'relation' => 'AND',
                    array(
                        'taxonomy' => 'asset-detail',
                        'field' => 'term_id',
                        'terms' => array($tempid)
                    ),
                    )
               );
    $val = $tempid;
    return $val;
   }

 public static function invoice_report_user(){
        global $current_user, $wpdb;
        $table_name = $wpdb->prefix . "users";
        $reports    = $wpdb->get_results("SELECT * FROM $table_name");
        return $reports;
   }

public static function frontend_report_of_user($userid){
    global $current_user, $wpdb;
    $table_name = $wpdb->prefix . "posts";
    //echo"SELECT * FROM $table_name WHERE post_type='assets' and post_author=$userid";
    $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE post_type='assets' and post_author=$userid and post_status='publish' order by ID ASC");
    return $user_report;
}

 public static function report_of_current_month($userid){
        global $current_user, $wpdb;
        $table_name = $wpdb->prefix . "posts";
       //echo"SELECT * FROM $table_name WHERE post_type='assets' and post_author=$userid and `post_date` >= ( CURDATE( ) - INTERVAL 1 MONTH";
        $sql = "SELECT * FROM $table_name WHERE post_type='assets' and post_author=$userid and post_status='publish' order by ID ASC";
        //echo $sql;
        $user_report = $wpdb->get_results($sql);
        return $user_report;
 }

 public static function filter_by_month_year($y,$m,$userid){

       global $current_user, $wpdb;
       $table_name = $wpdb->prefix . "posts";
       $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE post_type='assets' AND post_author =$userid AND post_status='publish' order by ID ASC");
       return $user_report;
 }

  public static function front_filter_by_month_year($y,$m,$userid){

       global $current_user, $wpdb;
       $table_name = $wpdb->prefix . "posts";
       $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE post_type='assets' AND post_author =$userid AND post_status='publish' order by ID ASC");
       return $user_report;
 }

 public static function user_cloning_permonth($userid, $post_id, $filterByDate = array()){
       global $current_user, $wpdb;
       $table_name = $wpdb->prefix . "cloning_assert";
       if(!empty($filterByDate)){
        $datefilter = explode('-',$filterByDate);
       $y = $datefilter[0];
       $m = $datefilter[1];
       $d = $datefilter[2];
       $sql = "SELECT * FROM $table_name WHERE `assert_clone_id` = $post_id AND YEAR(date ) =$y AND MONTH(date ) =$m";       
       $user_report = $wpdb->get_results($sql);
       return $user_report;
      }
      else 
      {
      // $sql = "SELECT * FROM $table_name WHERE `assert_clone_id` = $post_id and `date` >= ( CURDATE( ) - INTERVAL 1 MONTH)";
      //echo $sql; 
      $sql = "SELECT * FROM $table_name WHERE `assert_clone_id` = $post_id";
      $user_report = $wpdb->get_results($sql);
       return $user_report;
      }
       
 }

  public static function asset_shared_by_user($userid, $post_id, $filterByDate = array()){
       global $current_user, $wpdb;
       $table_name = $wpdb->prefix . "share_asset";
       if(!empty($filterByDate)){
        $datefilter = explode('-',$filterByDate);
       $y = $datefilter[0];
       $m = $datefilter[1];
       $d = $datefilter[2];
       $sql = "SELECT * FROM $table_name WHERE `post_id` = $post_id AND YEAR(date ) =$y AND MONTH(date ) =$m";
       //echo $sql;
       //die;
       $user_report = $wpdb->get_results($sql);

       return $user_report;
      }
      else 
      {
      $sql = "SELECT * FROM $table_name WHERE `post_id` = $post_id";
      //$sql = "SELECT * FROM $table_name WHERE `post_id` = $post_id and `date` >= ( CURDATE( ) - INTERVAL 1 MONTH)";
      $user_report = $wpdb->get_results($sql);
       return $user_report;
      }
 }

 public static function asset_favoritebyuser($userid, $post_id, $filterByDate = array()){
       global $current_user, $wpdb;
       $table_name = $wpdb->prefix . "favorite_asset";
       if(!empty($filterByDate)){
        $datefilter = explode('-',$filterByDate);
       $y = $datefilter[0];
       $m = $datefilter[1];
       $d = $datefilter[2];

       $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE `post_id` = $post_id AND YEAR(date) =$y AND MONTH(date) =$m");
       return $user_report;
      }
      else 
      {
      $sql = "SELECT * FROM $table_name WHERE `post_id` = $post_id";
      //$sql = "SELECT * FROM $table_name WHERE `post_id` = $post_id and `date` >= ( CURDATE( ) - INTERVAL 1 MONTH)";
      $user_report = $wpdb->get_results($sql);
      return $user_report;
      }
}
 public static function asset_reminderbyuser($userid, $post_id, $filterByDate = array()){
       global $current_user, $wpdb;
       $table_name = $wpdb->prefix . "remainder";
       if(!empty($filterByDate)){
        $datefilter = explode('-',$filterByDate);
       $y = $datefilter[0];
       $m = $datefilter[1];
       $d = $datefilter[2];

       $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE `post_id` = $post_id AND YEAR(date) =$y AND MONTH(date) =$m");

       return $user_report;
      }
      else 
      {
      $sql = "SELECT * FROM $table_name WHERE `post_id` = $post_id"; 
      $user_report = $wpdb->get_results($sql);
      // $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE `post_id` = $post_id and `date` >= ( CURDATE( ) - INTERVAL 1 MONTH)");
       return $user_report;
      }
}

public static function asset_calledbyuser($userid, $post_id, $filterByDate = array()){
       global $current_user, $wpdb;
       $table_name = $wpdb->prefix . "track_links";
       if(!empty($filterByDate)){
        $datefilter = explode('-',$filterByDate);
       $y = $datefilter[0];
       $m = $datefilter[1];
       $d = $datefilter[2];

       $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE `post_id` = $post_id AND YEAR(date) =$y AND MONTH(date) =$m");
       return $user_report;
      }
      else 
      {
      // $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE `post_id` = $post_id and `date` >= ( CURDATE( ) - INTERVAL 1 MONTH)");
      //  return $user_report;
      $sql = "SELECT * FROM $table_name WHERE `post_id` = $post_id"; 
      $user_report = $wpdb->get_results($sql);
      // $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE `post_id` = $post_id and `date` >= ( CURDATE( ) - INTERVAL 1 MONTH)");
       return $user_report;
      }
}

public static function asset_downloadedbyuser($userid, $post_id, $filterByDate = array()){
       global $current_user, $wpdb;
       $table_name = $wpdb->prefix . "download_asset";
       if(!empty($filterByDate)){
        $datefilter = explode('-',$filterByDate);
       $y = $datefilter[0];
       $m = $datefilter[1];
       $d = $datefilter[2];

       $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE `post_id` = $post_id AND YEAR(date) =$y AND MONTH(date) =$m");
       return $user_report;
      }
      else 
      {
      // $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE `post_id` = $post_id and `date` >= ( CURDATE( ) - INTERVAL 1 MONTH)");
      //  return $user_report;
      $sql = "SELECT * FROM $table_name WHERE `post_id` = $post_id"; 
      $user_report = $wpdb->get_results($sql);
      return $user_report;
      }
}

public static function asset_reportbyuser($userid, $post_id, $filterByDate = array()){
       global $current_user, $wpdb;
       $table_name = $wpdb->prefix . "click_report";
       if(!empty($filterByDate)){
        $datefilter = explode('-',$filterByDate);
       $y = $datefilter[0];
       $m = $datefilter[1];
       $d = $datefilter[2];

       $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE `user_id`=$userid  AND `post_id` = $post_id AND YEAR(date) =$y AND MONTH(date) =$m");
       return $user_report;
      }
      else 
      {
      // $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE `user_id`=$userid  AND `post_id` = $post_id and `date` >= ( CURDATE( ) - INTERVAL 1 MONTH)");
      //  return $user_report;
      $sql = "SELECT * FROM $table_name WHERE `post_id` = $post_id"; 
      $user_report = $wpdb->get_results($sql);
      return $user_report;
      }
}

public static function Asset_SentMsgByUser($userid, $post_id, $filterByDate = array()){
       global $current_user, $wpdb;
       $table_name = $wpdb->prefix . "asset_message";
       if(!empty($filterByDate)){
        $datefilter = explode('-',$filterByDate);
       $y = $datefilter[0];
       $m = $datefilter[1];
       $d = $datefilter[2];

       $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE `post_id` = $post_id AND YEAR(date) =$y AND MONTH(date) =$m");
       return $user_report;
      }
      else 
      {
      // $user_report = $wpdb->get_results("SELECT * FROM $table_name WHERE `post_id` = $post_id and `date` >= ( CURDATE( ) - INTERVAL 1 MONTH)");
      //  return $user_report;
      $sql = "SELECT * FROM $table_name WHERE `post_id` = $post_id"; 
      $user_report = $wpdb->get_results($sql);
      return $user_report;
      }
}


public static function open_by_referal_urls($userid,$post_id, $filterByDate = array()){
       global $current_user, $wpdb;
       $table_name = $wpdb->prefix . "asset_views";

        $datefilter = explode('-',$filterByDate);
       $y = $datefilter[0];
       $m = $datefilter[1];
       $d = $datefilter[2];

        if(!empty($filterByDate) && !empty($y) && !empty($m)){
           $where = "and YEAR(date ) ='$y' AND MONTH(date) ='$m'";
           // $where = "and YEAR(date ) ='$y' AND MONTH(date) ='$m'";
        }

       $sql = "SELECT * FROM $table_name WHERE `post_id` = $post_id $where";
       $user_report = $wpdb->get_results($sql);
       return $user_report;

}


public static function get_current_subscription_data($subs_id,$field){
  switch ($field) {
    case 'open_asset':
      $value = get_post_meta($subs_id,'open_asset',true);     
      break;
    case 'clones':
      $value = get_post_meta($subs_id,'clone-costs',true);     
      break;
    case 'shares':
      $value = get_post_meta($subs_id,'share_costs',true); 
      break;
    case 'favorits':
      $value = get_post_meta($subs_id,'favorites_costs',true); 
      break;
    case 'reminder':
      $value = get_post_meta($subs_id,'reminder-costs',true); 
      break;    
    case 'url_calls':
      $value = get_post_meta($subs_id,'url_call',true); 
      break;
    case 'downloads':
      $value = get_post_meta($subs_id,'download_costs',true); 
      break;
    case 'report_called':
      $value = get_post_meta($subs_id,'reports_costs',true); 
      break;
    case 'message_costs':
      $value = get_post_meta($subs_id,'message_costs',true); 
      break;
    default:
      # code...
      break;
  }
  return $value;
}

}
new UserReports();
?>