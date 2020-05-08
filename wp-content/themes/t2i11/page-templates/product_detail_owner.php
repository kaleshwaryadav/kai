<?php
/*
 * Template Name: Product Detail Owner
 */

get_header(); 

if(!is_user_logged_in()) {
$url = esc_url( home_url( '/' ) );?>
<script>
 document.location.href = "<?php echo $url;  ?>";
</script>
<?php } ?>

<?php 
$astid = base64_decode($_GET['astid']); 
$asset_name = get_field('name',$astid, true);
$asset_business = get_field('business_name',$astid, true);
$price = get_field('price',$astid, true);
$link = get_field('link',$astid, true);
$short_description  = get_field('short_description',$astid, true);
$asset_download = get_field('download_file',$astid, true);
$ass_desc = get_post($astid);
$assert_desc = $ass_desc->post_content;

$ImageUrl = wp_get_attachment_image_src( get_post_thumbnail_id( $astid ), 'full');
$asset_link = get_field('asset_link', $astid, true);
$secon_desc =  get_field('description_business', $astid, true);
    $lanCode = ICL_LANGUAGE_CODE;
    if($lanCode=='en'){
      $ProductTitle = "Product Title";
      $assetsName ="assets Name";
      $ShortDescription = "Short Description";
      $Pleaseenterassetlinkhere = "Please enter asset link here";
      $Price="Price";
      $Pleaseenterassertorderlink ="Please enter assert order link";
      $SaveDraft = "Publish";
      $ViewAsset ="View Asset";
      $UpdateNow = "Update Now";
    }
    else
    {
     $ProductTitle = "Produktname";
     $assetsName ="Vermögensname";
     $ShortDescription = "kurze Beschreibung";
     $Pleaseenterassetlinkhere = "Bitte geben Sie hier den Asset-Link ein";
     $Price="Preis";
     $Pleaseenterassertorderlink ="Bitte geben Sie den Bestätigungslink an";
     $SaveDraft = "Veröffentlichen";
     $ViewAsset ="Asset anzeigen";
     $UpdateNow = "Jetzt aktualisieren";
    }
