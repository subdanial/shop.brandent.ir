<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */
?>

<div class="courses-content">
    <div class="course-author d-flex align-items-center"><?php 
        global $post, $authordata;
        $user_id = get_current_user_id(); 
        $user = get_user_by('ID', $user_id); 
        $profile_url = tutor_utils()->profile_url($authordata->ID);
        ?>
        <img src="<?php echo get_avatar_url($user_id, array('size' => 150)); ?>" />                                
        <span><a href="<?php echo $profile_url; ?>"><?php echo get_the_author(); ?></a></span>
    </div>