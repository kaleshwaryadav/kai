<?php
/*
 * Template Name: Home
 */

get_header(); 
?>

<!-- main-body section starts here -->

<section>
	<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
	<div class="banner-sec text-center" style="background-image: url('<?php echo $thumb['0'];?>')">
		<div class="banner-text">
			<h3><?php the_field('banner_text'); ?></h3>
			<div class="get-btn">
				<a href="<?php the_field('banner_btn_link'); ?>" class="btn"><?php the_field('banner_btn_text'); ?></a>
			</div>
		</div>
	</div>	
</section>

<section class="success-sec">
	<div class="container ">
		<div class="success-story-main text-center">
			<h4><?php the_field('most_popular'); ?></h4>
			<h3><?php the_field('success_stories'); ?></h3>
			<h5><?php the_field('short_description'); ?></h5>
			<ul class="list-unstyled row">
             <?php 
            $args   =   array(
                'numberposts'   => -1,
                'post_type'     => 'assets',
                'post_status' => 'publish', 
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
              query_posts($args);
              $placehoder_image = get_field('placehoder_image', 'option'); 
              while ( have_posts() ) : the_post();  
              $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', true );
              ?>
				<li class="col-md-3 col-sm-4 col-xs-6 pressListRow">
					<div class="list-box-image">
						<img class="img-responsive" src="<?php echo $src[0]; ?>" alt="success_list">
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
								<span><?php if(ICL_LANGUAGE_CODE=='de'){ echo'Titel'; } else { echo 'Title';} ?> :</span>
								<p><?php the_title(); ?></p>
							</li>
							<li>
								<span><?php if(ICL_LANGUAGE_CODE=='de'){ echo'Einzelheiten'; } else { echo 'Details';} ?> :</span>
								<p><?php echo wp_trim_words( get_the_content(), 18); ?></p>
							</li>
						</ul>
						<a class="btn" href="<?php the_permalink(); ?>"><?php if(ICL_LANGUAGE_CODE=='de'){ echo'Aussicht'; } else { echo 'View';} ?></a>
					</div>
				</li>
                <?php endwhile; ?>
			</ul>
			<div class="view-more-btn">
				<a href="<?php echo site_url('assets'); ?>" id="loadMore"><?php if(ICL_LANGUAGE_CODE=='de'){ echo'Mehr sehen'; } else { echo 'View More';} ?></a>
			</div></div>
		</div>	
	</section>

<script>
$(function () {
     $(".pressListRow").slice(0, 100).show();
 });
</script>
<?php get_footer(); ?>
