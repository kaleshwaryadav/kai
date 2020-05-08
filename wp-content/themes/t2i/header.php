<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage T2i
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/easy-responsive-tabs.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/assets/css/lightslider.css">
    <script type="text/javascript">
    var getLangCode = '<?php echo ICL_LANGUAGE_CODE; ?>';
    </script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<header>
		<nav class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					</button>
					<div class="navbar-brand"><?php the_custom_logo(); ?></div>
				</div>
				<div class="collapse navbar-collapse slidebar " id="myNavbar">
					<div class="navbar-right">
						<div class="header-search-bar pull-left">
							<?php get_search_form();?>							
						</div>
						<div class="menu-top-menu-container">
                          <?php $page_id = get_the_ID();
                          echo do_shortcode("[wpml_language_selector_widget]"); ?>
                      	</div>
						<?php
						if(ICL_LANGUAGE_CODE=='en'){
							if(!is_user_logged_in()) {
                           wp_nav_menu( array(
							'theme_location' => 'top',
							'menu_id'        => 'top-menu',
							'menu_class' => 'nav navbar-nav main-nav-ul headerUL',
							) );
                           }else { ?>
                            <div class="menu-top-menu-container">
                            <ul id="top-menu" class="nav navbar-nav main-nav-ul headerUL">
                            
                            <li class="signUp">
                            <a href="<?php echo get_permalink(79);?>"><?php  echo 'My account'; ?></a></li>

                           </ul>
                          </div>
                          <?php }}
							if(ICL_LANGUAGE_CODE=='de'){
                         		if(!is_user_logged_in()) {                           
							wp_nav_menu( array(
							'theme_location' => 'top',
							'menu_id'        => 'top-menu',
							'menu_class' => 'nav navbar-nav main-nav-ul headerUL german',
							) );
                           } else { ?>
                            <div class="menu-hauptmenue-container">
                            <ul id="top-menu" class="nav navbar-nav main-nav-ul headerUL">
                            <li class="signUp">
                            <a href="<?php echo get_permalink(79);?>"><?php  echo 'Mein Konto'; ?></a></li>

                           </ul>
                          </div>
                          <?php } } ?>
                          
						</div>
					     </div>
						</div>
					</nav>
				</header>

				
