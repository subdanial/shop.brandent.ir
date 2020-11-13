<?php

/**
 * Template for displaying archive course content.
 *
 * This template can be overridden by copying it to edali/learnpress/content-archive-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined('ABSPATH') || exit();

global $post, $wp_query, $lp_tax_query, $wp_query;

$total = $wp_query->found_posts;

if ($total == 0) {
    $message = '<p class="message message-error">' . esc_html__('No courses found!', 'edali') . '</p>';
    $index   = esc_html__('There are no available courses!', 'edali');
} elseif ($total == 1) {
    $index = esc_html__('Showing only one result', 'edali');
} else {
    $courses_per_page = absint(LP()->settings->get('archive_course_limit'));
    $paged            = get_query_var('paged') ? intval(get_query_var('paged')) : 1;

    $from = 1 + ($paged - 1) * $courses_per_page;
    $to   = ($paged * $courses_per_page > $total) ? $total : $paged * $courses_per_page;

    if ($from == $to) {
        $index = sprintf(
            esc_html__('Showing last course of %s results', 'edali'),
            $total
        );
    } else {
        $index = sprintf(
            esc_html__('Showing %s-%s of %s results', 'edali'),
            $from,
            $to,
            $total
        );
    }
}

$cookie_name = 'course_switch';
$layout      = (!empty($_COOKIE[$cookie_name])) ? $_COOKIE[$cookie_name] : 'grid-layout';

$default_order = apply_filters('edali_default_order_course_option', array(
    'newly-published' => esc_html__('Newly published', 'edali'),
    'alphabetical'    => esc_html__('Alphabetical', 'edali'),
    'most-members'    => esc_html__('Most members', 'edali')
));;

/**
 * @deprecated
 */
do_action('learn_press_before_main_content');

/**
 * @since 3.0.0
 */
do_action('learn-press/before-main-content');

/**
 * @since 3.0.0
 */
do_action('learn-press/archive-description');

?>
<div class="page-title-content">


    <h2><?php learn_press_page_title(); ?></h2>
</div>
<div class="courses-area">
    <div class="courses-topbar">
        <div class="row align-items-center">

            <div class="col-lg-8 col-md-8">
                <div class="topbar-ordering-and-search">
                    <div class="row align-items-center">
                        <div class="offset-lg-7 col-lg-5 col-md-6 col-sm-6">
                            <div class="topbar-search">
                                <form method="get" action="<?php echo esc_url(get_post_type_archive_link('lp_course')); ?>">
                                    <label><i class="bx bx-search"></i></label>
                                    <input type="text" value="" name="s" placeholder="<?php esc_attr_e('Search our courses', 'edali') ?>" class="input-search" autocomplete="off" />
                                    <input type="hidden" value="course" name="ref" />
                                    <input type="hidden" name="post_type" value="lp_course">




                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="topbar-result-count">
               
                    <p><?php echo wp_kses_post($index); ?></p>
                </div>
            </div>


        </div>
    </div>
    <?php
    if (LP()->wp_query->have_posts()) :

        /**
         * @deprecated
         */
        do_action('learn_press_before_courses_loop');

        /**
         * @since 3.0.0
         */
        do_action('learn-press/before-courses-loop');

    ?><div class="row">
            <?php
            while (LP()->wp_query->have_posts()) : LP()->wp_query->the_post();
                learn_press_get_template_part('content', 'course');
            endwhile;
            ?>
        </div>

    <?php

        /**
         * @deprecated
         */
        do_action('learn-press/after-courses-loop');

        wp_reset_postdata();

    else :
        learn_press_display_message(
            __('no course found.', 'edali'),
            'error'
        );
    endif;
    ?>
</div>
<?php
/**
 * @since 3.0.0
 */
do_action('learn-press/after-main-content');

/**
 * @deprecated
 */
do_action('learn_press_after_main_content');