?>
<!-- main-body div starts here -->
<div class="template-wrapper">
    <div>
      <div class="container">
        <div class="breadcrumb">
			<?php if(function_exists('bcn_display'))
			{
			bcn_display();
			}
            ?>
			</div>
			<div class="head_ttl">
			<h2><?php echo get_the_title($astid); ?></h2>
			<a href="#target" class="print"></a>

			</div>
            <div class="product_details">
			 <form method="post" id="edit_asset" >
                <input type="hidden" name="action" value="edit_assets">
                <input type="hidden" name="asset_id" value="<?php echo $astid; ?>">
                 <?php if (function_exists('wp_nonce_field')) {
                  wp_nonce_field('edit_profile_action', 'edit_profile_action_nonce');
                  } ?>
                <div class="row uploader-text">
                    <div class="col-md-6 col-sm-12 col-xs-12 no-padding">
                        <div class="uploader-main" style='background-image: url("<?php echo $ImageUrl[0];  ?>");'>
                            <img id="placeholder-img" class="img-responsive center-block" src="<?php bloginfo('template_url') ?>/assets/images/image_uploader.png" alt="">
                            <?php
                            echo do_shortcode('[media_upload_for_front_upload]');
                            ?>
                        </div>
                        <div id="thumbnail-gallery" class="thumbnail-gallery">
                            <ul class="list-unstyled list-inline"> 
                            <?php $gallery =  get_field('select_image',$astid,true);
                             if(!empty($gallery)){
                             foreach($gallery as $gids){?>
                                 <li class="image" data-attachment_id="<?php echo $gids['ID']; ?>" style="cursor: default;">
                                    <img src="<?php echo $gids['url']; ?>">
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
                    <div class="col-md-6 col-sm-12 col-xs-12">
                    
                        <div class="txt-title">
                        <input class="w-75 form-control" type="text" placeholder="<?php echo $ProductTitle; ?>" id="temp_title" name="temp_title" value="<?php echo get_the_title($astid);  ?>">
                        </div>
                        <div class="txt-title">
                        <input class="w-75 form-control" type="text" placeholder="<?php echo $assetsName; ?>" id="asset_name" name="asset_name" value="<?php echo $asset_name; ?>">
                        </div>

                        <div class="txt-title">
                      <input class="w-75 form-control" type="text" placeholder="<?php echo $ShortDescription; ?>" id="short_desc" name="short_desc" value="<?php echo $assert_desc; ?>">
                        </div>                        

                        <div class="txt-editor">
                           <?php wp_editor( $short_description, 'temp_description', array( 'theme_advanced_buttons1' => 'bold, italic, ul, pH, pH_min, p', "media_buttons" => false, "textarea_rows" => 8, "tabindex" => 4 ) ); ?>
                        </div>
                        <?php if(!empty($secon_desc)){ ?>
                        <div class="txt-editor">
                           <?php wp_editor($secon_desc, 'second_description', array( 'theme_advanced_buttons1' => 'bold, italic, ul, pH, pH_min, p', "media_buttons" => false, "textarea_rows" => 8, "tabindex" => 4 ) ); ?>
                        </div>
                        <?php } ?>
                        <div style="clear:both;"></div>
                        <div class="txt-title" style="position: relative; top:35px;">
                        <input class="w-75 form-control" type="text" placeholder="<?php echo $Pleaseenterassetlinkhere; ?>" id="asset_link" name="asset_link" value="<?php echo $asset_link; ?>">
                        </div>
                        <?php 

                        if(!empty($price)){?>
                        <div class="publish-sec">
                         <input class="w-75 form-control" type="number" placeholder="<?php echo $Price;?>" id="temp_price" name="temp_price" value="<?php echo $price; ?>">
                         </div>
                       <?php  } 
                        else if(!empty($link)){?>
                        <div class="publish-sec">
                         <input class="w-75 form-control" type="text" placeholder="<?php echo $link; ?>" id="order_link" name="order_link" value="<?php echo $link; ?>">
                         </div>
                        <?php } 
                         else if(!empty($asset_download)){ ?>
                        <div class="txt-editor">
                        <div class="col-md-5 col-sm-5 col-xs-12 no-padding">
                        <div class="uploader-user">
                        <input type="file" name="downloadfile" id="downloadfile"  accept="image/-png,image/gif,image/jpeg">
                          <!--   <label for="upload-1">
                                <span class="btn">Select file</span>
                            </label>  -->
                        </div>
                    </div>
                        </div>
                         <?php }?>
                         <div class="publish-sec">
                         	<div class="save-draft-text">
                         	 <span><?php echo $SaveDraft; ?> :</span>
                         	</div>
                         	 <div class="publish-sec-divide">
                         	 	<input class='toggle' type="checkbox" <?php if($ass_desc->post_status=='publish'){ echo'checked="checked"'; }?>   name='post_status_checked'/>
                         	</div>
                         </div>
                         	<ul class="inline-btn-group">
                         		<li>
                           <a target="_blank" href="<?php echo get_the_permalink($astid); ?>" class="btn btn_bdr"><?php echo $ViewAsset; ?></a></li>
                           <li> 
                           <button type="submit" class="btn"><img src="<?php bloginfo('template_url') ?>/assets/images/load-more.gif" class="loading-image" id="loading-image" style="display: none;"></i><?php echo $UpdateNow; ?></button>
                       	</li>
                       </ul>

                        <div class="txt-title">
                        <div class="post_status" style="color:green; text-align:right;"></div>
                        <div class="plan_error" style="color:red;"></div>
                    </div>

                        </div>
                        
                    </div>
                </div>  
            </form>
		</div>  
	</div>

	<div class="partner-list">
		<div class="container">
		<div class="row">
		<?php get_template_part( 'layout/template', 'ads');?>
			</div>
		</div>  
	</div>

	<div>
		 <?php //get_template_part( 'layout/template', 'share');?>
	</div>
</div>  <!-- template wrapper ends here -->

<!-- more detail popup end -->

<style>
.uploader-main img {
    padding: 50px 0 30px;
    visibility: hidden;
}
i.mce-ico.mce-i-link {
        display: none !important;
    }
    
 .attachment-info .edit-attachment {
     display: none !important;
}   
</style>

<!-- more detail popup end -->
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/assets/js/lightslider.js"></script>

<script type="text/javascript">

	$(document).ready(function() {
		$('#image-gallery').lightSlider({
			gallery:true,
			item:1,
			thumbItem:4,
			slideMargin: 0,
			speed:500,
			auto:false,
			loop:true,
			onSliderLoad: function() {
				$('#image-gallery').removeClass('cS-hidden');
			}  
		});

   attachment_ids = [];
   jQuery('#thumbnail-gallery .image').each(function () {
        var attachment_id = $(this).attr("data-attachment_id");
        attachment_ids.push( attachment_id );
    });
    $('#thumbnail-gallery #product_image_gallery').val(attachment_ids);
    $('#edit_asset').submit(function() {
    $('#loading-image').show();
     $.ajax({            
            type: "POST", 
            action : "edit_assets",
            url: theme_ajax.url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false, 
            success: function (response) {
            $('.post_status').html(response);
            $('.post_status').show();
            $('#loading-image').hide();
            setTimeout(function(){// wait for 5 secs(2)
            $('.post_status').hide();
              }, 5000); 
            },
            error: function (responseData) {
                console.log('Ajax request not recieved!');
            }
        });
     return false;

});

	});
</script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {
        var url = "<?php echo get_template_directory_uri(); ?>";
		new nicEditor({iconsPath : +url'/nicEditorIcons.gif'}).panelInstance('area3');
	});
</script>
<script type="text/javascript">
	// jQuery(function () {
	// 	jQuery('#datetimepicker1').datetimepicker();

	// });
</script>
<script type="text/javascript">

	$('.head_ttl .print').on('click', function(e) {
		e.preventDefault();
		$link = $(this).attr('href');

		$('html, body').animate({
			scrollTop: $($link).offset().top - 10
		}, 800 );
	});

</script>
<?php get_footer();

