<?php
/**
 * The main template file
 * @package edali
 */
get_header();

// Blog Sidebar
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

// Blog title and breadcrumb
if( isset($edali_opt['blog_title']) ) {
    $title                  = $edali_opt['blog_title'];
    $hide_breadcrumb        = $edali_opt['hide_breadcrumb'];
    $hide_blog_banner       = $edali_opt['hide_blog_banner'];
} else {
    $title                  = esc_html__('Blog', 'edali');
    $hide_breadcrumb        = false;
    $hide_blog_banner       = false;
}
?>

    <!-- Start Page Title Area -->
    <?php if( $hide_blog_banner == false ): ?>
        <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
            <div class="container">
                <div class="page-title-content">
					<?php if( $hide_breadcrumb == false ): ?>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'edali' ); ?></a></li>
							<li><?php echo esc_html( $title ); ?></li>
						</ul>
					<?php endif; ?>
                    <h2><?php echo esc_html( $title ); ?></h2>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- End Page Title Area -->

    <!-- Start Blog Area -->
    <div class="blog-area ptb-100">
        <div class="container">
            <div class="row">
                <!-- Start Blog Content -->
                <div class="<?php echo esc_attr( $sidebar ); ?>">
                    <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'template-parts/content', get_post_format());
                        endwhile;
                    else :
                        get_template_part( 'template-parts/content', 'none' );
                    endif;
                    ?>
            
                    <!-- Stat Pagination -->
                    <div class="pagination-area">
                        <nav aria-label="navigation">
                        <?php echo paginate_links( array(
                            'format' => '?paged=%#%',
                            'prev_text' => '<i class="fa fa-angle-double-left"></i>',
                            'next_text' => '<i class="fa fa-angle-double-right"></i>',
                                )
                            ) ?>
                        </nav>
                    </div>
                    <!-- End Pagination -->
                </div>
                <!-- End Blog Content -->
                
                <?php if( $edali_sidebar_hide == 'edali_with_sidebar' ): ?>
                    <?php get_sidebar(); ?>
                <?php endif; ?>
            </div>   
        </div>
    </div>
    <!-- End Blog Area -->
    
<?php get_footer();