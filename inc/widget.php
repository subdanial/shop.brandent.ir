<?php
/**
 * Register Theme Widget
 * @package Edali
 */


// Register sidebar
if ( ! function_exists( 'edali_widgets_init' ) ) {
    function edali_widgets_init() {
        global $edali_opt;
        
        register_sidebar( array(
            'name'          => esc_html__( 'Blog Sidebar', 'edali' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'edali' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        // Shop Sidebar
        register_sidebar( array( 
            'name'          => esc_html__( 'Shop Sidebar', 'edali' ),
            'id'            => 'shop',
            'description'   => esc_html__( 'Add widgets here.', 'edali' ),
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>',
        ) );        

        // bbPress Sidebar
        if ( class_exists( 'bbPress' ) ) {
            register_sidebar( array(
                'name' => esc_html__( 'bbPress Sidebar', 'edali' ),
                'id' => 'bbpress-sidebar',
                'class' => '',
                'description' => esc_html__( 'A sidebar that only appears on bbPress pages.', 'edali' ),
                'before_widget' => '<div id="%1$s" class="widget blog_widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h5 class="widget-title"><span>',
                'after_title' => '</span></h5>',
            ) );
        }

        $footer_column = !empty($edali_opt['footer_column']) ? $edali_opt['footer_column'] : '3';

        register_sidebar(array(
            'name'          => esc_html__( 'Footer widgets', 'enco' ),
            'description'   => esc_html__( 'Add widgets here for Footer widgets area', 'enco' ),
            'id'            => 'footer_widgets',
            'before_widget' => '<div id="%1$s" class="widget single-footer-widget col-lg-'.$footer_column.' col-md-6 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget_title">',
            'after_title'   => '</h3>'
        ));    
        
    }
}
add_action( 'widgets_init', 'edali_widgets_init' );