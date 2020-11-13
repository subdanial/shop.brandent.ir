<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to edali/learnpress/content-single-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}

$course  = LP()->global['course'];
$course_id = get_the_ID();
$user_id     = get_current_user_id();
$duration = get_field( 'course_duration' );

global $edali_opt;
if( isset( $edali_opt['course_instructor_title'] ) ):
    $instructor_title           = $edali_opt['course_instructor_title'];
    $view_profile               = $edali_opt['course_instructor_view_profile'];
    $enable_instructor_info     = $edali_opt['enable_instructor_info'];
    $enable_meta_info           = $edali_opt['enable_course_meta_info'];
    $duration_text              = $edali_opt['course_meta_duration_text'];
    $students_enrolled_text     = $edali_opt['course_meta_students_enrolled_text'];
    $last_updated_text          = $edali_opt['course_last_updated_text'];
    $enable_rating_info         = $edali_opt['enable_rating_info'];
    $rating_title               = $edali_opt['rating_title'];
    $buy_course_title           = $edali_opt['buy_course_title'];

    $enable_course_sidebar      = $edali_opt['enable_course_sidebar_info'];
    $student_label              = $edali_opt['student_label'];
    $duration_label             = $edali_opt['duration_label'];
    $effort_label               = $edali_opt['effort_label'];
    $institution_label          = $edali_opt['institution_label'];
    $subject_label              = $edali_opt['subject_label'];
    $quizzes_label              = $edali_opt['quizzes_label'];
    $language_label             = $edali_opt['language_label'];
    $video_subtitle_label       = $edali_opt['video_subtitle_label'];
    $certificate_label          = $edali_opt['certificate_label'];
else:
    $enable_instructor_info     = true;
    $instructor_title           = esc_html__('Meet your instructors', 'edali');
    $view_profile               = esc_html__('View Profile', 'edali');
    $enable_meta_info           = true;
    $duration_text              = esc_html__('Duration', 'edali');
    $students_enrolled_text     = esc_html__('Students Enrolled', 'edali');
    $last_updated_text          = esc_html__('Last Updated', 'edali');
    $enable_rating_info         = true;
    $rating_title               = esc_html__('rating', 'edali');
    $buy_course_title           = esc_html__('Buy Course', 'edali');

    $enable_course_sidebar      = true;
    $student_label              = esc_html__('Students:', 'edali');
    $duration_label             = esc_html__('Duration:', 'edali');
    $effort_label               = esc_html__('Effort:', 'edali');
    $institution_label          = esc_html__('Institution:', 'edali');
    $subject_label              = esc_html__('Subject:', 'edali');
    $quizzes_label              = esc_html__('Quizzes:', 'edali');
    $language_label             = esc_html__('Language:', 'edali');
    $video_subtitle_label       = esc_html__('Video Subtitle:', 'edali');
    $certificate_label          = esc_html__('Certificate:', 'edali');
endif;

if( get_field( 'course_buy_now_title' ) != '' ):
    $buy_course_title           = get_field( 'course_buy_now_title' );
endif;

$title = get_the_title();

/**
 * @deprecated
 */
do_action( 'learn_press_before_main_content' );
do_action( 'learn_press_before_single_course' );
do_action( 'learn_press_before_single_course_summary' );

/**
 * @since 3.0.0
 */
do_action( 'learn-press/before-main-content' );

do_action( 'learn-press/before-single-course' );

