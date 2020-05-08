<?php
/**
 * ILC Tabbed Front End
 */

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en-US">
<head profile="http://gmpg.org/xfn/11">
<title>Theme with tabbed settings</title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<?php wp_head(); // WordPress header hook ?>

</head>

<body <?php body_class(); ?>">

<div id="header-container">
		
	<div id="header" class="grid">
		<h1><?php bloginfo( 'site_title' ); ?></h1>
		
		<div id="ilc_intro">
			<?php
				$ilc_settings = get_option( "ilc_theme_settings" );
				echo '<p>' . stripslashes($ilc_settings['ilc_intro']) . '</p>';
			?>
		</div>
		
		<div id="navigation">
			<ul><?php wp_list_pages('title_li='); ?></ul>
		</div>
		
	</div>	
	
</div>

<div id="body-container">

	<div id="container" class="grid">

	<div id="content" class="hfeed">

		<?php
				
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="the_title_attribute();"><?php the_title(); ?></a>
				</h2>
				
				<div class="entry-content">
					<?php
					
					the_content(); 
					 
					 wp_link_pages( array(
					 	'before' => '<p class="page-links pages">Pages: ',
						'after' => '</p>' )
					);
				?>
				</div>

			</div>

			<?php endwhile; ?>

		<?php else: ?>

			<p class="no-data">
				No posts were found.
			</p>

		<?php endif; ?>

	</div>

	</div>
</div>
	<div id="footer-container">

		<div id="footer" class="grid">
			
			<p>Tabbed settings theme by <a href="http://ilovecolors.com.ar/">ilovecolors.com.ar</a> | <a href="http://twitter.com/eliorivero">Follow me on Twitter</a>! | Join <a href="http://on.fb.me/ilcfb">ilovecolors on Facebook</a>!</p>
			
		</div>

	</div>

<?php wp_footer(); // WordPress footer hook ?>

</body>
</html>