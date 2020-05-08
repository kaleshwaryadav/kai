<?php
/*
 * Template Name: Technical Image Template
 */

get_header(); 
if(!is_user_logged_in()) {
$url = esc_url( home_url( '/' ) );?>
<script>
 document.location.href = "<?php echo $url;  ?>";
</script>
<?php } ?>
<!-- main-body section starts here -->
<?php 
if(!empty($_REQUEST['cloning'])=='done'){
    $asset_title = get_field('asset_title','option');
    $asset_name  = get_field('asset_name','option');
    $assert_desc = strip_tags(get_field('asset_short_description','option'));
    $full_desc   = get_field('asset_full_description','option');
    $bannerImag  = get_field('asset_banner_image','option');
    $gallery     = get_field('asset_gallery_image','option');
    $heading_msg = get_field('heading_message','option');
    $asset_order_link = get_field('asset_order_link','option');
    $asset_link = get_field('asset_link','option');
    }
    $template_id = get_field('choose_template_here',get_the_ID());
    $lanCode = ICL_LANGUAGE_CODE;
    if($lanCode=='en'){
      $assettitle ="asset title";
      $assetsName ="assets Name";
      $assetsShortDescription ="assets Short Description";
      $AssetDescription ="Asset Description";
      $Pleaseenterassetlinkhere ="Please enter asset link here";
      $Pleaseenterassetorderlink ="Please enter asset order link";
      $Publish ="Save";
      $SaveDraft = "Publish";
      $SubscriptionPlan = "Subscription Plan";
      $Sorry ="Sorry! Please subscribe your plan to create and publish assert. below are the plans please have a look.";
    }
    else
    {
        $assettitle ="Vermögensbezeichnung";
        $assetsName ="Vermögensname";
        $assetsShortDescription ="Assets Kurzbeschreibung";
        $AssetDescription ="Asset-Beschreibung";
        $Pleaseenterassetlinkhere ="Bitte geben Sie hier den Asset-Link ein";
        $Pleaseenterassetorderlink ="Bitte geben Sie den Link für die Asset-Bestellung an";
        $Publish = "sparen";
        $SaveDraft = "Veröffentli";
        $SubscriptionPlan = "Abonnement-Plan";
        $Sorry ="Es tut uns leid! Bitte abonnieren Sie Ihren Plan zur Erstellung und Veröffentlichung von Assert. Nachfolgend sind die Pläne aufgeführt.";
    }

