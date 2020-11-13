<?php
/**
 * Template for displaying courses
 *
 * @since v.1.0.0
 *
 * @author EnvyTheme
 * @url https://envytheme.com
 *
 * @package edali/Templates
 * @version 1.5.8
 */

get_header(); 

global $edali_opt;

if( isset( $edali_opt['course_bg_image'] ) ):
    $course_bg          = $edali_opt['course_bg_image']['url'];
    $hide_banner        = $edali_opt['hide_tutor_banner'];
    $hide_breadcrumb    = $edali_opt['hide_tutor_breadcrumb'];
else:	
    $course_bg          = '';
    $hide_banner        = false;
    $hide_breadcrumb    = false;
endif;
?>

<!-- Start Page Title Area -->
<?php
/*
    <?php if( $hide_banner == false ) { ?>
        
        <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}' style="background-image:url(<?php echo esc_url($course_bg); ?>);">
            <div class="container">
                <div class="page-title-content">
                    <?php if( $hide_breadcrumb == false ): ?>
                        <?php
                            if(class_exists( 'bbPress' ) && is_bbpress()) { ?>
                                <div class="bbpress-breadcrumbs"></div>
                                <?php
                            }elseif ( function_exists('yoast_breadcrumb') ) {
                                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                            }else{ ?>
                                <ul>
                                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'edali' ); ?></a></li>
                                    <li><?php esc_html_e( 'Courses', 'edali' ); ?></li>
                                </ul>
                            <?php 
                            }
                        ?>
                    <?php endif; ?>
                    <h2><?php esc_html_e( 'Courses', 'edali' ); ?></h2>
                </div>
            </div>
        </div>
    <?php } ?>
*/
?>
    
    <!-- End Page Title Area -->

    <div class="<?php tutor_container_classes() ?> courses-area page-main-content <?php if( $hide_banner == true ) { ?>pt-200<?php } ?>">
		<?php
		do_action('tutor_course/archive/before_loop');

		if ( have_posts() ) :
			/* Start the Loop */

			tutor_course_loop_start();

			while ( have_posts() ) : the_post();
				/**
				 * @hook tutor_course/archive/before_loop_course
				 * @type action
				 * Usage Idea, you may keep a loop within a wrap, such as bootstrap col
				 */
				do_action('tutor_course/archive/before_loop_course');

				tutor_load_template('loop.course');

				/**
				 * @hook tutor_course/archive/after_loop_course
				 * @type action
				 * Usage Idea, If you start any div before course loop, you can end it here, such as </div>
				 */
				do_action('tutor_course/archive/after_loop_course');
			endwhile;

			tutor_course_loop_end();

		else :

			/**
			 * No course found
			 */
			tutor_load_template('course-none');

		endif;

		tutor_course_archive_pagination();

		do_action('tutor_course/archive/after_loop');
		?>
	</div><!-- .wrap -->

<?php get_footer();
