<?php 
/*
 * @Kaleshwar yadav
 * Check user plan
 */
 function check_subscription_plan($template_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . "subscription_plan";
    $user_id = get_current_user_id() ;
    $check_subscription = $wpdb->get_row("SELECT * FROM $table_name where user_id=$user_id and template_id='$template_id'");
    // count($check_subscription);
    // $expire_date = $check_subscription->plan_expire;
    // $today_date =   date('Y-m-d');
    // $exp  = strtotime($expire_date);
    // $td   = strtotime($today_date);
    if(count($check_subscription)==0){
      $active = 0;
    }
    else {
      $active = 1;
    }
    return $active;

   }

  function UserPurchaged_Plan($plan_id){
    global $wpdb;
    $table_name = $wpdb->prefix . "subscription_plan";
    $user_id = get_current_user_id() ;
    $result = $wpdb->get_row("SELECT * FROM $table_name where user_id=$user_id and plan_id='$plan_id'");
    return $result->plan_id;
    }

function CheckPlanforAsset($template_id,$user_id){
    global $wpdb;
    $table_name = $wpdb->prefix . "subscription_plan";
    $result = $wpdb->get_row("SELECT plan_id FROM $table_name where user_id=$user_id and template_id='$template_id'");
    return $result->plan_id;
}

function CheckPlanAssetsViewPost($template_id){
    global $wpdb;
    $table_name = $wpdb->prefix . "subscription_plan";
    $result = $wpdb->get_row("SELECT plan_id FROM $table_name where template_id='$template_id'");
    return $result->plan_id;
}



