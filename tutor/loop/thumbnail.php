<?php

/**
 * Display loop thumbnail
 *
 * @since v.1.0.0
 * @author envytheme
 * @url https://envytheme.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */
?>
<div class="courses-image">
    <a href="<?php the_permalink(); ?>" class="d-block"> <?php get_tutor_course_thumbnail(); ?> </a>
    <div class="courses-tag">
        <?php echo get_tutor_course_level(); ?>             
    </div>

</div>
