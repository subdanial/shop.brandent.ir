<?php
/**
 * Template for displaying user profile cover image.
 *
 * This template can be overridden by copying it to edali/learnpress/profile/profile-cover.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile = LP_Profile::instance();

$user = $profile->get_user();
$user_id = $user->get_id();
?>
<div class="profile-box">
    <div class="row align-items-center">
        <div class="col-lg-4 col-md-4">
            <div class="image">
			<?php echo $user->get_profile_picture( null, '500'); ?>
            </div>
        </div>

        <div class="col-lg-8 col-md-8">
            <div class="content">
                <h3 class="profile-name"><?php echo $user->get_display_name(); ?></h3>
                <?php the_field('user_description', 'user_'. $user_id ); ?>

                <ul class="social-link">
                    <?php
                    if( have_rows('user_social_links', 'user_'. $user_id ) ):
                        while ( have_rows('user_social_links', 'user_'. $user_id ) ) : the_row();
                        ?>
                            <li><a href="<?php echo esc_url( the_sub_field('user_social_link')); ?>" class="d-block" target="_blank"><i class="<?php echo esc_attr( the_sub_field('user_select_social_icon') ); ?>"></i></a></li>
                        <?php
                        endwhile;                                    
                    endif;
                    ?>
                </ul>                
            </div>
        </div>
    </div>
</div>