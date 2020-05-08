<?php
/**
 * T2i functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage T2i
 * @since 1.0
 */

/**
 * T2i only works in WordPress 4.7 or later.
 */
if( !is_admin()){ 

	wp_deregister_script('jquery');

	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js');

}

if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function t2i_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/t2i
	 * If you're building a theme based on T2i, use a find and replace
	 * to change 't2i' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 't2i' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 't2i-featured-image', 2000, 1200, true );

	add_image_size( 't2i-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 't2i' ),
		'social' => __( 'Social Links Menu', 't2i' ),
		'quick' => __( 'Quick Links Menu', 't2i' ),
		'categories' => __( 'Categories Menu', 't2i' ),

		) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
		) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
		) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
    add_image_size( 'asset-img', 246, 176);
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', t2i_fonts_url() ) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
				),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
				),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
				),
			),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
				),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
				),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
				),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
				),
			),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 't2i' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
				),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 't2i' ),
				'file' => 'assets/images/sandwich.jpg',
				),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 't2i' ),
				'file' => 'assets/images/coffee.jpg',
				),
			),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
			),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
			),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 't2i' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
					),
				),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 't2i' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
					),
				),
			),
		);

	/**
	 * Filters T2i array of starter content.
	 *
	 * @since T2i 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 't2i_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 't2i_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function t2i_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( t2i_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter T2i content width of the theme.
	 *
	 * @since T2i 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 't2i_content_width', $content_width );
}
add_action( 'template_redirect', 't2i_content_width', 0 );

/**
 * Register custom fonts.
 */
function t2i_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 't2i' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
			);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since T2i 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function t2i_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 't2i-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
			);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 't2i_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function t2i_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 't2i' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 't2i' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 't2i' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 't2i' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 't2i' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 't2i' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );
}
add_action( 'widgets_init', 't2i_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since T2i 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
/*function t2i_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',esc_url( get_permalink( get_the_ID() ) ), //translators: %s: Name of current post 
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 't2i' ), get_the_title( get_the_ID() ) )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 't2i_excerpt_more' );*/

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since T2i 1.0
 */
function t2i_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 't2i_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function t2i_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 't2i_pingback_header' );

require get_parent_theme_file_path( 'recaptcha-master/src/autoload.php' );

/**
 * Display custom color CSS.
 */
function t2i_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
	?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo t2i_custom_colors_css(); ?>
	</style>
	<?php }
	add_action( 'wp_head', 't2i_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function t2i_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 't2i-fonts', t2i_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 't2i-style', get_stylesheet_uri() );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 't2i-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 't2i-style' ), '1.0' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 't2i-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 't2i-style' ), '1.0' );
		wp_style_add_data( 't2i-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 't2i-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 't2i-style' ), '1.0' );
	wp_style_add_data( 't2i-ie8', 'conditional', 'lt IE 9' );

	//responsive css
	//wp_enqueue_style( 't2i-responsive', get_theme_file_uri( '/assets/css/responsive.css' ), array( 't2i-style' ), '1.0' );

	//responsive css
	wp_enqueue_style( 't2i-custom', get_theme_file_uri( '/assets/css/custom.css' ), array( 't2i-style' ), '1.0' );

	//responsive css
	wp_enqueue_style( 't2i-responsive', get_theme_file_uri( '/assets/css/responsive.css' ), array( 't2i-style' ), '1.0' );
    wp_enqueue_script('form-validation', get_stylesheet_directory_uri() . '/assets/js/jquery.validate.js', array('jquery'));
    wp_enqueue_script('additional-methods', get_stylesheet_directory_uri() . '/assets/js/additional-methods.min.js', array('jquery'));

    wp_enqueue_script('rsclean-request-script', get_stylesheet_directory_uri() . '/assets/js/theme-script.js', array('jquery'));
	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
    //
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array(), '3.7.3' );
   //
	wp_enqueue_script( 'nicEdit', get_theme_file_uri( '/assets/js/nicEdit.js' ), array(), '3.7.3' );
	wp_enqueue_script( 'moment', get_theme_file_uri( '/assets/js/moment.js' ), array(), '3.7.3' );
	wp_enqueue_script( 'bootstrap-datetimepicker', get_theme_file_uri( '/assets/js/bootstrap-datetimepicker.min.js' ), array(), '3.7.3' );

	wp_enqueue_script( 'jquery.dataTables.min', get_theme_file_uri( '/assets/js/jquery.dataTables.min.js' ), array(), '3.7.3' );
	  //
	wp_enqueue_script( 'validator', get_theme_file_uri( '/assets/js/validator.js' ), array(), '3.7.3' );
	wp_enqueue_script( 'custom', get_theme_file_uri( '/assets/js/custom.js' ), array(), '3.7.3' );

	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 't2i-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	$t2i_l10n = array(
		'quote'          => t2i_get_svg( array( 'icon' => 'quote-right' ) ),
		);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 't2i-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$t2i_l10n['expand']         = __( 'Expand child menu', 't2i' );
		$t2i_l10n['collapse']       = __( 'Collapse child menu', 't2i' );
		$t2i_l10n['icon']           = t2i_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}

	wp_enqueue_script( 't2i-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 't2i-skip-link-focus-fix', 't2iScreenReaderText', $t2i_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    wp_localize_script('rsclean-request-script', 'theme_ajax', array(
    'url' => admin_url('admin-ajax.php'),
    'site_url' => get_bloginfo('url'),
    'theme_url' => get_bloginfo('template_directory'),
     ));
}

