<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to edali/learnpress/content-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
$course  = LP()->global['course'];
$user = LP_Global::user();

global $edali_opt;
$lessons_title      = !empty($edali_opt['lessons_title']) ? $edali_opt['lessons_title'] : 'lessons';
$students_title     = !empty($edali_opt['students_title']) ? $edali_opt['students_title'] : 'students';
$rating_title       = !empty($edali_opt['rating_title']) ? $edali_opt['rating_title'] : 'rating';
?>
<div class="col-lg-3 col-md-6">
    <div class="single-courses-box mb-30">
        <div class="courses-image">
            <a href="<?php the_permalink(); ?>" class="d-block">
                <?php if( has_post_thumbnail() ): ?>
                    <img src="<?php the_post_thumbnail_url('edali_courses_gallery_thumb'); ?>" alt="<?php the_post_thumbnail_caption(); ?>">
                <?php else: ?>
                    <img src="<?php echo esc_url(get_template_directory_uri() .'/assets/img/no-image.jpg'); ?>" alt="<?php the_post_thumbnail_caption(); ?>">
                <?php endif; ?>
            </a>
            <?php if($course->get_tags() ): ?>
                <div class="courses-tag">
                    <?php 
                    $tags           =   $course->get_tags(); 
                    $remove_text    =   array('Tags:', ',');
                    echo str_replace($remove_text, '', $tags); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="courses-content">
            <div class="course-author d-flex align-items-center">
                <?php learn_press_course_instructor(); ?>
            </div>

            <h3><a href="<?php the_permalink(); ?>" class="d-inline-block"><?php the_title(); ?></a></h3>

            <div class="courses-rating">
                <?php edali_course_ratings(); ?>
                <div class="rating-total">
                    (<?php edali_course_ratings_count(); ?> <?php echo esc_html( $rating_title ); ?>)
                </div>
            </div>
        </div>

        <div class="courses-box-footer">
            <ul>
                <?php $user_count = $course->get_users_enrolled() ? $course->get_users_enrolled() : 0; ?>

                <li class="students-number">
                    <i class="bx bx-user"></i><?php echo esc_html( $user_count ); ?> <?php echo esc_html( $students_title ); ?>
                </li>

                <li class="courses-lesson">
                    <i class="bx bx-book-open"></i> <?php echo wp_kses_post( $course->get_curriculum_items( 'lp_lesson' ) ? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0 ); ?> <?php echo esc_html( $lessons_title ); ?>
                </li>

                <li class="courses-price">
                    <?php learn_press_courses_loop_item_price(); ?>
                </li>
            </ul>
        </div>
    </div>
</div>
