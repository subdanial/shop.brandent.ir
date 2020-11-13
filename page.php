<?php
/**
 * The template for displaying all pages
 */

get_header();
global $edali_opt;

/**
 * Page Control
 */
if( function_exists('acf_add_options_page') ) {
	$hide_banner 		= get_field( 'enable_page_banner' );
	$hide_breadcrumb 	= get_field( 'hide_breadcrumb' );
	$background_image 	= get_field( 'course_single_background_image' );
}else {
	$hide_banner 		= false;
	$hide_breadcrumb 	= false;
	$background_image 	= '';
}
if( !is_page( 'courses' ) ):
	if( isset( $edali_opt['course_bg_image'] ) ):
		$course_bg = $edali_opt['course_bg_image']['url'];
	else:	
		$course_bg = '';
	endif;
else:
	$course_bg = '';
endif;

?>
	<?php if( $hide_banner == false ) { ?><!-- Start Page Title Area -->
		<?php if( $background_image != '' ): ?>
			<div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}' style="background-image:url(<?php echo esc_url($background_image); ?>);">
		<?php else: ?>
			<?php if( get_the_post_thumbnail_url() != '' ): ?>
				<div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}' style="background-image:url(<?php echo esc_url(get_the_post_thumbnail_url( get_the_ID() )); ?>);">
			<?php else: ?>
				<div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}' style="background-image:url(<?php echo esc_url($course_bg); ?>);">
			<?php endif; ?>
		<?php endif; ?>
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
									<?php if( get_the_title() != '' ): ?>
										<li><?php the_title(); ?></li>
									<?php else: ?>
										<li><?php learn_press_page_title(); ?></li>
									<?php endif; ?>
								</ul>
							<?php 
							}
						?>
					<?php endif; ?>
					<?php if( get_the_title() != '' ): ?>
						<h2><?php the_title(); ?></h2>
					<?php else: ?>
						<h2><?php learn_press_page_title(); ?></h2>
					<?php endif; ?>
                </div>
            </div>
        </div>
	<?php } ?><!-- End Page Title Area -->

	<?php if( !edali_is_elementor() ): ?><div class="page-main-content"><?php endif; ?>
		<div class="page-area">
			<?php if( !edali_is_elementor()): ?><div class="container_fluid brandent_course_container"><?php endif; ?>
				<?php if ( is_active_sidebar( 'bbpress-sidebar' ) && class_exists( 'bbPress' ) && is_bbpress() ) : ?>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<?php endif; ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php $thecontent = get_the_content(); // If no content ?>
						<?php if(empty($thecontent)){ ?> <div class="edali-single-blank-page"></div><?php } ?>
						<?php get_template_part( 'template-parts/content', 'page' ); ?>
						<?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>
					<?php endwhile; // End of the loop. ?>
				<?php if ( is_active_sidebar( 'bbpress-sidebar' ) && class_exists( 'bbPress' ) && is_bbpress() ) : ?>
						</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="right-sidebar">
							<?php dynamic_sidebar( 'bbpress-sidebar' ); ?>
						</div>
					</div>
				</div>
			  <?php endif; ?>	
		<?php if( !edali_is_elementor()): ?></div><?php endif; ?>
		</div>
	<?php if( !edali_is_elementor()): ?></div><?php endif; ?>

<?php get_footer();