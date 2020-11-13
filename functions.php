<?php
/**
 * Edali functions and definitions
 * @package Edali
 */
/*if ( file_exists( dirname( _FILE_ ) . '/languages/' . get_locale() . '.mo' ) ){
    load_textdomain( 'edali', dirname( _FILE_ ) . '/languages/' . get_locale() . '.mo' );
}*/
/**
 * Shorthand contents for theme assets url
 */
define('EDALI_VERSION', time());
define('EDALI_THEME_URI', get_template_directory_uri());
define('EDALI_THEME_DIR', get_template_directory());
define('EDALI_IMG',EDALI_THEME_URI . '/assets/img');
define('EDALI_CSS',EDALI_THEME_URI . '/assets/css');
define('EDALI_JS',EDALI_THEME_URI . '/assets/js');
if( !defined('EDALI_FRAMEWORK_VAR') ) define('EDALI_FRAMEWORK_VAR', 'edali_opt');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
if ( ! function_exists( 'edali_setup' ) ) :

	function edali_setup() {
		
		// Make theme available for translation.
		load_theme_textdomain( 'edali', EDALI_THEME_DIR. '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		
		// Add theme support yost seo plugin breadcrumbs
		add_theme_support( 'yoast-seo-breadcrumbs' );

		// Edali blog post image size for EL
		add_image_size( 'edali_el_blog_post_thumb', 500, 404, true );
		add_image_size( 'edali_project_slider', 800, 800, true );
		add_image_size( 'edali_post_thumb', 730, 400, true );

		add_image_size( 'edali_el_banner_one', 690, 570, true );
		add_image_size( 'edali_el_about_one_thumb', 585, 600, true );
		add_image_size( 'edali_el_about_two_thumb', 260, 300, true );
		add_image_size( 'edali_el_about_three_thumb', 310, 425, true );
		add_image_size( 'edali_el_about_four_thumb', 750, 500, true );
		add_image_size( 'edali_courses_gallery_thumb', 600, 485, true );
		add_image_size( 'edali_instructor_slider_thumb', 325, 340, true );
		add_image_size( 'edali_event_thumb', 510, 390, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 	=> esc_html__( 'Primary Menu', 'edali' ),
		) );

		// Switch default core markup for search form, comment form, and comments
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'edali_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function edali_content_width() {
	// This variable is intended to be overruled from themes.
	$GLOBALS['content_width'] = apply_filters( 'edali_content_width', 640 );
}
add_action( 'after_setup_theme', 'edali_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'edali_scripts' ) ) :

	function edali_scripts() {

		wp_enqueue_style( 'edali-style', get_stylesheet_uri() );
		wp_style_add_data( 'edali-style', 'rtl', 'replace' );
		wp_enqueue_style( 'vendor', 			EDALI_CSS . '/vendor.min.css', null,EDALI_VERSION );

		// WooCommerce CSS
		if ( class_exists( 'WooCommerce' ) ):
			wp_enqueue_style( 'edali-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css');
		endif;
		wp_enqueue_style( 'edali-main-style', 	EDALI_CSS . '/style.css', null,EDALI_VERSION );
		wp_enqueue_style( 'edali-responsive', 	EDALI_CSS . '/responsive.css', null,EDALI_VERSION );// RTL CSS add after css main file 
		if( edali_rtl() == true ):
			wp_enqueue_style( 'edali-rtl', get_template_directory_uri() . '/rtl.css' );
		endif;

		wp_enqueue_script( 'vendor', 				EDALI_JS . '/vendor.min.js', array('jquery'),EDALI_VERSION );
		wp_enqueue_script( 'edali-main', 			EDALI_JS . '/main.js', array('jquery'),EDALI_VERSION );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'edali_scripts' );

if ( ! function_exists( 'edali_fonts' ) ) {
	function edali_fonts() {
		wp_enqueue_style( 'edali-fonts', "//fonts.googleapis.com/css?family=Open+Sans:400,500,600,700,800|Poppins:400,500,600,700,800,900&display=swap", '', '1.0.0', 'screen' );
	}
}
add_action( 'wp_enqueue_scripts', 'edali_fonts' );

/**
 * Custom template tags for this theme.
 */
require EDALI_THEME_DIR. '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require EDALI_THEME_DIR. '/inc/template-functions.php';

/**
 * Acf meta
 */
require EDALI_THEME_DIR. '/inc/acf.php';

/**
 * Customizer additions.
 */
require EDALI_THEME_DIR. '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require EDALI_THEME_DIR. '/inc/jetpack.php';
}

/**
 * Load bootstrap navwalker 
 */
require EDALI_THEME_DIR. '/inc/bootstrap-navwalker.php';

