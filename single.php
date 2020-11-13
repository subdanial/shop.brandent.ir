<?php
/**
 * The single template file
 * @package Edali
 */
get_header();

$title = get_the_title();

// Blog sidebar
if(isset($edali_opt['edali_blog_sidebar'])) {
    if( $edali_opt['edali_blog_sidebar'] == 'edali_without_sidebar_center' ):
        $sidebar = 'col-lg-8 col-md-12 offset-lg-2';
    elseif( $edali_opt['edali_blog_sidebar'] == 'edali_without_sidebar' ):
        $sidebar = 'col-lg-12 col-md-12';
    else:
        if( is_active_sidebar( 'sidebar-1' ) ):
            $sidebar = 'col-lg-8 col-md-12';
        else:
            $sidebar = 'col-lg-8 col-md-12 offset-lg-2';
        endif;
    endif;
	$edali_sidebar_hide = $edali_opt['edali_blog_sidebar'];
	
} else {
    if( is_active_sidebar( 'sidebar-1' ) ):
        $sidebar = 'col-lg-8 col-md-12';
        $edali_sidebar_hide = 'edali_with_sidebar';
    else:
        $sidebar = 'col-lg-8 col-md-12 offset-lg-2';
        $edali_sidebar_hide = 'edali_without_sidebar';
	endif;
} 

// Blog breadcrumb
if( isset($edali_opt['hide_breadcrumb']) ) {
    $hide_breadcrumb    	= $edali_opt['hide_breadcrumb'];
    $blog_title             = $edali_opt['blog_title'];
    $hide_blog_banner       = $edali_opt['hide_blog_banner'];
    $hide_author_info       = $edali_opt['hide_author_info'];
} else {
    $hide_breadcrumb    	= 	false;
    $blog_title             = esc_html__('Blog', 'edali');
    $hide_blog_banner       = false;
    $hide_author_info       = true;
}

if( function_exists('acf_add_options_page') ) {
	$bg_image = get_field( 'blog_background_image' );
}else {
	$bg_image = '';
}

// Blog page link
if ( get_option( 'page_for_posts' ) ) {
	$blog_link = get_permalink( get_option( 'page_for_posts' ));
}else{
	$blog_link = home_url( '/' );
}
?>
	<?php if( $hide_blog_banner == false ): ?>
	<div class="page-title-area item-bg2 jarallax" data-jarallax='{"speed": 0.3}' <?php if( $bg_image != ''): ?>style="background-image:url(<?php echo esc_url($bg_image); ?>);" <?php endif; ?>>
            <div class="container">
                <div class="page-title-content">
					<?php if( $hide_breadcrumb == false ): ?>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'edali' ); ?></a></li>
							<?php if($title != ''): ?>
								<li><?php the_title(); ?></li>
							<?php else: ?>
								<li><?php echo esc_html__('No Title', 'edali'); ?></li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>
                    <?php if($title != ''): ?>
						<h2><?php the_title(); ?></h2>
					<?php else: ?>
						<h2><?php echo esc_html__('No Title', 'edali'); ?></h2>
					<?php endif; ?>
                </div>
            </div>
		</div>
    <?php endif; ?>

	<!-- Start Blog Area -->
	<div class="blog-details-area ptb-100">
		<div class="container">
			<div class="row">
				<?php
				while ( have_posts() ) : 
				the_post(); ?>
					<div class="<?php echo esc_attr( $sidebar ); ?>">
						<div class="blog-details">
						
							<?php if(has_post_thumbnail()) { ?>
								<div class="article-image">
									<img src="<?php the_post_thumbnail_url('full') ?>" alt="<?php the_title_attribute(); ?>">
								</div>
							<?php } ?> 

							<div class="blog-details-content">
								<div class="entry-meta">
									<ul>
										<li>
											<i class="bx bx-comment"></i>
											<?php comments_number(); ?>

										</li>
										<li>
											<i class="bx bx-group"></i>
											<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ) ?>"> <?php the_author() ?></a>
										</li>
										<li>
											<i class="bx bx-calendar"></i>
											<?php the_date(); ?>
										</li>
									</ul>
								</div>

								<?php the_content(); 
								
								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'edali' ),
									'after'  => '</div>',
								) );
								?>
								
								<?php if( $hide_author_info != true ): ?>
									<div class="article-author">
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

													<div class="author-profile-edali-profile">
														<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>" class="d-inline-block"><?php esc_html_e( 'View Profile', 'edali' ); ?></a>
													</div>
												</div>
											</div>
											<p><?php echo esc_html(get_the_author_meta( 'description' )); ?></p>
										</div>
									</div>
								<?php endif; ?>
							</div>							
						</div>
					
						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>
					</div>
				<?php endwhile; // End of the loop. ?>
				
				<?php if( $edali_sidebar_hide == 'edali_with_sidebar' ): ?>
					<?php get_sidebar(); ?>
				<?php endif; ?>

			</div>
		</div>
	</div>
	<!-- End Blog Area -->

<?php
get_footer();