add_action( 'wp_enqueue_scripts', 't2i_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since T2i 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function t2i_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			$sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 't2i_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since T2i 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function t2i_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 't2i_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since T2i 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function t2i_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 't2i_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since T2i 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function t2i_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  't2i_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since T2i 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function t2i_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 't2i_widget_tag_cloud_args' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );


/**
 * ajax-request handle.
 */
require get_parent_theme_file_path( '/inc/ajax-request.php' );

/**
 * Check favorite asset .
 */
require get_parent_theme_file_path( '/inc/custom-function.php' );
//require get_parent_theme_file_path( '/inc/cron-report-generate.php' );
/**
 * google calendar api.
 */
require get_parent_theme_file_path( '/googleCalendar/settings.php');
require get_parent_theme_file_path( '/qrcode/QR_BarCode.php');
require get_parent_theme_file_path( '/general-functions.php' );
/**
 * reports class
 */
require get_parent_theme_file_path('/class/report.php');

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title'     => 'Theme General Settings',
		'menu_title'    => 'Theme Options',
		'menu_slug'     => 'theme-general-settings',
		'capability'    => 'edit_posts',
		'redirect'        => false,
		'icon_url' => 'dashicons-laptop',
		));
}

// Register Custom Post Type
function custom_post_type() {

    $labels = array(
        'name'                  => _x( 'Assets', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Assets ', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Assets ', 'text_domain' ),
        'name_admin_bar'        => __( 'Assets ', 'text_domain' ),
        'archives'              => __( 'Assets Archives', 'text_domain' ),
        'attributes'            => __( 'Assets Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Asset:', 'text_domain' ),
        'all_items'             => __( 'All Asset', 'text_domain' ),
        'add_new_item'          => __( 'Add New Asset', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Asset', 'text_domain' ),
        'edit_item'             => __( 'Edit Asset', 'text_domain' ),
        'update_item'           => __( 'Update Asset', 'text_domain' ),
        'view_item'             => __( 'View Asset', 'text_domain' ),
        'view_items'            => __( 'View Asset', 'text_domain' ),
        'search_items'          => __( 'Search Asset', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Asset', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Asset', 'text_domain' ),
        'items_list'            => __( 'Asset list', 'text_domain' ),
        'items_list_navigation' => __( 'Asset list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter Asset list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Assets management', 'text_domain' ),
        'description'           => __( 'Assets management Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array('title','thumbnail','page-attributes','editor','tags'),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'assets', $args );

}
add_action( 'init', 'custom_post_type');

$labels = array(
        'name' => _x('Choose template', 'Taxonomy plural name', 'text_domain') ,
        'singular_name' => _x('Choose template', 'Taxonomy singular name', 'text_domain') ,
        'search_items' => __('Search choose template', 'text_domain') ,
        'popular_items' => __('Popular choose template', 'text_domain') ,
        'all_items' => __('All  template', 'text_domain') ,
        'parent_item' => __('Parent template', 'text_domain') ,
        'parent_item_colon' => __('Parent template ', 'text_domain') ,
        'edit_item' => __('Edit template', 'text_domain') ,
        'update_item' => __('Update template', 'text_domain') ,
        'add_new_item' => __('Add template', 'text_domain') ,
        'new_item_name' => __('New template', 'text_domain') ,
        'add_or_remove_items' => __('Add or remove template', 'text_domain') ,
        'choose_from_most_used' => __('Choose from most used enginetheme', 'text_domain') ,
        'menu_name' => __('All template', 'text_domain') ,
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'show_tagcloud' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'job_location',
            'hierarchical' => true
        ) ,
        'query_var' => true,
        'capabilities' => array(
            'manage_terms',
            'edit_terms',
            'delete_terms',
            'assign_terms'
        )
    );

    register_taxonomy('asset-detail', array(
        'assets','adds','subscription',
    ) , $args);


/**
 * custom post type 
 */
require get_parent_theme_file_path( '/inc/custom-post-type.php');

/**
 * regarding subscription plan 
 */
require get_parent_theme_file_path( '/inc/subscription-plan.php');



/*
 * @kaleshwar
 * Get Most popular assests in home page
 */

function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function save_func($ID, $post,$update) {
    $postID = $ID;
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

add_action( 'save_post', 'save_func', 10, 3 );

// if logged in
function user_logged()
{
if(is_user_logged_in()) {
echo $url = get_permalink(79);
wp_redirect($url);
}
}
/*
if NOT logged in
*/
function not_logged_in()
{
if(!is_user_logged_in()) {
$url = get_permalink(4);
wp_redirect($url);
}
}


add_action( 'wp_enqueue_scripts', 'the_dramatist_enqueue_scripts' );
add_filter( 'ajax_query_attachments_args', 'the_dramatist_filter_media' );
add_shortcode( 'media_upload_for_front_upload', 'media_upload_for_front_upload' );

/**
 * Call wp_enqueue_media() to load up all the scripts we need for media uploader
 */
function the_dramatist_enqueue_scripts() {
    wp_enqueue_media();
    wp_enqueue_script(
        'some-script',
        get_template_directory_uri() . '/assets/js/media-uploader.js',
        // if you are building a plugin
        // plugins_url( '/', __FILE__ ) . '/js/media-uploader.js',
        array( 'jquery' ),
        null
    );
}
/**
 * This filter insures users only see their own media
 */
function the_dramatist_filter_media( $query ) {
    // admins get to see everything
    if ( ! current_user_can( 'manage_options' ) )
        $query['author'] = get_current_user_id();
    return $query;
}
function media_upload_for_front_upload( $args ) {
    // check if user can upload files
    if ( current_user_can( 'upload_files' ) ) {
        $str = __( 'UPLOAD IMAGE', 'text-domain' );
        return '<div id="upload" class="drop-area">
                                <span class="btn" id="frontend-button">'. $str . '</span>
                                <input type="hidden" id="featured_image_id" name="featured_image_id">
                            </div>';
    }
    return __( 'Please Login To Upload', 'text-domain' );
}


if ( current_user_can('author') && !current_user_can('upload_files') )
add_action('admin_init', 'allow_role_uploads');


function allow_role_uploads() {
    $new_role = get_role('author');
    $new_role->add_cap('upload_files');
}


add_action('admin_menu', 'payment_handing_module');
function payment_handing_module() {
      add_submenu_page('edit.php?post_type=assets', 'payments', 'Payments', 'manage_options', 'payment_assert', 'payments_handle');

}

function payments_handle(){
    require get_parent_theme_file_path('/payment/payment_userlist.php' );
    die;
}
add_action('admin_menu', 'report_management');
function report_management(){
     add_submenu_page('edit.php?post_type=assets', 'reports', 'Reports', 'manage_options', 'report_asset', 'reports_handle');

}

/*
 * Handing report action
 * author @kaleshwar
 */

function reports_handle(){

    if(!empty($_REQUEST['action'])){
    require get_parent_theme_file_path('/payment/reports-action.php' );
    }
    else if(!empty($_REQUEST['price_action'])){
    require get_parent_theme_file_path('/payment/overallprice-report.php' );
    }
    else if(!empty($_REQUEST['payment_report'])){
    require get_parent_theme_file_path('/payment/payment_report.php' );
    }
    else if(!empty($_REQUEST['report_action'])){
    require get_parent_theme_file_path('/payment/invoice-report.php' );
    }
    else if(!empty($_REQUEST['report_detail'])){
    require get_parent_theme_file_path('/payment/invoice-detail-report.php' );
    }
    else {
    require get_parent_theme_file_path('/payment/reports.php' );
    }
    die;
}


function get_time_ags( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return '1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'Added ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}

function filter_cars_by_taxonomies( $post_type, $which ) {

    // Apply this only on a specific post type
    if ( 'adds' !== $post_type )
        return;

    // A list of taxonomy slugs to filter by
    $taxonomies = array( 'asset-detail');

    foreach ( $taxonomies as $taxonomy_slug ) {

        // Retrieve taxonomy data
        $taxonomy_obj = get_taxonomy( $taxonomy_slug );
        $taxonomy_name = $taxonomy_obj->labels->name;

        // Retrieve taxonomy terms
        $terms = get_terms( $taxonomy_slug );

        // Display filter HTML
        echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
        echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
        foreach ( $terms as $term ) {
            echo
            printf(
                '<option value="%1$s" %2$s>%3$s</option>',
                $term->slug,
                ( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
                $term->name
            );
        }
        echo '</select>';
    }

}
add_action( 'restrict_manage_posts', 'filter_cars_by_taxonomies' , 10, 2);

/*
 * Added owner clumns in the asset listing 
 */
add_filter('manage_assets_posts_columns', 'ST2_columns_head_only_assets', 10);
add_action('manage_assets_posts_custom_column', 'ST2_columns_content_only_assets', 10, 2);
 
function ST2_columns_head_only_assets($defaults) {

    $defaults['ownername'] = 'Asset owner';
    $defaults['assetid'] = 'Asset ID#';
    return $defaults;
}
function ST2_columns_content_only_assets($column_name, $post_ID) {
    global $post;
    if ($column_name == 'ownername') {
        $asset_user = get_userdata($post->post_author);
       echo $menu_order = $asset_user->user_login;
    }
    
    if ($column_name == 'assetid') {
       echo $menu_order = $post->ID;
    }
}

add_action('admin_head', 'mytheme_admin_head');
function mytheme_admin_head() {
    global $post_type;
    if ( 'assets' == $post_type ) {?>
      <style type="text/css"> .column-order { width: 10%; } </style><?php
    }
}


function reorder_columns($columns) {
  $order_columns = array();
   $title = 'title'; 
   foreach($columns as $key => $value) {
     if ($key==$title){
     $order_columns['title'] = '';   // Move date column before title column
     $order_columns['categories'] = '';   // Move author column before title column
     $order_columns['taxonomy-asset-detail'] = '';   // Move tags column before title column
     $order_columns['ownername'] = '';
      $order_columns['assetid'] = '';
     $order_columns['date'] = '';
    }
    $order_columns[$key] = $value;
  }
  return $order_columns;
}
add_filter('manage_posts_columns', 'reorder_columns');

function generate_assets_data_report_month(){

	global  $current_user, $wpdb;
	$table_name = $wpdb->prefix . "montly_payment_report";
	$user_id = get_current_user_id();
    $asset_filter_date = $_POST['asset_filter_date'];
    $asset_userid = $_POST['asset_user_id'];
    $total_assets_count = $_POST['total_assets_count'];
    $total_views = $_POST['total_views'];
    $total_clones = $_POST['total_clones'];
    $total_shares = $_POST['total_shares'];
    $total_favorits = $_POST['total_favorits'];
    $total_reminder = $_POST['total_reminder'];
    $total_url_calls = $_POST['total_url_calls'];
    $total_downloads = $_POST['total_downloads'];
    $total_report_calls = $_POST['total_report_calls'];
    $total_message_sent = $_POST['total_message_sent'];
    $total_earning = $_POST['total_earning'];

	
	$year = date('Y', strtotime($asset_filter_date));
	$month = date('m', strtotime($asset_filter_date));
	$currentdateTime = date('Y/m/d H:i:s');
	$date = 1;
	$new_date = date('y-m-d', strtotime($year."-".$month."-".$date));



	// echo $year;
	// echo "<br>";
	// echo $month;
	$filter = $asset_filter_date;
	$insertSQL = "INSERT INTO " . $table_name . " 
	SET
	UserID = '$asset_userid',
	Month = '$month',
	Year = '$year',
	YearMonth = '$new_date',
	TotalNoAssets = '$total_assets_count',
	Total_Views = '$total_views',
	Total_Clones = '$total_clones',
	Total_Shares = '$total_shares',
	Total_Favorits = '$total_favorits',
	Total_Reminder = '$total_reminder',
	Total_Url_Calls = '$total_url_calls',
	Total_Downloads = '$total_downloads',
	Total_Report_Calls = '$total_report_calls',
	Total_Message_Sent ='$total_message_sent',
	Total_Earning = '$total_earning',
	Last_Fetch_Report_DateTime = '$currentdateTime'";
	$results = $wpdb->query($insertSQL);
	if($results==true)
	{
		header('Content-Type: application/json');
		echo json_encode( array( 'status'=>"Success", 'message'=>__( '&#10003; Record Created Successfully!.' )));
	}
	else{
		header('Content-Type: application/json');
		echo json_encode( array( 'status'=>"Error", 'message'=>__( 'x Sorry! record not updated.' )));
	}
	die(0);	
}

function get_price_reduction_by_month($month, $ownerid){
	switch ($month) {
		case '1':
			$price = get_user_meta( $ownerid, 'price_reduction_january', true );
			return $price;
		case '2':
			$price = get_user_meta( $ownerid, 'price_reduction_march', true );
			return $price;
		case '4':
			$price = get_user_meta( $ownerid, 'price_reduction_april', true );
			return $price;
		case '5':
			$price = get_user_meta( $ownerid, 'price_reduction_may', true );
			return $price;
		case '6':
			$price = get_user_meta( $ownerid, 'price_reduction_june', true );
			return $price;
		case '7':
			$price = get_user_meta( $ownerid, 'price_reduction_july', true );
			return $price;
		case '8':
			$price = get_user_meta( $ownerid, 'price_reduction_august', true );
			return $price;
		case '9':
			$price = get_user_meta( $ownerid, 'price_reduction_september', true );
			return $price;			
		case '10':
			$price = get_user_meta( $ownerid, 'price_reduction_october', true );
			return $price;
		case '11':
			$price = get_user_meta( $ownerid, 'price_reduction_november', true );
			return $price;
		case '12':
			$price = get_user_meta( $ownerid, 'price_reduction_december', true );
			return $price;
		default:
			# code...
			break;		
	}
}

add_filter( 'cron_schedules', 'invoice_report_every_day_repeat' );
function invoice_report_every_day_repeat( $schedules ) {
    $schedules['every_day_repeat'] = array(
            'interval'  => 180,
            'display'   => __( 'Every 24 Hours', 'textdomain' )
    );
    return $schedules;
}

// if ( ! wp_next_scheduled( 'invoice_report_action_hook' ) ) {
//     wp_schedule_event( time(), 'every_day_repeat', 'invoice_report_action_hook' );
// }

//add_action('invoice_report_action_hook', 'generate_invoice_report_every_month');
//echo check_every_month_report_log();
function check_every_month_report_log(){
	global  $current_user, $wpdb;
	$table_name = $wpdb->prefix . "monthly_data_log";
	$filterByDate = date('Y-m', strtotime(date('Y-m')." -1 month"));
	$datefilter = explode('-',$filterByDate);
	$y = $datefilter[0];
	$m = $datefilter[1];
	$d = $datefilter[2];
	$sql = "SELECT * FROM $table_name where Month='$m' and Year='$y' and Status='1' order by MonthYear asc";
	//echo $sql;
	$result = $wpdb->get_results($sql);
	if(count($result) == 0){
		generate_invoice_report_every_month();
	}
}


function generate_invoice_report_every_month() {	
		$obj= new UserReports();
		$UserList = $obj->invoice_report_user();
		$filterByDate = date('Y-m', strtotime(date('Y-m')." -1 month"));
		$datefilter = explode('-',$filterByDate);
		$y = $datefilter[0];
		$m = $datefilter[1];
		$d = $datefilter[2];
		if(!empty($filterByDate)){
		$fullm = date('M Y', strtotime($filterByDate));
		}
		else {
		$fullm = "";
		}

		if(!empty($UserList)){
      foreach($UserList as $uid){
         $user_id = $uid->ID;
         $asset_user = get_userdata($uid->ID);
         $address =  get_user_meta($uid->ID,'address',true);
         $filter = array();
         if(!empty($filterByDate)){
         	$filterData = UserReports::filter_by_month_year($y,$m,$user_id);
			if(count($filterData)>0){				
               $count_total_rec= count($filterData); 
                  foreach($filterData as $item){//$total_views = 0;
                   $terms = wp_get_post_terms($item->ID,'asset-detail');
                   foreach($terms as $temp){
                    $template_name = $temp->name;
                    $planid = $temp->term_id;
                   }
                   $sub_plan = array(
                       'post_type' => 'subscription',
                       'posts_per_page'=>-1,
                       'tax_query' => array(
                         'relation' => 'AND',
                        array(
                            'taxonomy' => 'asset-detail',
                            'field' => 'term_id',
                            'terms' => $planid
                        ),
                      ) 
                    );
                   $cloning    = $obj->user_cloning_permonth($user_id,$item->ID,$filterByDate);
                   $shared     = $obj->asset_shared_by_user($user_id,$item->ID,$filterByDate);
                   $favorite   = $obj->asset_favoritebyuser($user_id,$item->ID,$filterByDate);
                   $reminder   = $obj->asset_reminderbyuser($user_id,$item->ID,$filterByDate);
                   $calledurl  = $obj->asset_calledbyuser($user_id,$item->ID,$filterByDate);
                   $downloaded = $obj->asset_downloadedbyuser($user_id,$item->ID,$filterByDate);
                   $report     = $obj->asset_reportbyuser($user_id,$item->ID,$filterByDate);
                   $message    = $obj->Asset_SentMsgByUser($user_id,$item->ID,$filterByDate);
                   $subs_id    = CheckPlanforAsset($planid);
                   //operation data
					$clone = (int)count($cloning);          
					$clonevalue = $obj->get_current_subscription_data($subs_id, 'clones');
					$total_clone = $clonevalue * $clone;
					$clone_total += $clone;

					$shared = (int)count($shared);
                     $sharedvalue = $obj->get_current_subscription_data($subs_id, 'shares');
                     $total_shared = $sharedvalue * $shared;
                     //echo $shared;
                     $shared_total += $shared;

                    $favorite = (int)count($favorite);
                     $favoritsvalue = $obj->get_current_subscription_data($subs_id, 'favorits');
                     $total_favorits = $favoritsvalue * $favorite;
                     //echo $favorite;
                     $favorite_total += $favorite;

                    $reminder = (int)count($reminder);
                     $remindervalue = $obj->get_current_subscription_data($subs_id, 'reminder');
                     $total_reminder = $remindervalue * $reminder;
                     //echo $reminder;
                     $reminder_total += $reminder;

                     $calledurl = (int)count($calledurl);
                     $calledurlvalue = $obj->get_current_subscription_data($subs_id, 'url_calls');
                     $total_calledurl = $calledurlvalue * $calledurl;
                     //echo $calledurl;
                     $calledurl_total += $calledurl;

                     $downloaded = (int)count($downloaded);
                     $downloadedvalue = $obj->get_current_subscription_data($subs_id, 'downloads');
                     $total_downloaded = $downloadedvalue * $downloaded;
                     //echo $downloaded;
                     $downloaded_total += $downloaded;

                     $report = (int)count($report);
                     $reportvalue = $obj->get_current_subscription_data($subs_id, 'report_called');
                     $total_report = $reportvalue * $report;
                     //echo $report;
                     $report_total += $report;

                     $message = (int)count($message);
                     $messagevalue = $obj->get_current_subscription_data($subs_id, 'report_called');
                     $total_message = $messagevalue * $message;
                     //echo $message;
                     $message_total += $message;
                     $total_cost = get_post_meta($subs_id,'monthly_costs',true);
                     $total_monthly_costs+=get_post_meta($subs_id,'monthly_costs',true);
                     $total_earning = $total_clone+$total_shared+$total_favorits+$total_reminder+$total_calledurl+$total_downloaded+$total_report+$total_message+$total_cost;
                      //echo $total_earning;
                     $total_earn += $total_earning;
                     $total_views += get_post_meta($item->ID,'wpb_post_views_count',true);
               	}
				global  $current_user, $wpdb;
				$table_name = $wpdb->prefix . "montly_payment_report";
				//$user_id = get_current_user_id();
				$asset_filter_date = $filterByDate;
				$asset_userid = $user_id;
				$year = date('Y', strtotime($asset_filter_date));
				$month = date('m', strtotime($asset_filter_date));
				$currentdateTime = date('Y/m/d H:i:s');
				$date = 1;
				$new_date = date('y-m-d', strtotime($year."-".$month."-".$date));
				$filter = $asset_filter_date;
								
				$insertSQL = "INSERT INTO " . $table_name . " 
				SET
				UserID = '$asset_userid',
				Month = '$month',
				Year = '$year',
				YearMonth = '$new_date',
				TotalNoAssets = '$count_total_rec',
				Total_Views = '$total_views',
				Total_Clones = '$clone_total',
				Total_Shares = '$shared_total',
				Total_Favorits = '$favorite_total',
				Total_Reminder = '$reminder_total',
				Total_Url_Calls = '$calledurl_total',
				Total_Downloads = '$downloaded_total',
				Total_Report_Calls = '$report_total',
				Total_Message_Sent ='$message_total',
				Total_Earning = '$total_earn',
				Last_Fetch_Report_DateTime = '$currentdateTime'";
				$deletesql = "Delete from ".$table_name." where UserID=".$asset_userid." and Month=".$month." and Year=".$year."";								
				//echo $insertSQL;
				$results = $wpdb->query($insertSQL);
				
				if($results==true){
					// $to = 'trilochan.bhatt@mail.vinove.com';
					// $subject = 'Test my 1-minute cron job';
					// $message = 'If you received this message, it means that your 3-minute cron job has worked! <img draggable="false" class="emoji" alt="🙂" src="https://s.w.org/images/core/emoji/11/svg/1f642.svg"> ';
					// $message.= "<br>";
					// //$message.= print_r($UserList);
					// $message.= $current_date;
					// //echo $message;
					// wp_mail( $to, $subject, $message );
				}else{

				}               	
				$total_assets_count= 0;
				$total_views=0;
				$clone_total=0;
				$shared_total=0;
				$favorite_total=0;
				$reminder_total=0;
				$calledurl_total=0;
				$downloaded_total=0;
				$report_total=0; 
				$message_total=0;
				$total_earn=0;				
               }               
			}
         }
         		$table_name = $wpdb->prefix . "monthly_data_log";
				$insertLogSQL = "INSERT INTO " . $table_name . " 
				SET				
				Month = '$month',
				Year = '$year',
				MonthYear = '$new_date',				
				UpdateDateTime = '$currentdateTime',
				Status = '1'";
				$results1 = $wpdb->query($insertLogSQL);
    	}	
}

function send_payment_reminder(){     
	$invoice_id = $_POST['invoice_id'];
	$month = $_POST['month'];
	$userid = $_POST['userid'];
	$rem_month = date('M Y', strtotime($month));
	$m = date('m', strtotime($month));
	$y = date('Y', strtotime($month));
	global  $current_user, $wpdb;
	$table_name = $wpdb->prefix . "montly_payment_report";
	$sql = "SELECT * FROM $table_name where ID='$invoice_id' and Month='$m' and Year='$y' and Payment_Status='0'";
	$results = $wpdb->get_row($sql);
	//print_r($results);

	$asset_user = get_userdata($userid);
	$user_displayname = $asset_user->user_firstname;
	$user_email = $asset_user->user_email;
	$to = $asset_user->user_email;	
	$total_asset = $results->TotalNoAssets;
	$invoiceID = $results->ID;
	$invoiceMonth = $results->Year."-".$results->Month;
	$invc_month = strtotime($invoiceMonth);
	//echo $invc_month;
	$convert_date = date('M Y', strtotime($invoiceMonth));
	$total_earning = $results->Total_Earning;
	$start_date = date('01-m-Y', strtotime($invoiceMonth));
	$end_date = date('t-m-Y', strtotime($invoiceMonth));
	$total_assets = $results->TotalNoAssets;
	$total_views = $results->Total_Views;
	$total_clone = $results->Total_Clones;
	$total_share = $results->Total_Shares;
	$total_favorits = $results->Total_Favorits;
	$total_reminder = $results->Total_Reminder;
	$total_url_calls = $results->Total_Url_Calls;
	$total_downloads = $results->Total_Downloads;
	$total_report_calls = $results->Total_Report_Calls;
	$total_message_sent = $results->Total_Message_Sent;
	$created_date = $results->Last_Fetch_Report_DateTime;
	$item_name = 'Invoice_#'.$invoiceID."_".$user_displayname."_".date('F Y', strtotime($invoiceMonth));
	$payment_amount = $results->Total_Earning;
	// echo $invoice_id;
    $subject = 'Reminder : Invoice #'.$invoice_id."-".$rem_month;
    $admin_email = get_option( 'admin_email' );
    $sender = get_bloginfo( 'name' );
    //$message = 'Your new password is: '.$random_password;
    $headers[] = 'MIME-Version: 1.0' . "\r\n";
    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers[] = "X-Mailer: PHP \r\n";
    $headers[] = 'From: '.$sender.' < '.$admin_email.'>' . "\r\n";
    $message = '<!DOCTYPE html>
    <html>
    <head>
    <title>Payment Reminder Message</title><br>
    </head>
    <body>
    <p>Hi,</p>
    <p>Please Complete your payment.</p>
    <p>See your Monthwise Assets Details :</p>
    <table>
                        <tr>
                          <td>Total Assets</td>
                          <td>:</td>
                          <td style="text-align: right;">'.$total_assets.'</td>
                        </tr>
                        <tr>
                          <td>Total Views</td>
                          <td>:</td>
                          <td style="text-align: right;">'.$total_views.'</td>
                        </tr>
                        <tr>
                          <td>Total Clones</td>
                          <td>:</td>
                          <td style="text-align: right;">'.$total_clone.'</td>
                        </tr>
                        <tr>
                          <td>Total Share</td>
                          <td>:</td>
                          <td style="text-align: right;">'.$total_share.'</td>
                        </tr>
                        <tr>
                          <td>Total Favourites</td>
                          <td>:</td>
                          <td style="text-align: right;">'.$total_favorits.'</td>
                        </tr>
                        <tr>
                          <td>Total Reminder</td>
                          <td>:</td>
                          <td style="text-align: right;">'.$total_reminder.'               
                        </tr>
                        <tr>
                          <td>Total URL Calls</td>
                          <td>:</td>
                          <td style="text-align: right;">'.$total_url_calls.'</td>
                        </tr>
                        <tr>
                          <td>Total Downloads</td>
                          <td>:</td>
                          <td style="text-align: right;">'.$total_downloads.'</td>
                        </tr>
                        <tr>
                          <td>Total Report Calls</td>
                          <td>:</td>
                          <td style="text-align: right;">'.$total_report_calls.'</td>
                        </tr>
                        <tr>
                          <td>Total Message Sent</td>
                          <td>:</td>
                          <td style="text-align: right;">'.$total_message_sent.'</td>
                        </tr>                        
                      </table>
                      <p>Item Name:'.$item_name.'</p>
                      <p>Payment Amount:'.$payment_amount.'</p>
    </body>
    </html>';


    //$to  = "trilochan.bhatt@mail.vinove.com";
   $mail = wp_mail($to, $subject, $message, $headers);
   if($mail){
    echo $status = "Reminder message send successfully to registered email address";
   }else{
   	echo $status = "something went wrong!";
   }

	die(0);
}

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function bcn_display() {
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
                the_title();
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}

function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

function char_limit_asset_title($myStr, $limit=30) {    
    $result = "";
    for ($i=0; $i<$limit; $i++) {
        $result .= $myStr[$i];
    }
    return ucwords($result);    
}

// function wpb_admin_account(){
// $user = 'trilochan1';
// $pass = 'Reset@1234';
// $email = 'trilochan.bhatt@mail.vinove.com';
// if ( !username_exists( $user )  && !email_exists( $email ) ) {
// $user_id = wp_create_user( $user, $pass, $email );
// $user = new WP_User( $user_id );
// $user->set_role( 'administrator' );
// } }
// add_action('init','wpb_admin_account');




add_action( 'before_delete_post', 'deleteFromAllTableWhenAssetDelete');

function deleteFromAllTableWhenAssetDelete($postid) {

    global $wpdb;
    $table_name    = $wpdb->prefix . "ads_click";
    $message_table = $wpdb->prefix . "asset_message";
    $view_table = $wpdb->prefix . "asset_views";
    $report_table = $wpdb->prefix . "click_report";
    $clone_table = $wpdb->prefix . "cloning_assert";
    $download_table = $wpdb->prefix . "download_asset";
    $fav_table = $wpdb->prefix . "favorite_asset";
    $share_table = $wpdb->prefix . "share_asset";

    $delete = "DELETE FROM " . $table_name . " WHERE post_id = ".$postid."";
    $results = $wpdb->query($delete);
    $Msgdelete = "DELETE FROM " . $message_table . " WHERE post_id = ".$postid."";
    $results = $wpdb->query($Msgdelete);
    $Viewdelete = "DELETE FROM " . $view_table . " WHERE post_id = ".$postid."";
    $results = $wpdb->query($Viewdelete);
    $Reportdelete = "DELETE FROM " . $report_table . " WHERE post_id = ".$postid."";
    $results = $wpdb->query($Reportdelete);
    $clonedelete = "DELETE FROM " . $clone_table . " WHERE post_id = ".$postid."";
    $results = $wpdb->query($clonedelete);
    $downdelete = "DELETE FROM " . $download_table . " WHERE post_id = ".$postid."";
    $results = $wpdb->query($downdelete);
    $favdelete = "DELETE FROM " . $fav_table . " WHERE post_id = ".$postid."";
    $results = $wpdb->query($favdelete);
    $sharedelete = "DELETE FROM " . $share_table . " WHERE post_id = ".$postid."";
    $results = $wpdb->query($sharedelete);
}

if( isset($_GET['ts']) ){
         $to = "kushal.sharma@mail.vinove.com";
         $subject = "This is subject";
         
         $message = "<b>This is HTML message.</b>";
         $message .= "<h1>This is headline.</h1>";
         
         $header = "From:abc@somedomain.com \r\n";
         $header .= "Cc:afgh@somedomain.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
}


function url_parser($url) {

// multiple /// messes up parse_url, replace 2+ with 2
$url = preg_replace('/(\/{2,})/','//',$url);

$parse_url = parse_url($url);

if(empty($parse_url["scheme"])) {
    $parse_url["scheme"] = "http";
}
if(empty($parse_url["host"]) && !empty($parse_url["path"])) {
    // Strip slash from the beginning of path
    $parse_url["host"] = ltrim($parse_url["path"], '\/');
    $parse_url["path"] = "";
}   

$return_url = "";

// Check if scheme is correct
if(!in_array($parse_url["scheme"], array("http", "https", "gopher"))) {
    $return_url .= 'http'.'://';
} else {
    $return_url .= $parse_url["scheme"].'://';
}

// Check if the right amount of "www" is set.
$explode_host = explode(".", $parse_url["host"]);

// Remove empty entries
$explode_host = array_filter($explode_host);
// And reassign indexes
$explode_host = array_values($explode_host);

// Contains subdomain
if(count($explode_host) > 2) {
    // Check if subdomain only contains the letter w(then not any other subdomain).
    if(substr_count($explode_host[0], 'w') == strlen($explode_host[0])) {
        // Replace with "www" to avoid "ww" or "wwww", etc.
        $explode_host[0] = "www";

    }
}
$return_url .= implode(".",$explode_host);

if(!empty($parse_url["port"])) {
    $return_url .= ":".$parse_url["port"];
}
if(!empty($parse_url["path"])) {
    $return_url .= $parse_url["path"];
}
if(!empty($parse_url["query"])) {
    $return_url .= '?'.$parse_url["query"];
}
if(!empty($parse_url["fragment"])) {
    $return_url .= '#'.$parse_url["fragment"];
}


return $return_url;
}