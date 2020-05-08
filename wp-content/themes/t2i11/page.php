<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage T2i
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<div class="container t2iwppage">
<?php
			while ( have_posts() ) : the_post();

				?>

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php t2i_edit_link( get_the_ID() ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 't2i' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

			<?php 

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

</div><!-- .wrap -->

<?php get_footer();
