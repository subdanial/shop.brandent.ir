<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
$pcs = trim( get_option( 'edali_purchase_code_status' ) );

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

if ( $pcs == 'valid' ) {
	add_action( 'tgmpa_register', 'edali_register_required_plugins' );
}

if ( ! function_exists( 'edali_register_required_plugins' ) ) {
	function edali_register_required_plugins() {

		$plugins = array(
			
			array(
				'name'               => esc_html__('Edali Toolkit', 'edali'),
				'slug'               => 'edali-toolkit',
				'source'             => get_stylesheet_directory() . '/lib/plugins/edali-toolkit.zip', 
				'required'           => true,
			),

			// Elementor Page Builder
			array(
				'name'               => esc_html__('Elementor Page Builder', 'edali'),
				'slug'               => 'elementor',
				'required'           => true,
			),

			// Advanced Custom Fields Pro
			array(
				'name'               => esc_html__('Advanced Custom Fields Pro', 'edali'),
				'slug'               => 'advanced-custom-fields-pro',
				'source'             => get_stylesheet_directory() . '/lib/plugins/advanced-custom-fields-pro.zip', 
				'required'           => true,
			),

			// Slider Revolution Pro
			array(
				'name'      => esc_html__('Slider Revolution', 'edali'),
				'slug'      => 'revslider',
				'source'    => get_stylesheet_directory() . '/lib/plugins/revslider.zip',
				'required'  => false,
			),

			array(
				'name'      => esc_html__('WooCommerce', 'edali'),
				'slug'      => 'woocommerce',
				'required'  => false,
			),

			array(
				'name'      => esc_html__('LearnPress', 'edali'),
				'slug'      => 'learnpress',
				'source'    => get_stylesheet_directory() . '/lib/plugins/learnpress.zip',
				'required'  => false,
			),

			array(
				'name'      => esc_html__('Tutor LMS', 'edali'),
				'slug'      => 'tutor',
				'source'    => get_stylesheet_directory() . '/lib/plugins/tutor.zip', 
				'required'  => false,
			),

			array(
				'name'      => esc_html__('LearnPress – Course Review', 'edali'),
				'slug'      => 'learnpress-course-review',
				'required'  => false,
			),

			// Edali Plugins
			array(
				'name'      => esc_html__('Contact Form 7', 'edali'),
				'slug'      => 'contact-form-7',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('Newsletter', 'edali'),
				'slug'      => 'newsletter',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('One Click Demo Import', 'edali'),
				'slug'      => 'one-click-demo-import',
				'required'  => false,
			),
		);

		$config = array(
			'id'           => 'tgmpa',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true, 
			'dismissable'  => true, 
			'dismiss_msg'  => '',   
			'is_automatic' => false, 
			'message'      => '',                      
		);
		tgmpa( $plugins, $config );
	}
}