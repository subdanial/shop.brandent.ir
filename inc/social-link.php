<?php 
/**
 * Social Link
 * @package WordPress
 * @subpackage Edali
*/ 

if ( ! function_exists( 'edali_social_link' ) ) :
    function edali_social_link(){ 
        global $edali_opt;

        if( isset( $edali_opt['edali_social_target'] ) ) {
            $target = $edali_opt['edali_social_target'];
        }else {
            $target = '_blank';
        }
        ?>
        <ul class="social-link">
            <?php if (isset($edali_opt['twitter_url'] ) && $edali_opt['twitter_url']) { ?>
                <li>
                    <a class="d-block twitter" target="<?php echo esc_attr($target); ?>" href="<?php  echo esc_url($edali_opt['twitter_url']);?>"> <i class="fa fa-twitter"></i></a>
                </li>
            <?php  } ?>


            <?php if (isset($edali_opt['facebook_url'] ) && $edali_opt['facebook_url']) { ?>
                <li>
                    <a class="d-block facebook" target="<?php echo esc_attr($target); ?>" href="<?php  echo esc_url($edali_opt['facebook_url']); ?>"> <i class="fa fa-facebook"></i></a>
                </li>
            <?php  } ?>

            <?php if (isset($edali_opt['instagram_url'] ) && $edali_opt['instagram_url'] ) { ?>
                <li>
                    <a class="d-block instagram" target="<?php echo esc_attr($target); ?>" href="<?php  echo esc_url($edali_opt['instagram_url']); ?>"> <i class="fa fa-instagram"></i></a>
                </li>
            <?php  } ?>

            <?php 
            if (isset($edali_opt['linkedin_url'] ) && $edali_opt['linkedin_url'] ) { ?>
            <li>
                <a class="d-block" target="<?php echo esc_attr($target); ?>" href="<?php  echo esc_url($edali_opt['linkedin_url']);?>" > <i class="fa fa-linkedin"></i></a>
            </li>
            <?php  } ?>

            <?php 
            if (isset($edali_opt['pinterest_url'] ) && $edali_opt['pinterest_url'] ) { ?>
            <li>
                <a class="d-block" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($edali_opt['pinterest_url']);?>" > <i class="fa fa-pinterest"></i></a>
            </li>
            <?php  } ?>

            <?php if (isset($edali_opt['dribbble_url'] ) && $edali_opt['dribbble_url'] ) { ?>
                <li>
                    <a class="d-block" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($edali_opt['dribbble_url']);?>" > <i class="fa fa-dribbble"></i></a>
                </li>
            <?php } ?>

            <?php if (isset($edali_opt['tumblr_url'] ) && $edali_opt['tumblr_url'] ) { ?>
                <li>
                    <a class="d-block" target="<?php echo esc_attr($target); ?>" href="<?php  echo esc_url($edali_opt['tumblr_url']);?>" > <i class="fa fa-tumblr"></i></a>
                </li>
            <?php } ?>

            <?php 
            if (isset($edali_opt['youtube_url'] ) && $edali_opt['youtube_url'] ) { ?>
            <li>
                <a class="d-block" target="<?php echo esc_attr($target); ?>" href="<?php  echo esc_url($edali_opt['youtube_url']);?>" > <i class="fa fa-youtube"></i></a>
            </li>
            <?php  } ?>

            <?php if (isset($edali_opt['flickr_url'] ) && $edali_opt['flickr_url'] ) { ?>
                <li>
                    <a class="d-block" target="<?php echo esc_attr($target); ?>" href="<?php  echo esc_url($edali_opt['flickr_url']);?>" > <i class="fa fa-flickr"></i></a>
                </li>
            <?php } ?>

            <?php if (isset($edali_opt['behance_url'] ) && $edali_opt['behance_url'] ) { ?>
                <li>
                    <a class="d-block" target="<?php echo esc_attr($target); ?>" href="<?php  echo esc_url($edali_opt['behance_url']);?>" > <i class="fa fa-behance"></i></a>
                </li>
            <?php } ?>

            <?php if (isset($edali_opt['github_url'] ) &&  $edali_opt['github_url'] ) { ?>
                <li>
                    <a class="d-block" target="<?php echo esc_attr($target); ?>" href="<?php  echo esc_url($edali_opt['github_url']);?>" > <i class="fa fa-github"></i></a>
                </li>
            <?php } ?>

            <?php if (isset($edali_opt['skype_url'] ) && $edali_opt['skype_url'] ) { ?>
                <li>
                    <a class="d-block" target="<?php echo esc_attr($target); ?>" href="<?php  echo esc_url($edali_opt['skype_url']);?>" > <i class="fa fa-skype"></i></a>
                </li>
            <?php } ?>

            <?php if (isset($edali_opt['rss_url'] ) && $edali_opt['rss_url'] ) { ?>
                <li>
                    <a class="d-block" target="<?php echo esc_attr($target); ?>" href="<?php  echo esc_url($edali_opt['rss_url']);?>" > <i class="fas fa-rss"></i></a>
                </li>
            <?php } ?>
        </ul>
    <?php
    } 
endif; ?>