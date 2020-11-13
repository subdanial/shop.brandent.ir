<?php 
/**
 * Edali post content
 */

global $edali_opt;

// Post thumb size
if(isset($edali_opt['edali_blog_sidebar'])) {
   if( $edali_opt['edali_blog_sidebar'] == 'edali_without_sidebar' ):
        $thumb_size = 'full';
   else:
        $thumb_size = 'edali_post_thumb';
   endif;
}else {
    $thumb_size = 'edali_post_thumb';
}

if( isset( $edali_opt['read_more'] ) ):
    $read_more  = $edali_opt['read_more'];
    $by_text    = $edali_opt['by_text'];
else:
    $read_more  = esc_html__('Read More', 'edali');
    $by_text    = esc_html__('By:', 'edali');
endif;

// Author info
$get_author_id = get_the_author_meta('ID');

?>

<div <?php post_class(); ?>>
    <div class="single-blog-post">
        <?php if(has_post_thumbnail()) { ?>
            <div class="post-image">
                <a href="<?php the_permalink() ?>"><img src="<?php the_post_thumbnail_url($thumb_size) ?>" alt="<?php the_post_thumbnail_caption(); ?>"></a>
            </div>
        <?php } ?>

        <div class="post-content">
            <ul class="post-meta">
                <li class="post-author">
                    <?php 
                        $user = wp_get_current_user();
                        $user_image = get_avatar_url($user->ID, ['size' => '51']); 
                    ?>
                    <img src="<?php echo esc_url( $user_image ); ?>" class="d-inline-block rounded-circle mr-2" alt="<?php echo esc_attr(get_the_author()); ?>">
                    <?php echo esc_html( $by_text ); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>" class="d-inline-block"><?php echo esc_html(get_the_author()); ?></a>
                </li>
                <li><?php echo esc_html(get_the_date()); ?></li>
            </ul>
            
            <?php if( get_the_title() != '' ): ?>
                <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
            <?php endif; ?>
            <?php the_excerpt(); ?>

            <?php if( $read_more != '' ): ?>
                <a href="<?php the_permalink() ?>" class="read-more-btn"><?php echo esc_html( $read_more ); ?> <i class="bx bx-right-arrow-alt"></i></a>
            <?php endif; ?>
        </div>
    </div>
</div>