?>
<div class="template-wrapper">
    <section>
        <div class="container">
            <div class="breadcrumb">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </div>
            <form method="post" id="tectnical-template" class="template-submit-form">
                <input type="hidden" name="action" value="technical_post_template">
                <input type="hidden" name="template_value" value="electronic-business">
                <input type="hidden" name="template_id" value="<?php echo $template_id; ?>">
                <input type="hidden" name="category_name" id="category_name" value="<?php echo $_GET['cartId']; ?>">
                <input type="hidden" name="cloning" value="<?php echo $_GET['cloning']; ?>">
                <input type="hidden" name="assert_clone_id" value="<?php echo $_GET['astid']; ?>">
                 <input type="hidden" name="redirect_page_url" id="redirect_page_url" value="<?php echo get_permalink($post->ID); ?>">
                <div class="row uploader-text">
                <p class="heading_msg"><?php if(!empty($heading_msg)){ echo $heading_msg;} ?></p>
                    <div class="col-md-6 col-sm-12 col-xs-12 no-padding">
                        <div class="uploader-main" style='background-image: url("<?php echo $bannerImag['url'];  ?>");'>
                            <img id="placeholder-img" class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/image_uploader.png" alt="">
                        <?php
                        echo do_shortcode('[media_upload_for_front_upload]');
                        ?>
                        </div>
                        <div id="thumbnail-gallery" class="thumbnail-gallery">
                            <ul class="list-unstyled list-inline"> 
                            <?php 
                              if(!empty($gallery)){
                                foreach($gallery as $gids){?>
                                 <li class="image" data-attachment_id="<?php echo $gids['gallery_image']['ID']; ?>" style="cursor: default;">
                                    <img src="<?php echo $gids['gallery_image']['url']; ?>">
                                    <span class="action-delete" onclick="testCall(this,<?php echo $gids['ID'];?>)">×</span>             
                                </li>
                              <?php }} ?>  
                                <li class="add-image add-product-images tips" data-title="Add gallery image" data-original-title="" title="">
                                <span class="add-product-images"  id="add-gallery-images"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </li>           
                            </ul>
                            <input type="hidden" id="product_image_gallery" name="product_image_gallery">   
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 no-padding">
                        <div class="txt-title">
                        <input class="w-75 form-control" type="text" placeholder="<?php echo $assettitle; ?>" id="temp_title" name="temp_title" value="<?php if(!empty($asset_title)){ echo $asset_title;} ?>">
                        </div>   
                        <div class="txt-title">
                        <input class="w-75 form-control" type="text" placeholder="<?php echo $assetsName; ?>" id="asset_name" name="asset_name" value="<?php echo $asset_name; ?>">
                        </div>
                         <div class="txt-title">
                      <input class="w-75 form-control" type="text" placeholder="<?php echo $assetsShortDescription; ?>" maxlength="150" id="short_desc" name="short_desc" value="<?php echo $assert_desc; ?>">
                        </div>                       

                        <div class="txt-editor">
                        <p style="color:#9a9494; font-size: 16px;"><?php echo $AssetDescription; ?></p>
                           <?php wp_editor( $full_desc, 'temp_description', array( 'theme_advanced_buttons1' => 'bold, italic, ul, pH, pH_min', "media_buttons" => false, "textarea_rows" => 8, "tabindex" => 4 ) ); ?>
                        </div>

                        <div class="txt-title" style="position: relative; top:35px;">
                        <input class="w-75 form-control" type="text" placeholder="<?php echo $Pleaseenterassetlinkhere; ?>" id="asset_link" name="asset_link" value="">
                        </div>

                        <div class="publish-sec">
                            <input class="w-75 form-control" type="text" placeholder="<?php echo $Pleaseenterassetorderlink; ?>" id="order_link" name="order_link" value="">
                        
                                                        
                        </div>
                        <div class="publish-sec">
                            <div class="save-draft-text">
                             <span><?php echo $SaveDraft; ?> :</span>
                            </div>
                             <div class="publish-sec-divide">
                                <input class='toggle' type="checkbox" name='post_status_checked'/>
                            </div>
                            <?php 
                           $is_active  = check_subscription_plan($template_id);
                           $p_status = $is_active ? 1 : 0; 
                           ?>
                           <input type="hidden" name="is_active" id="is_active" value="<?php echo $p_status ; ?>">
                           <a href="javascript:void(0);" class="btn not_plan_purchaged"><?php echo $Publish; ?></a>
                           <button type="submit" class="btn custom-bt" style="display: none;"><img src="<?php bloginfo('template_url') ?>/assets/images/load-more.gif" class="loading-image" id="loading-image" style="display: none;"></i><?php echo $Publish; ?></button> 
                         </div>
                         <div class="txt-title">
                        <span class="post_status" style="color:green"></span>
                        <span class="plan_error" style="color:red;"></span>
                    </div>
                    </div>
                </div>  
            </form>
            <div class="row no-margin">
             <h3><?php echo $SubscriptionPlan; ?></h3>
            <div class="row models">
            <?php get_template_part('layout/subscripts', 'plan');?>         
             </div>
            </div>
            
        </div>  
    </section>

    <section class="partner-list">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-xs-6 text-center"><a href="#"><img class="img-responsive" src="<?php bloginfo('template_url') ?>/assets/images/partner_list_1.png" alt="partner_list"></a></div>
                <div class="col-sm-3 col-xs-6 text-center"><a href="#"><img class="img-responsive" src="<?php bloginfo('template_url') ?>/assets/images/partner_list_2.png" alt="partner_list"></a></div>
                <div class="col-sm-3 col-xs-6 text-center"><a href="#"><img class="img-responsive" src="<?php bloginfo('template_url') ?>/assets/images/partner_list_3.png" alt="partner_list"></a></div>
                <div class="col-sm-3 col-xs-6 text-center"><a href="#"><img class="img-responsive" src="<?php bloginfo('template_url') ?>/assets/images/partner_list_4.png" alt="partner_list"></a></div>
            </div>
        </div>  
    </section>

</div>  <!-- template wrapper ends here -->


<!-- more detail popup end -->
<?php get_footer();?>

<style>
i.mce-ico.mce-i-link {
 display: none !important;
}
.attachment-info .edit-attachment {
     display: none !important;
}
</style>
<script>

$(document).ready(function(){
  if(getLangCode=='de'){
   $('#frontend-button').text('BILD HOCHLADEN'); 
   var switchMsg = 'Sie können hier nicht die Sprache wechseln';
   }
   else {
    var switchMsg = 'You can not switch language here go back';
   }
   $('.wpml-ls-slot-shortcode_actions').click(function(){
   alert(switchMsg);
   return false;
   });
    
   $('.btn_black').click(function(e){
    if (confirm('Are you sure')) { 
 // do things if OK
   }
   else{
    return false;
   }
   });

    var is_active =  $('#is_active').val();
    if(is_active==0){
      $('.custom-bt').hide();
      $('.not_plan_purchaged').show();
    }
    else{
     $('.not_plan_purchaged').hide();
      $('.custom-bt').show();
    }

 $('.not_plan_purchaged').click(function(e){
      $('.plan_error').html('Sorry! Please subscribe your plan to create and publish assert. below are the plans please have a look.');
      });

   attachment_ids = [];
   $('#thumbnail-gallery .image').each(function () {
        var attachment_id = $(this).attr("data-attachment_id");
        attachment_ids.push(attachment_id);
    });
   $('#thumbnail-gallery #product_image_gallery').val(attachment_ids);
   var thumb_id = "<?php echo $thumb_id; ?>";
   $('#featured_image_id').val(thumb_id);
})
</script>

