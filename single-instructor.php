<?php
/**
 * Single Instructor
 */

get_header();
?>

    <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}' style="background-image:url(<?php echo esc_url(get_field('single_page_banner_background_image')); ?>);">
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'edali' ); ?></a></li>
                    <li><?php echo esc_html( get_field('instructor_banner_title') ); ?></li>
                </ul>
            <h2><?php echo esc_html( get_field('instructor_banner_title') ); ?></h2>
            </div>
        </div>
    </div>

    <div class="instructor-details-area pt-100 pb-70">
        <div class="container">
            <div class="instructor-details-desc">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="instructor-details-sidebar">
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">

                                <ul class="social-link">
                                    <?php
                                    if( have_rows('instructor_social_links') ):
                                        while ( have_rows('instructor_social_links') ) : the_row();
                                        ?>
                                            <li><a href="<?php echo esc_url( the_sub_field('instructor_social_link')); ?>" class="d-block" target="_blank"><i class="<?php echo esc_attr( the_sub_field('instructor_select_social_icon') ); ?>"></i></a></li>
                                        <?php
                                        endwhile;                                    
                                    endif;
                                    ?>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-8">
                            <div class="instructor-details">
                                <h3><?php the_title(); ?></h3>
                                <span class="sub-title"><?php echo esc_html( get_field('instructor_designation') ); ?></span>

                                <?php the_content(); ?>
                                
                                <div class="instructor-details-info">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <h3><?php echo esc_html( get_field('education_list_title') ); ?></h3>
                                            <ul>
                                            <?php
                                            if( have_rows('education_list') ):
                                                while ( have_rows('education_list') ) : the_row();
                                                ?>
                                                        <li>
                                                        <i class="bx bxs-graduation"></i>
                                                        <span><?php echo esc_html( the_sub_field('institute_name') ); ?></span>
                                                        <?php echo esc_html( the_sub_field('degree_name') ); ?>
                                                    </li>
                                                <?php
                                                endwhile;                                    
                                            endif;
                                            ?>
                                            </ul>
                                        </div>

                                        <div class="col-lg-6 col-md-12">
                                            <h3><?php echo esc_html( get_field('experience_list_title') ); ?></h3>
                                            <ul>
                                                <?php
                                                if( have_rows('experience_list') ):
                                                    while ( have_rows('experience_list') ) : the_row();
                                                    ?>
                                                        <li>
                                                            <i class="bx bx-briefcase"></i>
                                                            <span><?php echo esc_html( the_sub_field('experience_label') ); ?></span>
                                                            <?php echo esc_html( the_sub_field('experience_name') ); ?>
                                                        </li>
                                                    <?php
                                                    endwhile;                                    
                                                endif;
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; // End of the loop. ?>
            </div>
        </div>
    </div>
<?php get_footer();