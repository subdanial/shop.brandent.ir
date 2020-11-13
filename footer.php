<?php

/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('footer')) {
	get_template_part('template-parts/footer');
}
?>

<?php wp_footer(); ?>


<div class="js-full-nav full-nav justify-content-center d-lg-none align-items-center">
            <div class="js-full-nav-close close">&times;</div>
            <div class="items">
            <?php if (has_nav_menu('primary')) : ?>
                <nav class="site-navigation" role="navigation">
                    <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
                </nav>
            <?php endif; ?>
            <a href="http://brandent.ir">بازگشت به سایت</a>
            </div>
        </div>

<script src="<?php echo get_template_directory_uri() ?>/node_modules/jquery/dist/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/app.js"></script>
</body>

</html>