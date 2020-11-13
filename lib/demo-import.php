<?php
/**
 * One Click Demo Import
 * @package WordPress
 * @subpackage edali
 * 
 */
if ( ! function_exists( 'edali_import_files' ) ) {
    function edali_import_files() {
        return array(
            array(
                'import_file_name'             => esc_html__('Edali Demo Data With LearnPress', 'edali'),
                'local_import_file'            => trailingslashit( get_template_directory() ) . '/lib/demo-data/lp/edali-demo.xml',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . '/lib/demo-data/lp/edali-widgets.json',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . '/lib/demo-data/lp/edali-export.dat',
                'local_import_redux'           => array(
                    array(
                        'file_path'   => trailingslashit( get_template_directory() ) . '/lib/demo-data/lp/redux-options.json',
                        'option_name' => 'edali_opt',
                    ),
                ),
                'import_notice'        => wp_kses_post( 'After import demo, just set static homepage from settings>reading and check widgets & menus. <br></br> Go to LearnPress > Settings and choose the page you like to be your Logout Redirect, Course, Profile, and Checkout page.', 'edali' ),
            ),
            array(
                'import_file_name'             => esc_html__('Edali Demo Data With Tutor LMS', 'edali'),
                'local_import_file'            => trailingslashit( get_template_directory() ) . '/lib/demo-data/tutor/edali-demo.xml',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . '/lib/demo-data/tutor/edali-widgets.json',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . '/lib/demo-data/tutor/edali-export.dat',

                'local_import_redux'           => array(
                    array(
                        'file_path'   => trailingslashit( get_template_directory() ) . '/lib/demo-data/tutor/redux-options.json',
                        'option_name' => 'edali_opt',
                    ),
                ),
                'import_notice'        => wp_kses_post( 'After import demo, just set static homepage from settings>reading and check widgets & menus. <br></br> Go to Tutor LMS > Settings and choose the page you like to be your Dashboard and Course page.', 'edali' ),
            ),
        );
    }
}

$pcs = trim( get_option( 'edali_purchase_code_status' ) );
if ( $pcs == 'valid' ) :
    add_filter( 'pt-ocdi/import_files', 'edali_import_files' );
endif;


if ( ! function_exists( 'edali_after_import_files' ) ) {
    function edali_after_import_files() {
        if ( class_exists( 'RevSlider' ) ) {
            $slider_array = array(
            get_template_directory()."/lib/demo-data/revslider/banner-slider.zip",
            );

            $slider = new RevSlider();
        
            foreach($slider_array as $filepath){
            $slider->importSliderFromPost(true,true,$filepath);  
            }
        
            echo esc_html__('Slider processed', 'edali');
        }
    }
}
add_filter( 'pt-ocdi/after_import', 'edali_after_import_files' );