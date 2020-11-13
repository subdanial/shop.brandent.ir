<?php

/**
 * A single course loop
 *
 * @since v.1.0.0
 * @author envytheme
 * @url https://envytheme.com
 *
 * @package Edali/Templates
 * @version 1.4.3
 */
global $edali_opt;

$lessons_title  = !empty($edali_opt['lessons_title']) ? $edali_opt['lessons_title'] : 'Lessons';
$students_title = !empty($edali_opt['students_title']) ? $edali_opt['students_title'] : 'Students';
$free_text      = !empty($edali_opt['free_text']) ? $edali_opt['free_text'] : 'Free';

$course_id          = get_the_ID();
$tutor_lesson_count = tutor_utils()->get_lesson_count_by_course($course_id);

do_action('tutor_course/loop/before_content');

do_action('tutor_course/loop/badge');

do_action('tutor_course/loop/before_header');
do_action('tutor_course/loop/header');
do_action('tutor_course/loop/after_header');

do_action('tutor_course/loop/start_content_wrap');

do_action('tutor_course/loop/before_title');
do_action('tutor_course/loop/title');
do_action('tutor_course/loop/after_title');

do_action('tutor_course/loop/before_rating');
do_action('tutor_course/loop/rating');
do_action('tutor_course/loop/after_rating');
?>

<div class="courses-box-footer">
    <ul>
        <li class="students-number">
            <i class="bx bx-user"></i>
            <?php echo (int) tutor_utils()->count_enrolled_users_by_course(); ?>  
            <?php echo esc_html( $students_title ); ?>
        </li>

        <li class="courses-lesson">
            <?php
            $course_id          = get_the_ID();
            $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course($course_id);
            ?>
            <i class="bx bx-book-open"></i>
            <?php echo $tutor_lesson_count; ?> <?php echo esc_html( $lessons_title ); ?>                                                
        </li>

        <li class="courses-price">
            <?php
            $course_id = get_the_ID();
            $price_html = '<div class="price"> '.esc_html($free_text).'</div>';
            if (tutor_utils()->is_course_purchasable()) {
                $product_id = tutor_utils()->get_course_product_id($course_id);
                $product    = wc_get_product( $product_id );

                if ( $product ) {
                    $price_html = '<div class="price"> '.$product->get_price_html().' </div>';
                }
            }
            echo $price_html;
            ?>
        </li>
    </ul>
</div>

<?php
// do_action('tutor_course/loop/before_meta');
// do_action('tutor_course/loop/meta');
// do_action('tutor_course/loop/after_meta');


// do_action('tutor_course/loop/before_excerpt');
// do_action('tutor_course/loop/excerpt');
// do_action('tutor_course/loop/after_excerpt');

do_action('tutor_course/loop/end_content_wrap');

// do_action('tutor_course/loop/before_footer');
// do_action('tutor_course/loop/footer');
// do_action('tutor_course/loop/after_footer');

do_action('tutor_course/loop/after_content');

?>