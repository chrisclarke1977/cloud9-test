<?php
/**
 * Very Simple Start functions and definitions
 *
 * @package Very Simple Start
 */


if ( ! function_exists( 'verysimplestart_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function verysimplestart_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Very Simple Start, use a find and replace
	 * to change 'verysimplestart' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'verysimplestart', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Content width
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1170; /* pixels */
	}	

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('verysimplestart-large-thumb', 830);
	add_image_size('verysimplestart-medium-thumb', 550, 400, true);
	add_image_size('verysimplestart-small-thumb', 230);
	add_image_size('verysimplestart-service-thumb', 350);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'verysimplestart' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'verysimplestart_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	// Set up the image as the default slider
	if(!get_theme_mod('front_header_type')){
		set_theme_mod('front_header_type','image');
	}
}
endif; // verysimplestart_setup
add_action( 'after_setup_theme', 'verysimplestart_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function verysimplestart_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'verysimplestart' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	//Footer widget areas
	$widget_areas = get_theme_mod('footer_widget_areas', '3');
	for ($i=1; $i<=$widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer ', 'verysimplestart' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	//Register the front page widgets
	if ( function_exists('siteorigin_panels_activate') ) {
		register_widget( 'VerySimpleStart_List' );
		register_widget( 'VerySimpleStart_Services_Type_A' );
		register_widget( 'VerySimpleStart_Services_Type_B' );
		register_widget( 'VerySimpleStart_Facts' );
		register_widget( 'VerySimpleStart_Clients' );
		register_widget( 'VerySimpleStart_Testimonials' );
		register_widget( 'VerySimpleStart_Skills' );
		register_widget( 'VerySimpleStart_Action' );
		register_widget( 'VerySimpleStart_Video_Widget' );
		register_widget( 'VerySimpleStart_Social_Profile' );
		register_widget( 'VerySimpleStart_Team' );
		register_widget( 'VerySimpleStart_Latest_News' );
		register_widget( 'VerySimpleStart_Contact_Info' );
	}

}
add_action( 'widgets_init', 'verysimplestart_widgets_init' );

/**
 * Load the front page widgets.
 */
if ( function_exists('siteorigin_panels_activate') ) {
	require get_template_directory() . "/widgets/fp-list.php";
	require get_template_directory() . "/widgets/fp-services-type-a.php";
	require get_template_directory() . "/widgets/fp-services-type-b.php";
	require get_template_directory() . "/widgets/fp-facts.php";
	require get_template_directory() . "/widgets/fp-clients.php";
	require get_template_directory() . "/widgets/fp-testimonials.php";
	require get_template_directory() . "/widgets/fp-skills.php";
	require get_template_directory() . "/widgets/fp-call-to-action.php";
	require get_template_directory() . "/widgets/video-widget.php";
	require get_template_directory() . "/widgets/fp-social.php";
	require get_template_directory() . "/widgets/fp-team.php";
	require get_template_directory() . "/widgets/fp-latest-news.php";
	require get_template_directory() . "/widgets/contact-info.php";
}

/**
 * Enqueue scripts and styles.
 */
function verysimplestart_scripts() {

	if ( get_theme_mod('body_font_name') !='' ) {
	    wp_enqueue_style( 'verysimplestart-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('body_font_name')) ); 
	} else {
	    wp_enqueue_style( 'verysimplestart-body-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,600');
	}

	if ( get_theme_mod('headings_font_name') !='' ) {
	    wp_enqueue_style( 'verysimplestart-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('headings_font_name')) ); 
	} else {
	    wp_enqueue_style( 'verysimplestart-headings-fonts', '//fonts.googleapis.com/css?family=Open Sans:400,500,600,700'); 
	}	

	wp_enqueue_style( 'verysimplestart-style', get_stylesheet_uri() );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );		

	wp_enqueue_style( 'verysimplestart-ie9', get_template_directory_uri() . '/css/ie9.css', array( 'verysimplestart-style' ) );
	wp_style_add_data( 'verysimplestart-ie9', 'conditional', 'lte IE 9' );	

	wp_enqueue_script( 'verysimplestart-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'),'', true );

	wp_enqueue_script( 'verysimplestart-main', get_template_directory_uri() . '/js/main.min.js', array('jquery'),'', true );

	wp_enqueue_script( 'verysimplestart-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( get_theme_mod('blog_layout') == 'masonry-layout' && (is_home() || is_archive()) ) {

		wp_enqueue_script( 'masonry-init', get_template_directory_uri() . '/js/masonry-init.js', array( 'jquery-masonry' ),'', true );		
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'verysimplestart_scripts' );

/**
 * Enqueue Bootstrap
 */
function verysimplestart_enqueue_bootstrap() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'verysimplestart_enqueue_bootstrap', 9 );

/**
 * Change the excerpt length
 */
function verysimplestart_excerpt_length( $length ) {
  
  $excerpt = get_theme_mod('exc_lenght', '55');
  return $excerpt;

}
add_filter( 'excerpt_length', 'verysimplestart_excerpt_length', 999 );

/**
 * Blog layout
 */
function verysimplestart_blog_layout() {
	$layout = get_theme_mod('blog_layout','classic');
	return $layout;
}

/**
 * Menu fallback
 */
function verysimplestart_menu_fallback() {
	if ( current_user_can( 'edit_theme_options' ) ) {
		echo '<a class="menu-fallback" href="' . admin_url('nav-menus.php') . '">' . __( 'Create your menu here', 'verysimplestart' ) . '</a>';
	}
}

/**
 * Header image overlay
 */
function verysimplestart_header_overlay() {
	$overlay = get_theme_mod( 'hide_overlay', 0);
	if ( !$overlay ) {
		echo '<div class="overlay"></div>';
	}
}

/**
 * Polylang compatibility
 */
if ( function_exists('pll_register_string') ) :
function verysimplestart_polylang() {
	for ( $i=1; $i<=5; $i++) {
		pll_register_string('Slide title ' . $i, get_theme_mod('slider_title_' . $i), 'Very Simple Start');
		pll_register_string('Slide subtitle ' . $i, get_theme_mod('slider_subtitle_' . $i), 'Very Simple Start');
	}
	pll_register_string('Slider button text', get_theme_mod('slider_button_text'), 'Very Simple Start');
	pll_register_string('Slider button URL', get_theme_mod('slider_button_url'), 'Very Simple Start');
}
add_action( 'admin_init', 'verysimplestart_polylang' );
endif;

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Page builder support
 */
require get_template_directory() . '/inc/page-builder.php';

/**
 * Slider
 */
require get_template_directory() . '/inc/slider.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

/**
 * Theme Options
 */
require get_template_directory() . '/inc/theme-options.php';

/**
 *TGM Plugin activation.
 */
require_once dirname( __FILE__ ) . '/plugins/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'verysimplestart_recommend_plugin' );
function verysimplestart_recommend_plugin() {
 
    $plugins = array(
        array(
            'name'               => 'Page Builder by SiteOrigin',
            'slug'               => 'siteorigin-panels',
            'required'           => false,
        ),
        array(
            'name'               => 'Types - Custom Fields and Custom Post Types Management',
            'slug'               => 'types',
            'required'           => false,
        ),          
        array(
            'name'               => 'Contact Form 7',
            'slug'               => 'contact-form-7',
            'required'           => false,
        ),          
    );
 
    tgmpa( $plugins);
 
}