<?php
session_start();
/*
 * Template Name: success stories
 */
get_header();
global $current_user;
get_currentuserinfo(); 
if(!is_user_logged_in()) {
$url = esc_url( home_url( '/' ) );?>
<script>
 document.location.href = "<?php echo $url;  ?>";
</script>
<?php } 
$lanCode = ICL_LANGUAGE_CODE;
    if($lanCode=='en'){
       $SUCCESSSTORIES ="SUCCESS STORIES";
       $Title ="Title";
       $Details ="Details";
       $View ="View";
    }
    else
    {
      $SUCCESSSTORIES ="ERFOLGSGESCHICHTEN";
      $Title ="Titel";
      $Details ="Einzelheiten";
      $View ="Aussicht";
    }
    ?>
<section class="success-sec">
    <div class="container ">
        <div class="success-story-main text-center">
            <h3><?php echo $SUCCESSSTORIES; ?></h3>
            <ul class="list-unstyled row">
<?php 
 $successQry = array(
                    'numberposts'   => -1,
                    'post_type'     => 'assets',
                    'post_status' => 'publish', 
                    'suppress_filters' => false,
                    'order' => 'DESC',
                    'paged' => get_query_var( 'paged' ),
                    'meta_query'    => array(
                        array(
                            'key'       => 'check_here',
                            'value'     => array('1'),
                            'compare'   => 'IN',
                        )
                    )
                );
              query_posts($successQry);
              while ( have_posts() ) : the_post();  
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
                                <p><?php echo get_field('name', get_the_ID()); ?></p>
                            </li>
                            <li>
                                <span><?php echo $Title; ?> :</span>
                                <p><?php the_title(); ?></p>
                            </li>
                            <li>
                                <span><?php echo $Details; ?> :</span>
                                <p><?php echo wp_trim_words( get_the_content(), 18); ?></p>
                            </li>
                        </ul>
                        <a class="btn" href="<?php the_permalink(); ?>"><?php echo $View;?></a>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>
         </div>
        </div>  
    </section>
<?php get_footer(); ?>
