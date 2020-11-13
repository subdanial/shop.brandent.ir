<?php
/**
 * The archive file
 * @package Edali
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
    $edali_sidebar_hide           = $edali_opt['edali_blog_sidebar'];
    $hide_blog_banner       = $edali_opt['hide_blog_banner'];
    $blog_title             = $edali_opt['blog_title'];
    $hide_breadcrumb        = $edali_opt['hide_breadcrumb'];
} else {
    if( is_active_sidebar( 'sidebar-1' ) ):
        $sidebar        = 'col-lg-8 col-md-12';
        $edali_sidebar_hide   = 'edali_with_sidebar';
    else:
        $sidebar            = 'col-lg-8 col-md-12 offset-lg-2';
        $edali_sidebar_hide       = 'edali_without_sidebar';
    endif;
    $hide_blog_banner = false;
    $blog_title       = esc_html__('Blog', 'edali');
    $hide_breadcrumb  = false;
} 
$blog_link = get_permalink( get_option( 'page_for_posts' ));
?>

    <!-- Start Page Title Area -->
    <?php if( $hide_blog_banner == false ): ?>
        <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}'>
            <div class="container">
                <div class="page-title-content">
					<?php if( $hide_breadcrumb == false ): ?>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'edali' ); ?></a></li>
							<li><?php the_archive_title(); ?></li>
                            <?php if( get_the_archive_description() != '' ): ?>
                                <li><?php the_archive_description(); ?></li>
                            <?php endif; ?>
						</ul>
					<?php endif; ?>
                        <h2><?php the_archive_title(); ?></h2>
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
                            'prev_text' => '<i class="bx bx-chevrons-left"></i>',
                            'next_text' => '<i class="bx bx-chevrons-right"></i>',
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