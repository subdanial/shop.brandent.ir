<?php
/**
 * Template for displaying student Public Profile
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

get_header();

$user_name = sanitize_text_field(get_query_var('tutor_student_username'));
$sub_page = sanitize_text_field(get_query_var('profile_sub_page'));
$get_user = tutor_utils()->get_user_by_login($user_name);
$user_id = $get_user->ID;

global $edali_opt;
if( isset( $edali_opt['course_bg_image'] ) ):
    if( get_field('tutor_background_image') != '' ):
        $course_bg   = get_field('tutor_background_image');
    else:
        $course_bg   = $edali_opt['course_bg_image']['url'];
    endif;
    $hide_banner        = $edali_opt['hide_tutor_banner'];
    $hide_breadcrumb    = $edali_opt['hide_tutor_breadcrumb'];
else:	
    $course_bg          = '';
    $hide_banner        = false;
    $hide_breadcrumb    = false;
endif;
?>

<?php if( $hide_banner == false ) { ?><!-- Start Page Title Area -->
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
                                <li><?php echo $get_user->display_name; ?></li>
                            </ul>
                        <?php 
                        }
                    ?>
                <?php endif; ?>
                <h2><?php echo $get_user->display_name; ?></h2>
            </div>
        </div>
    </div>
<?php }

global $wp_query;

$profile_sub_page = '';
if (isset($wp_query->query_vars['profile_sub_page']) && $wp_query->query_vars['profile_sub_page']) {
    $profile_sub_page = $wp_query->query_vars['profile_sub_page'];
}


?>

<?php do_action('tutor_student/before/wrap'); ?>

    <div <?php tutor_post_class('tutor-full-width-student-profile tutor-page-wrap'); ?>>
        <div class="tutor-container">
            <div class="tutor-row">
                <div class="tutor-col-12">
                    <div class="tutor-dashboard-header">
                        <div class="tutor-dashboard-header-avatar">
                            <img src="<?php echo get_avatar_url($user_id, array('size' => 150)); ?>" />
                        </div>
                        <div class="tutor-dashboard-header-info">
                            <div class="tutor-dashboard-header-display-name">
                                <h4><?php _e('Howdy,', 'tutor'); ?> <strong><?php echo $get_user->display_name; ?></strong> </h4>
                            </div>
                            <?php
                            if (user_can($user_id, tutor()->instructor_role)){
                                $instructor_rating = tutor_utils()->get_instructor_ratings($get_user->ID);
                                ?>
                                <div class="tutor-dashboard-header-stats">
                                    <div class="tutor-dashboard-header-ratings">
                                        <?php tutor_utils()->star_rating_generator($instructor_rating->rating_avg); ?>
                                        <span><?php echo esc_html($instructor_rating->rating_avg);  ?></span>
                                        <span> (<?php echo sprintf(__('%d Ratings', 'tutor'), $instructor_rating->rating_count); ?>) </span>
                                    </div>
                                    <!--<div class="tutor-dashboard-header-notifications">
                                        <?php /*_e('Notification'); */?> <span>9</span>
                                    </div>-->
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                            $tutor_user_social_icons = tutor_utils()->tutor_user_social_icons();
                            if(count($tutor_user_social_icons)){
                                ?>
                                    <div class="tutor-dashboard-social-icons">
                                        <?php
                                            $i=0;
                                            foreach ($tutor_user_social_icons as $key => $social_icon){
                                                $icon_url = get_user_meta($user_id,$key,true);
                                                if($icon_url){
                                                    if($i==0){
                                                        ?>
                                                            <h4><?php esc_html_e("Follow me", "edali"); ?></h4>
                                                        <?php
                                                    }
                                                    echo "<a href='".esc_url($icon_url)."' target='_blank' class='".$social_icon['icon_classes']."'></a>";
                                                }
                                                $i++;
                                            }
                                        ?>
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div <?php tutor_post_class('tutor-dashboard-student'); ?>>

            <div class="tutor-container">
                <div class="tutor-row">
                    <div class="tutor-col-3">
                        <?php
                        $permalinks = tutor_utils()->user_profile_permalinks();
                        $student_profile_url = tutor_utils()->profile_url($user_id);
                        ?>
                        <ul class="tutor-dashboard-permalinks">
                            <li class="tutor-dashboard-menu-bio <?php echo $profile_sub_page == '' ? 'active' : ''; ?>"><a href="<?php echo tutor_utils()->profile_url($user_id); ?>"><?php _e('Bio', 'tutor'); ?></a></li>
                            <?php
                            if (is_array($permalinks) && count($permalinks)){
                                foreach ($permalinks as $permalink_key => $permalink){
                                    $li_class = "tutor-dashboard-menu-{$permalink_key}";
                                    $active_class = $profile_sub_page == $permalink_key ? "active" : "";
                                    echo '<li class="'. $active_class . ' ' . $li_class .'"><a href="'.trailingslashit($student_profile_url).$permalink_key.'"> '.$permalink.' </a> </li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="tutor-col-9">
                        <div class="tutor-dashboard-content">
                            <?php
                                if ($sub_page){
                                    tutor_load_template('profile.'.$sub_page);
                                }else{
                                    tutor_load_template('profile.bio');
                                }
                            ?>
                        </div>
                    </div> <!-- .tutor-col-8 -->
                </div>

            </div> <!-- .tutor-row -->
        </div> <!-- .tutor-container -->
    </div>

<?php do_action('tutor_student/after/wrap'); ?>

<?php
get_footer();