/**
 * Load theme widgets
 */
require EDALI_THEME_DIR. '/inc/widget.php';

/**
 * Custom style
 */
require EDALI_THEME_DIR. '/inc/custom-style.php';

/**
 * Social link
 */
require EDALI_THEME_DIR. '/inc/social-link.php';

/**
 * Demo data import
 */
require EDALI_THEME_DIR. '/lib/demo-import.php';

/**
 * Recommended plugin
 */
require EDALI_THEME_DIR. '/lib/recommended-plugin.php';

/**
 * Custom functions for LearnPress 3.x
 */
if ( class_exists( 'LearnPress' ) ) {
	require EDALI_THEME_DIR. '/inc/learnpress.php';	
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require EDALI_THEME_DIR. '/inc/woocommerce.php';
}

/**
 * Filter the categories archive widget to add a span around post count
 */
if ( ! function_exists( 'edali_cat_count_span' ) ) {
	function edali_cat_count_span( $links ) {
		$links = str_replace( '</a> (', '</a><span class="post-count">(', $links );
		$links = str_replace( ')', ')</span>', $links );
		return $links;
	}
}
add_filter( 'wp_list_categories', 'edali_cat_count_span' );

/**
 * Filter the archives widget to add a span around post count
 */
if ( ! function_exists( 'edali_archive_count_span' ) ) {
	function edali_archive_count_span( $links ) {
		$links = str_replace( '</a>&nbsp;(', '</a><span class="post-count">(', $links );
		$links = str_replace( ')', ')</span>', $links );
		return $links;
	}
}
add_filter( 'get_archives_link', 'edali_archive_count_span' );

/**
 * Excerpt more text
 */
if ( ! function_exists( 'edali_excerpt_more' ) ) :
	function edali_excerpt_more( $more ) {
		return ' ';
	}
endif;
add_filter('excerpt_more', 'edali_excerpt_more');

/**
 * Remove pages from search result
 */
if ( ! function_exists( 'edali_remove_pages_from_search' ) ) :
    function edali_remove_pages_from_search() {
		global $wp_post_types;
		$wp_post_types['page']->exclude_from_search = true;
	}
endif;
add_action('init', 'edali_remove_pages_from_search');

/**
 * If page edited by elementor
 */
if ( ! function_exists( 'edali_is_elementor' ) ) :
	function edali_is_elementor(){
		if ( function_exists( 'elementor_load_plugin_textdomain' ) ):
			global $post;
			if( $post != '' ):
				return \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);
			endif;
		endif;
	}
endif;

// Live demo rtl link
if( edali_rtl() == true ):
	function edali_menu_anchors($items, $args) {
		foreach ($items as $key => $item) {
			if ($item->object == 'page') {
				$item->url = $item->url.'?rtl=enable';
			}
		}

		return $items;
	}
	add_filter('wp_nav_menu_objects', 'edali_menu_anchors', 10, 2);
endif;


/**
 * Classes
 */
require get_template_directory() . '/inc/classes/Edali_base.php';
require get_template_directory() . '/inc/classes/Edali_rt.php';
require get_template_directory() . '/inc/classes/Edali_admin_page.php';
require get_template_directory() . '/inc/admin/dashboard/Edali_admin_dashboard.php';


/**
 * Admin dashboard style and scripts
 */
add_action( 'admin_enqueue_scripts', function() {
    global $pagenow;
    wp_enqueue_script( 'edali-admin', EDALI_JS.'/edali-admin.js', array('jquery'), '1.0.0', true );
    if ( $pagenow == 'admin.php' ) {
        wp_enqueue_style( 'edali-admin-dashboard', EDALI_CSS.'/admin-dashboard.min.css' );
    }
});

/**
 * Redirect after theme activation
 */
add_action( 'after_switch_theme', function() {
    if ( isset( $_GET['activated'] ) ) {
		wp_safe_redirect( admin_url('admin.php?page=edali') );
		
		update_option('edali_purchase_code_status', 'valid', 'yes');
        update_option('edali_purchase_valid_code',  'bluerose', 'yes');
		update_option( 'edali_purchase_code', 'bluerose', 'yes' );
	}
	update_option('notice_dismissed', '0');
});

/**
 * Notice dismiss handle
 */
add_action( 'admin_init', function() {
    if ( isset($_GET['dismissed']) && $_GET['dismissed'] == 1 ) {
        update_option('notice_dismissed', '1');
    }
});
		if (is_rtl()){
add_action('admin_print_styles', 'themesazan_admin_styles');
function themesazan_admin_styles(){
     wp_enqueue_style('themesazan-rtl-main-style', get_template_directory_uri() . '/rtl-admin.css', false);
	

}}