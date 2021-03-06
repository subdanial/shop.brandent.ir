<?php
/**
 * Template for displaying main user profile page.
 *
 * This template can be overridden by copying it to edali/learnpress/profile/profile.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile = LP_Global::profile();

if ( $profile->is_public() ) {
	?>

    <div id="learn-press-user-profile"<?php $profile->main_class(); ?>>
		<div class="row">
			<?php

		
			// do_action( 'learn-press/before-user-profile', $profile );

		
			do_action( 'learn-press/user-profile', $profile );

			do_action( 'learn-press/after-user-profile', $profile );

			?>
		</div>
    </div>

<?php } else {
	_e( 'This user does not public their profile.', 'edali' );
}