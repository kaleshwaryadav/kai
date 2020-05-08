<?php 
/*
 * @Kaleshwar yadav
 * Check favorite asset
 */
 function check_favoriteAsset($assetID) {
    global $wpdb;
    $table_name = $wpdb->prefix . "favorite_asset";
    $user_id = get_current_user_id() ;
    $result = $wpdb->get_row("SELECT * FROM $table_name where user_id=$user_id and post_id = '$assetID'");
    if($result->status==1){
      $active = 1;
    }
    else if($result->status==0) {
      $active = 0;
    }
    return $active;
    die(0);
   }


/*
 * @Kaleshwar yadav
 * User favorite list
 */

 function CheckUserFavorites(){
    global $current_user,$wpdb;
    $table_name = $wpdb->prefix . "favorite_asset";
    $user_id = get_current_user_id() ;
    $all_favorites = $wpdb->get_results("SELECT * FROM $table_name where user_id=$user_id", ARRAY_A);
    $ids = array();
    if(!empty($all_favorites)){
      foreach($all_favorites as $favoriteID){
        $ids[] = $favoriteID['post_id'];
      }
    }
    if(count($ids)>0){ $result= $ids; } else { $result= 'false'; }
    return $result;
 }

/*
 * @Kaleshwar yadav
 * User notes  Person to owner regarding asset
 */
function GetContactToAssetOwnerLogs($postid, $type){
    global $current_user,$wpdb;
    $table_name = $wpdb->prefix . "user_asset_accesslevel";
    $user_id = get_current_user_id() ;
    $GetContactToAssetOwner = $wpdb->get_results("SELECT * FROM $table_name where post_id = '$postid' and type='$type' and user_id NOT IN ($user_id) ORDER BY id DESC", ARRAY_A);
    return $GetContactToAssetOwner;
}

function GetUserNotes($postid, $type){
    global $current_user,$wpdb;
    $table_name = $wpdb->prefix . "user_asset_accesslevel";
    $user_id = get_current_user_id() ;
    $UserNotes = $wpdb->get_results("SELECT * FROM $table_name where post_id = '$postid' and type='$type' and user_id = '$user_id' ORDER BY id DESC", ARRAY_A);
    return $UserNotes;
}

