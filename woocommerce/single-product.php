<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to edali/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
global $edali_opt;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $edali_opt;

get_header( 'shop' );

if ( isset( $edali_opt['product_bg_image'] ) ): 
    $hide_banner        = $edali_opt['enable_shop_pages_banner'];
    $hide_breadcrumb    = $edali_opt['hide_woo_breadcrumb'];
else:
    $hide_banner        = false;
    $hide_breadcrumb    = false;
endif;

if( function_exists('acf_add_options_page') ) {
	$bg_img = get_field( 'product_banner_background_image' );
}else {
	$bg_img = '';
}

if( $hide_banner == true ):
    $pt_165   = '';
else:
    $pt_165   = 'pt-165';
endif;

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
?>

    <?php if( $hide_banner == true ) { ?>
        <?php if( $bg_img != '' ): ?>
            <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}' style="background-image:url(<?php echo esc_url($bg_img); ?>);">
        <?php else: ?>
            <div class="page-title-area item-bg1">
        <?php endif; ?>
            <div class="container">
                <div class="page-title-content">
                    <h2><?php the_title(); ?></h2>
                    <?php if( $hide_breadcrumb != true ): ?>
                        <?php woocommerce_breadcrumb(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="products-area products_details ptb-100 <?php echo esc_attr( $pt_165 ); ?>">
        <div class="container">
            <div class="row">                
                <?php if ( is_active_sidebar( 'shop' ) ): ?>
                    <?php if ( isset( $_GET['shop-sidebar'] ) ): ?>
                        <?php  $edali_shop_cat_sidebar = $_GET['shop-sidebar']; ?>
                        <?php if ( $edali_shop_cat_sidebar == 'none' ): ?>
                            <div class="col-lg-12 col-md-12">
                        <?php elseif ( $edali_shop_cat_sidebar == 'left' ): ?>
                            <?php do_action( 'woocommerce_sidebar' ); ?>
                            <div class="col-lg-8 col-md-12">
                        <?php elseif ( $edali_shop_cat_sidebar == 'right' ): ?>
                            <div class="col-lg-8 col-md-12">
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if( $edali_opt['edali_product_sidebar'] == 'edali_product_left_sidebar' ): ?>
                            <?php do_action( 'woocommerce_sidebar' ); ?>
                            <div class="col-lg-8 col-md-12">
                        <?php elseif ( $edali_opt['edali_product_sidebar'] == 'edali_product_right_sidebar' ): ?>
                            <div class="col-lg-8 col-md-12">
                        <?php else: ?>
                            <div class="col-lg-12 col-md-12">
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="col-lg-12 col-md-12">
                <?php endif; ?>

                    <?php
                    /**
                     * woocommerce_before_main_content hook.
                     *
                     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                     * @hooked woocommerce_breadcrumb - 20
                     */

                    do_action( 'woocommerce_before_main_content' );
                    ?>

                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php wc_get_template_part( 'content', 'single-product' ); ?>

                        <?php endwhile; // end of the loop. ?>

                    <?php
                        /**
                         * woocommerce_after_main_content hook.
                         *
                         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                         */
                        do_action( 'woocommerce_after_main_content' );
                    ?>
                </div>
                <?php 
                if ( isset( $_GET['shop-sidebar'] ) ):
                    if ( $edali_shop_cat_sidebar == 'right' ) :
                        do_action( 'woocommerce_sidebar' );
                    endif; 
                else:
                    if ( $edali_opt['edali_product_sidebar'] == 'edali_product_right_sidebar' ):
                        do_action( 'woocommerce_sidebar' );
                    endif; 
                endif; 
                ?>
            </div>
        </div>
    </div>
    <?php get_footer( 'shop' );

    /* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
    ?>