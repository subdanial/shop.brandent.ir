<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Edali
 */

global $edali_opt;

get_header();

if ( isset( $edali_opt['banner_title_404'] ) ):
	$banner_title 		= $edali_opt['banner_title_404'];
	$banner_bg 			= $edali_opt['not_found_bg_image']['url'];
	$title 				= $edali_opt['title_not_found'];
	$sub_title			= $edali_opt['sub_title_404'];
	$content 			= $edali_opt['content_not_found'];
	$button_text 		= $edali_opt['button_not_found'];
else:
	$banner_title 		= esc_html__('Error 404', 'edali');
	$banner_bg 			= '';
	$title 				= esc_html__('oops!', 'edali');
	$sub_title			= esc_html__('Error 404 : Page Not Found', 'edali');
	$content 			= esc_html__('The page you are looking for might have been removed had its name changed or is temporarily unavailable.', 'edali');
	$button_text 		= esc_html__('Back Home', 'edali');
endif;
?>
	<!-- Start Page Title Area -->
	<?php if( $banner_bg != '' ): ?>
		<div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}' style="background-image:url(<?php echo esc_url($banner_bg); ?>);">
	<?php else: ?>
		<div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
	<?php endif; ?>
		<div class="container">
			<div class="page-title-content">
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'edali' ); ?></a></li>
					<li><?php echo esc_html( $banner_title ); ?></li>
				</ul>
				<h2><?php echo esc_html( $banner_title ); ?></h2>
			</div>
		</div>
	</div>
	<!-- End Page Title Area -->

	<!-- Start Error 404 Area -->
	<div class="error-404-area">
		<div class="container">
			<div class="notfound">
				<div class="notfound-bg">
					<div></div>
					<div></div>
					<div></div>
				</div>
				
				<h1><?php echo esc_html( $title ); ?></h1>
				<h3><?php echo esc_html( $sub_title ); ?></h3>
				<p><?php echo esc_html( $content ); ?></p>
				
				<?php if( $button_text != '' ): ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="default-btn"><i class='bx bx-home-circle icon-arrow before'></i><span class="label"><?php echo esc_html( $button_text ); ?></span><i class="bx bx-home-circle icon-arrow after"></i></a>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php get_footer();