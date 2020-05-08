<?php
/*
 * Template Name: faq
 */

get_header(); ?>

<!-- main-body section starts here -->


<section class="success-sec">
	<div class="container ">
		<div class="success-story-main text-center">
            <h4>111111111Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>
            <h5>Vivamus auctor magna sit amet mauris malesuada tincidunt</h5>
			<ul class="list-unstyled row">
             <?php 
            $args   =   array(
                'showposts'=>'-1',
                'post_type'     => 'boutique',
                'orderby'     => 'post_date',
                'orderby'=>'menu_order',
                'order'=>'ASC',
                'post_status' => 'publish', 
            ); 
           $data =  get_posts($args );
           
             $the_query = new WP_Query( $args );
             echo'<pre>';
             print_r($the_query);
             echo'</pre>';

            $datav =   query_posts('showposts=-1&post_type=boutique&orderby=menu_order&orderby=post_date&order=ASC');
              while ( have_posts() ) : the_post(); ?> 
              <span class="entry-date"><?php echo get_the_date(); ?></span>
                   <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                   <p><?php echo get_the_excerpt(); ?></p>
                <?php endwhile;  wp_pagenavi();  ?>
			</ul>
          </div>
		</div>	
	</section>


<?php get_footer(); ?>