?>
<div class="courses-details-area">
    <div id="learn-press-course" class="course-summary">
        <div class="courses-details-header">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <?php learn_press_course_progress(); ?>
                </div>
                <div class="col-lg-8">
                    <div class="courses-title">
                        <p><?php the_excerpt(); ?></p>
                    </div>

                    <?php if( $enable_meta_info == true ): ?>
                        <div class="courses-meta">
                            <ul>
                                <?php if( $duration_text != '' ): ?>
                                    <li>
                                        <i class="bx bx-folder-open"></i>
                                        <span><?php echo esc_html( $duration_text ); ?></span>
                                        <?php echo esc_html( $duration ); ?>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if( $students_enrolled_text != '' ): ?>
                                    <!-- <li>
                                        <i class="bx bx-group"></i>
                                        <span><?php echo esc_html( $students_enrolled_text ); ?></span>
                                        <?php $user_count = $course->get_users_enrolled() ? $course->get_users_enrolled() : 0; ?>
                                        <?php echo esc_html( $user_count ); ?>
                                    </li> -->
                                <?php endif; ?>
                                
                                <?php if( $last_updated_text != '' ): ?>
                                    <li>
                                        <i class="bx bx-calendar"></i>
                                        <span><?php echo esc_html( $last_updated_text ); ?></span>
                                        <?php $updated_date = get_the_modified_time('F jS, Y'); ?>
                                        <?php echo esc_html( $updated_date ); ?>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-4">
                    <div class="courses-price">

                        <?php if( $enable_rating_info == __return_true() ): ?>
                            <div class="courses-rating">
                                <?php edali_course_ratings(); ?>
                                <div class="reviews-total d-inline-block">
                                    (<?php edali_course_ratings_count(); ?> <?php echo esc_html( $rating_title ); ?>)
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php learn_press_course_price(); ?>
                        <?php
                        if ( ! isset( $courses ) ) {
                            $courses = learn_press_get_course();
                        } ?>

                        <?php if( $course->get_external_link() == '' ): ?>
                            <?php if( learn_press_is_enrolled_course( $course_id, $user_id ) == false ): ?>
                                <?php do_action( 'learn-press/before-enroll-form' ); ?>

                                    <form name="enroll-course" class="enroll-course" method="post" enctype="multipart/form-data">

                                        <?php do_action( 'learn-press/before-enroll-button' ); ?>

                                        <input type="hidden" name="enroll-course" value="<?php echo esc_attr( $course->get_id() ); ?>"/>
                                        <input type="hidden" name="enroll-course-nonce"
                                            value="<?php echo esc_attr( LP_Nonce_Helper::create_course( 'enroll' ) ); ?>"/>

                                        <?php if(  $buy_course_title  != '' ): ?>
                                            <button class="default-btn">
                                                <i class="bx bx-paper-plane icon-arrow before"></i>
                                                <span class="label"><?php echo esc_html(  $buy_course_title ); ?></span>
                                                <i class="bx bx-paper-plane icon-arrow after"></i>
                                            </button>
                                        <?php endif; ?>

                                        <?php do_action( 'learn-press/after-enroll-button' ); ?>

                                    </form>

                                <?php do_action( 'learn-press/after-enroll-form' ); ?>
                            <?php endif; ?>
                        <?php else: ?>
                                <form name="course-external-link" class="course-external-link form-button lp-form" method="post">
                                    <input type="hidden" name="lp-ajax" value="external-link">
                                    <input type="hidden" name="id" value="<?php echo $course->get_id(); ?>">
                                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'external-link-' . $course->get_external_link() ); ?>">
                                    <?php if(  $buy_course_title  != '' ): ?>
                                        <button class="default-btn">
                                            <i class="bx bx-paper-plane icon-arrow before"></i>
                                            <span class="label"><?php echo esc_html(  $buy_course_title ); ?></span>
                                            <i class="bx bx-paper-plane icon-arrow after"></i>
                                        </button>
                                    <?php endif; ?>
                                </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <?php if( has_post_thumbnail() ): ?>
                    <div class="courses-details-image text-center">
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                    </div>
                <?php endif; ?>

                <div class="courses-details-desc">
                    <?php the_content(); ?>

                    <?php if( $enable_instructor_info == true ): ?>
                        <h3><?php echo esc_html( $instructor_title ); ?></h3>

                        <div class="courses-author">
                            <div class="author-profile-header"></div>
                            <div class="author-profile">
                                <div class="author-profile-title">
                                    <?php 
                                    $user = get_the_author_meta('ID');
                                    $user_image = get_avatar_url($user, ['size' => '100']); 
                                    ?>
                                    <img src="<?php echo esc_url( $user_image ); ?>" class="shadow-sm rounded-circle" alt="<?php echo esc_attr(get_the_author()); ?>">

                                    <div class="author-profile-title-details d-flex justify-content-between">
                                        <div class="author-profile-details">
                                            <h4><?php echo esc_html(get_the_author()); ?></h4>
                                            <span class="d-block"></span>
                                        </div>

                                        <?php if( $view_profile != '' ): ?>
                                            <div class="author-profile-edali-profile">
                                                <a href="<?php echo esc_url( home_url('/profile') ); ?>/<?php echo get_the_author_meta( 'user_nicename' ); ?>" class="d-inline-block"><?php echo esc_html( $view_profile ); ?></a>
                                            </div>                                            
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <p><?php echo esc_html(get_the_author_meta( 'description' )); ?></p>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php edali_course_review(); ?>

                    <!-- Start Related Area -->
                    <?php
                    $related_courses_title = !empty($edali_opt['related_courses_title']) ? $edali_opt['related_courses_title'] : 'More Courses You Might Like';
                    $lessons_title      = !empty($edali_opt['lessons_title']) ? $edali_opt['lessons_title'] : 'lessons';
                    $students_title     = !empty($edali_opt['students_title']) ? $edali_opt['students_title'] : 'students';
                    $rating_title       = !empty($edali_opt['rating_title']) ? $edali_opt['rating_title'] : 'rating';
                    $related_post_count = !empty($edali_opt['related_post_count']) ? $edali_opt['related_post_count'] : '3';
                    $is_related_courses = !empty($edali_opt['is_related_courses']) ? $edali_opt['is_related_courses'] : '';

                    $course_terms = get_the_terms( get_the_ID(), 'course_category'  );
                    if( $is_related_courses == '1' ){
                        if( $course_terms ) {
                            $course_term_names[] = 0;
                            foreach( $course_terms as $course_term ) {  
                                $course_term_names[] = $course_term->name;                            
                            }                           
                                        
                            // set up the query arguments
                            $args = array (
                                'post_type' => 'lp_course',
                                'posts_per_page' => $related_post_count,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'course_category',
                                        'field'    => 'slug',
                                        'terms'    => $course_term_names,
                                    ),
                                ),
                            );

                            $query = new WP_Query( $args ); 

                            if( $query->have_posts() ) { ?>
                                <div class="related-courses">
                                    <div class="container">
                                        <?php if( $related_courses_title != '' ): ?>
                                            <h3><?php echo esc_html($related_courses_title); ?></h3>
                                        <?php endif; ?>

                                        <div class="row">
                                            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                                                <?php if( $title != get_the_title() ): ?>
                                                    <div class="col-lg-6 col-md-6">
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
                                                <?php endif; ?>  
                                            <?php endwhile; ?>  
                                            <?php wp_reset_postdata(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    } ?>
                    <!-- End Related Courses Area -->
                </div>
            </div>

            <div class="col-lg-4">
                <?php if( $enable_course_sidebar == true ): ?>
                    <div class="courses-sidebar-information">
                        <ul>
                            <li>
                                <span><i class="bx bx-group"></i> <?php echo esc_html( $student_label ); ?></span>
                                <?php $user_count = $course->get_users_enrolled() ? $course->get_users_enrolled() : 0; ?>
                                <?php echo esc_html( $user_count ); ?>
                            </li>
                            <?php if( $duration != '' ): ?>
                                <li>
                                    <span><i class="bx bx-time"></i> <?php echo esc_html( $duration_label ); ?></span>
                                    <?php echo esc_html( $duration ); ?>
                                </li>
                            <?php endif; ?>
                            
                            <?php if( get_field('course_effort') != '' ): ?>
                                <li>
                                    <span><i class="bx bx-tachometer"></i> <?php echo esc_html( $effort_label ); ?></span>
                                    <?php echo esc_html(get_field('course_effort')); ?>
                                </li>
                            <?php endif; ?>

                            <?php if( get_field('course_institution') != '' ): ?>
                                <li>
                                    <span><i class="bx bxs-institution"></i> <?php echo esc_html( $institution_label ); ?></span>
                                    <?php echo esc_html(get_field('course_institution')); ?>
                                </li>
                            <?php endif; ?>

                            <?php if( get_field('course_subject') != '' ): ?>
                                <li>
                                    <span><i class="bx bxs-graduation"></i> <?php echo esc_html( $subject_label ); ?></span>
                                    <?php echo esc_html(get_field('course_subject')); ?>
                                </li>
                            <?php endif; ?>

                            <?php /* if( get_field('course_quizzes') != '' ): ?>
                                <li>
                                    <span><i class="bx bx-atom"></i> <?php echo esc_html( $quizzes_label ); ?></span>
                                    <?php echo esc_html(get_field('course_quizzes')); ?>
                                </li>
                            <?php endif; */ ?>
                            <?php if( get_field('course_language') != '' ): ?>
                                <li>
                                    <span><i class="bx bx-support"></i> <?php echo esc_html( $language_label ); ?></span>
                                    <?php echo esc_html(get_field('course_language')); ?>
                                </li>
                            <?php endif; ?>
                            <?php if( get_field('video_subtitle') != '' ): ?>
                                <li>
                                    <span><i class="bx bx-text"></i> <?php echo esc_html( $video_subtitle_label ); ?></span>
                                    <?php echo esc_html(get_field('video_subtitle')); ?>
                                </li>
                            <?php endif; ?>
                            <?php if ( get_field('course_certificate') != '' ): ?>
                            <li>
                                <span><i class="bx bx-certification"></i> <?php echo esc_html( $certificate_label ); ?></span>
                                <?php echo esc_html(get_field('course_certificate')); ?>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="courses-sidebar-syllabus">
                    <div class="course-curriculum" id="learn-press-course-curriculum">

                        <div class="curriculum-scrollable">

                            <?php
                            /**
                             * @deprecated
                             */
                            do_action( 'learn_press_before_single_course_curriculum' );

                            /**
                             * @since 3.0.0
                             */
                            do_action( 'learn-press/before-single-course-curriculum' );
                            ?>

                            <?php if ( $curriculum = $course->get_curriculum() ) { ?>

                                <ul class="curriculum-sections">
                                    <?php foreach ( $curriculum as $section ) {
                                        learn_press_get_template( 'single-course/loop-section.php', array( 'section' => $section ) );
                                    } ?>
                                </ul>

                            <?php } else { ?>

                                <?php echo apply_filters( 'learn_press_course_curriculum_empty', __( 'Curriculum is empty', 'edali' ) ); ?>

                            <?php } ?>

                            <?php
                            /**
                             * @since 3.0.0
                             */
                            do_action( 'learn-press/after-single-course-curriculum' );

                            /**
                             * @deprecated
                             */
                            do_action( 'learn_press_after_single_course_curriculum' );
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

/**
 * @since 3.0.0
 */
do_action( 'learn-press/after-main-content' );

do_action( 'learn-press/after-single-course' );

/**
 * @deprecated
 */
do_action( 'learn_press_after_single_course_summary' );
do_action( 'learn_press_after_single_course' );
do_action( 'learn_press_after_main_content' );