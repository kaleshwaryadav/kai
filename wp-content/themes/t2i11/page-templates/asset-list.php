<?php
/*
 * Template Name: assest list
 */

get_header(); 
$lanCode = ICL_LANGUAGE_CODE;
    if($lanCode=='en'){
      $Title ="Title";
      $Details ="Details";
      $view ="View";
    }
    else
    {
    $Title ="Titel";
    $Details ="Einzelheiten";
    $view ="View";
    }
    ?>
<!-- main-body section starts here -->

<section>
	<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
	<div class="banner-sec text-center" style="background-image: url('<?php echo $thumb['0'];?>')">
		<div class="banner-text">
			

		</div>
	</div>	
</section>

<section class="success-sec">
	<div class="container ">
		<div class="success-story-main text-center">
            <h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>
            <h5>Vivamus auctor magna sit amet mauris malesuada tincidunt</h5>
			<ul class="list-unstyled row">
             <?php 
            $args   =   array(
                'posts_per_page'   => 8,
                'post_type'     => 'assets',
                'post_status' => 'publish', 
                'suppress_filters' => false,
                'orderby' => 'rand',
                'paged' => get_query_var( 'paged' ),
                'meta_query'    => array(
                    array(
                        'key'       => 'check_here',
                        'value'     => 1,
                        'compare'   => 'NOT IN',
                    )
                )
          );
              query_posts($args);
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
							<p><?php the_field('business_name', get_the_ID()); ?></p>
						</div>
					</div>
					
					<div class="list-box-description">
						<ul class="list-unstyled ">
							<li>
								<span>Name :</span>
								<p><?php the_field('name', get_the_ID()); ?></p>
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
						<a class="btn" href="<?php the_permalink(); ?>"><?php echo $view; ?></a>
					</div>
				</li>
                <?php endwhile;  wp_pagenavi();  ?>
			</ul>
          </div>
		</div>	
	</section>


<?php get_footer(); ?>
