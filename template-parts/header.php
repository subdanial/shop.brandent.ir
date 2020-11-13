<?php

/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
$site_name = get_bloginfo('name');
$tagline   = get_bloginfo('description', 'display');
?>



<div class="top-nav px-4">
    <div class="row">
        <div class="col-3 d-lg-none">
            <div class="menu js-full-nav-open d-lg-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.6 9.733">
                    <g id="Icon_feather-menu" data-name="Icon feather-menu" transform="translate(1 1)">
                        <path id="Path_1" data-name="Path 1" d="M4.5,18H16.1" transform="translate(-4.5 -14.133)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        <path id="Path_2" data-name="Path 2" d="M4.5,9H16.1" transform="translate(-4.5 -9)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        <path id="Path_3" data-name="Path 3" d="M4.5,27H16.1" transform="translate(-4.5 -19.267)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </g>
                </svg>
            </div>

        </div>
        <div class="col-6 ">
            <div class="logo">
                <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri() ?>/img/logo-orange.png" class="d-block  mx-auto mx-lg-0" alt=""></a>
            </div>
        </div>
        <div class="col-3 col-lg-6 ">
            <div class="icons text-left mt-1">


                <?php if (is_user_logged_in()) : ?>
                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="btn btn-outline-orange mx-2 d-none font-weight-bold d-lg-inline-block">حساب کاربری
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29.628 29.628">
                        <path id="Icon_awesome-user-alt" data-name="Icon awesome-user-alt" d="M14.814,16.666A8.333,8.333,0,1,0,6.481,8.333,8.335,8.335,0,0,0,14.814,16.666Zm7.407,1.852H19.032a10.073,10.073,0,0,1-8.437,0H7.407A7.406,7.406,0,0,0,0,25.924v.926a2.778,2.778,0,0,0,2.778,2.778H26.85a2.778,2.778,0,0,0,2.778-2.778v-.926A7.406,7.406,0,0,0,22.221,18.517Z" fill="#fc6620" />
                    </svg>
                <?php else : ?>
                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="btn btn-outline-orange mx-2 d-none font-weight-bold d-lg-inline-block">ورود
                    به حساب
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29.628 29.628">
                        <path id="Icon_awesome-user-alt" data-name="Icon awesome-user-alt" d="M14.814,16.666A8.333,8.333,0,1,0,6.481,8.333,8.335,8.335,0,0,0,14.814,16.666Zm7.407,1.852H19.032a10.073,10.073,0,0,1-8.437,0H7.407A7.406,7.406,0,0,0,0,25.924v.926a2.778,2.778,0,0,0,2.778,2.778H26.85a2.778,2.778,0,0,0,2.778-2.778v-.926A7.406,7.406,0,0,0,22.221,18.517Z" fill="#fc6620" />
                    </svg>
                </a>
                    
                <?php endif; ?>

                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                    <svg class="d-lg-none px-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29.628 29.628">
                        <path id="Icon_awesome-user-alt" data-name="Icon awesome-user-alt" d="M14.814,16.666A8.333,8.333,0,1,0,6.481,8.333,8.335,8.335,0,0,0,14.814,16.666Zm7.407,1.852H19.032a10.073,10.073,0,0,1-8.437,0H7.407A7.406,7.406,0,0,0,0,25.924v.926a2.778,2.778,0,0,0,2.778,2.778H26.85a2.778,2.778,0,0,0,2.778-2.778v-.926A7.406,7.406,0,0,0,22.221,18.517Z" fill="#fc6620" />
                    </svg>
                </a>
                <a href="<?php echo wc_get_cart_url(); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22.36 19.876">
                        <path id="Icon_awesome-shopping-cart" data-name="Icon awesome-shopping-cart" d="M20.5,11.7l1.835-8.074a.932.932,0,0,0-.909-1.138H6.18L5.825.745A.932.932,0,0,0,4.912,0H.932A.932.932,0,0,0,0,.932v.621a.932.932,0,0,0,.932.932H3.645L6.372,15.817a2.174,2.174,0,1,0,2.6.332h8.138a2.173,2.173,0,1,0,2.469-.4L19.8,14.8a.932.932,0,0,0-.908-1.138H8.467l-.254-1.242h11.38A.932.932,0,0,0,20.5,11.7Z" fill="#fc6620" />
                    </svg>
                </a>
                <a href="#">

                    <svg class="d-none px-1 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28.708 28.713">
                        <path id="Icon_awesome-search" data-name="Icon awesome-search" d="M28.318,24.825l-5.591-5.591a1.345,1.345,0,0,0-.953-.393H20.86a11.658,11.658,0,1,0-2.019,2.019v.914a1.345,1.345,0,0,0,.393.953l5.591,5.591a1.34,1.34,0,0,0,1.9,0l1.587-1.587a1.352,1.352,0,0,0,.006-1.907ZM11.664,18.841a7.178,7.178,0,1,1,7.178-7.178A7.174,7.174,0,0,1,11.664,18.841Z" fill="#fc6620" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="desktop-nav d-none mt-4 d-lg-block">
    <div class="d-flex menu">
        <button class="close ml-2 js-btn-toggle-menu">
            <div class="text js-text-close"><svg xmlns="http://www.w3.org/2000/svg" width="34.76" height="34.76" viewBox="0 0 34.76 34.76">
                    <g id="Icon_feather-menu" data-name="Icon feather-menu" transform="translate(2.828 31.69) rotate(-45)">
                        <path id="Path_2" data-name="Path 2" d="M4.5,9H45.317" transform="translate(-4.5 -9)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" />
                        <path id="Path_14" data-name="Path 14" d="M4.5,27H45.317" transform="translate(-6.591 25.25) rotate(-90)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" />
                    </g>
                </svg>
            </div>
            <div class="text js-text-open"><svg xmlns="http://www.w3.org/2000/svg" width="44.817" height="31.211" viewBox="0 0 44.817 31.211">
                    <g id="Icon_feather-menu" data-name="Icon feather-menu" transform="translate(2 2)">
                        <path id="Path_1" data-name="Path 1" d="M4.5,18H45.317" transform="translate(-4.5 -4.394)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" />
                        <path id="Path_2" data-name="Path 2" d="M4.5,9H45.317" transform="translate(-4.5 -9)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" />
                        <path id="Path_3" data-name="Path 3" d="M4.5,27H45.317" transform="translate(-4.5 0.211)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" />
                    </g>
                </svg>
            </div>
        </button>
        <div class="items js-desktop-nav px-4">
            <!-- <a class="px-3" href="#">محصولات ویژه</a>
                    <a class="px-3" href="#">وبینار های آنلاین</a>
                    <a class="px-3" href="#">کلاس های آموزشی</a>
                    <a class="px-3" href="#">تجهیزات فیزیکی</a> -->


            <?php if (has_nav_menu('primary')) : ?>
                <nav class="site-navigation" role="navigation">
                    <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
                </nav>
            <?php endif; ?>


        </div>
    </div>
</div>