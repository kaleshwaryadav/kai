<?php
/*
 * Template Name: Favorite Assets
 */

get_header(); 

global $current_user;
wp_get_current_user(); 
$user_id = get_current_user_id();
$lanCode = ICL_LANGUAGE_CODE;
    if($lanCode=='en'){
     $FavoriteAssets ="Favorite Assets";
     $addmore ="add more";
     $Unfavorite ="Un-favorite";
     $favorite ="favorite";
     $View="View";
     $Sorry="Sorry! no favorite items added";
     $Added="Added";
    }
    else
    {
     $FavoriteAssets ="Lieblings Assets"; 
     $addmore ="Mehr hinzufügen";
     $Unfavorite ="Unbeliebtheit";
     $favorite ="Liebling";
     $View = "Aussicht";
     $Sorry="Es tut uns leid! keine Lieblingsartikel hinzugefügt";
     $Added="Hinzugefügt";
    }
?>
<!-- main-body section starts here -->
<div class="blackoverlay" id="bol" style="display: none;"> </div>
<div class="template-wrapper">
	<section>
		<div class="container">
			<div class="breadcrumb">
				<?php if(function_exists('bcn_display'))
				{
					bcn_display();
				}?>
			</div>
			
			<section class="success-sec dashboard">
				<h3><?php echo $FavoriteAsset; ?></h3>
				<a class="btn" href="<?php echo home_url(); ?>"><?php echo $addmore; ?></a>
				<div class="success-story-main text-center">			
					<ul class="row list-unstyled">
                    <div class="result"></div>
              <?php
                 global  $current_user, $wpdb;
                 $table_name = $wpdb->prefix . "favorite_asset";
                 $placehoder_image = get_field('placehoder_image', 'option'); 

                 $args = array('post_type' => 'assets',
                       'post__in'            => CheckUserFavorites(),
                       'post_status' => 'publish', 
                       'suppress_filters' => false,
                       'order' => 'DESC',
                       'posts_per_page' => 12,
                       'paged' => get_query_var( 'paged' ) );
                       query_posts($args);

                        if ( have_posts() ) :
                        while ( have_posts() ) : the_post();  
                        $business_name = get_field('business_name', get_the_ID());
                        $post_id = get_the_ID();
                        
                        $favorite_list = $wpdb->get_row("SELECT * FROM $table_name where user_id='$user_id' and post_id = '$post_id'");

                        $name = get_field('name', get_the_ID());
                        $src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', true );

                       $assert_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()));
                        $galleryImage = get_field('select_image',get_the_ID());
                        if(empty($assert_image))
                        {
                           if(!empty($galleryImage)){
                            $assert_image[] = $galleryImage[0]['url'];
                          }
                          else{
                            $assert_image[] = $placehoder_image;
                          }
                        } 

                        ?>
                        <li class="col-md-3 col-sm-4 col-xs-6">
                            <div class="list-box-image">
                                <img class="img-responsive" src="<?php echo $assert_image[0]; ?>" alt="success_list">
                                <div class="image-text">
                                    <p><?php echo get_field('business_name', get_the_ID()); ?></p>
                                </div>
                            </div>
                            
                            <div class="list-box-description">
                                <ul class="list-unstyled ">
                                    <li>
                                        <span>Name :</span>
                                        <p><?php echo $name; ?></p>
                                    </li>
                                    <li>
                                        <p><?php echo $Added; ?> <?php echo get_time_ags(strtotime($favorite_list->date)); ?></p>
                                        <div><img src="<?php bloginfo('template_url') ?>/assets/images/qr.png" alt="qr"></div>
                                    </li>
                                   
                                   <?php $chek_favorite = check_favoriteAsset(get_the_ID()); 
                                   if($chek_favorite==1){  ?>
                                   <li class="feedbackfavorite<?php echo get_the_ID(); ?>">
                                  
                                    <a href="javascript:void(0);" onclick="asset_unfavorite(this,'<?php echo get_the_ID(); ?>');" class="favorite un"><span><i class="fa fa-star" aria-hidden="true"></i></span><?php echo $Unfavorite; ?></a>
                                       
                                    </li>
                                    <?php } else { ?>
                                    <li class="feedbackfavorite feedbackfavorite<?php echo get_the_ID(); ?>">
                                         <a  href="javascript:void(0);" onclick="asset_favorite(this,'<?php echo get_the_ID(); ?>');" class="favorite"><span ><i class="fa fa-star" aria-hidden="true"></i></span><?php echo $favorite; ?></a>
                                    </li>
                                   
                                    <?php } ?>
                                 
                                   
                                </ul>
                                <a class="btn btn_bdr" href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo $View; ?></a>
                            </div>
                        </li>
                        <?php 
                        endwhile; 
                        else :
                           echo'<div style="color:red; text-align:center;"">'.$Sorry.'</div>';
                        endif;
                        ?>
                        <?php wp_pagenavi(); ?>
						
					</ul>
			<!-- <div class="view-more-btn">
				<a href="">View More</a>
			</div> -->
		</div>	
	</section>
</div>	
</section>
</div>	<!-- template wrapper ends here -->

<?php get_footer();
