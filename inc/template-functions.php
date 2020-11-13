<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 * @package Edali
 */

/**
 * Adds custom classes to the array of body classes.
 */
if ( ! function_exists( 'edali_body_classes' ) ) {
	function edali_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no sidebar present.
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'edali_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
if ( ! function_exists( 'edali_pingback_header' ) ) {
	function edali_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}
}
add_action( 'wp_head', 'edali_pingback_header' );

/**
 * Edali Preloader
*/
if ( ! function_exists( 'edali_preloader' ) ) {
	function edali_preloader() { 
		global $edali_opt;
        $is_preloader       = !empty($edali_opt['enable_preloader']) ? $edali_opt['enable_preloader'] : '';
		$preloader_style    = !empty($edali_opt['preloader_style']) ? $edali_opt['preloader_style'] : 'circle-spin';
		
		if( $is_preloader == '1' ): 
            if ( defined( 'ELEMENTOR_VERSION' ) ) :
                if (\Elementor\Plugin::$instance->preview->is_preview_mode()) :
                    echo '';
                else:
                    if ( $preloader_style == 'text' ) :
                        if (!empty( $edali_opt['loading_text'] ) ) : ?>
                            <div class="preloader">
                                <div class="loader">
                                    <p class="text-center"> <?php echo esc_html( $edali_opt['loading_text'] ) ?> </p>
                                </div>
                            </div>
                        <?php endif;
                    elseif( $preloader_style == 'circle-spin' ) : ?>
						<div class="preloader">
							<div class="loader">
								<div class="shadow"></div>
								<div class="box"></div>
							</div>
						</div>
                    <?php elseif( $preloader_style == 'image' ) : ?>
						<div class="preloader">
							<div class="loader">
								<img src="<?php echo esc_url($edali_opt['preloader_image']['url']); ?>" alt="<?php echo esc_attr_e('Edali Preloader', 'edali') ?>">
							</div>
						</div>
                    <?php else: ?>
                        <div class="preloader">
                            <div class="loader">
                            </div>
                        </div>
                    <?php endif;
                endif;
            else:
                if ( $preloader_style == 'text' ) :
                    if (!empty( $edali_opt['loading_text'] ) ) : ?>
                        <div class="preloader">
                            <div class="loader">
                                <p class="text-center"> <?php echo esc_html( $edali_opt['loading_text'] ) ?> </p>
                            </div>
                        </div>
                    <?php endif;
                elseif( $preloader_style == 'circle-spin' ) :
                    ?>
					<div class="preloader">
						<div class="loader">
							<div class="shadow"></div>
							<div class="box"></div>
						</div>
					</div>
				<?php elseif( $preloader_style == 'image' ) : ?>
					<div class="preloader">
						<div class="loader">
							<img src="<?php echo esc_url($edali_opt['preloader_image']['url']); ?>" alt="<?php echo esc_attr_e('Edali Preloader', 'edali') ?>">
						</div>
					</div>
				<?php else: ?>
                    <div class="preloader">
                        <div class="loader">
                        </div>
                    </div>
                    <?php 
                endif;
            endif;
        endif;
	}
}

/**
 * 
 * Edali Tutor Banner
 * 
*/
if ( ! function_exists( 'edali_tutor_single_banner' ) ) {
	function edali_tutor_single_banner() { 
		global $edali_opt;

		if( isset( $edali_opt['course_bg_image'] ) ):
			if( get_field('tutor_background_image') != '' ):
				$course_bg   = get_field('tutor_background_image');
			else:
				$course_bg   = $edali_opt['course_bg_image']['url'];
			endif;
			$hide_banner        = $edali_opt['hide_tutor_banner'];
			$hide_breadcrumb    = $edali_opt['hide_tutor_breadcrumb'];
		else:	
			$course_bg          = '';
			$hide_banner        = false;
			$hide_breadcrumb    = false;
		endif;
		?>
		
    <?php if( $hide_banner == false ) { ?><!-- Start Page Title Area -->
        <div class="page-title-area item-bg1 jarallax" data-jarallax='{"speed": 0.3}' style="background-image:url(<?php echo esc_url($course_bg); ?>);">
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
                                    <li><?php the_title(); ?></li>
                                </ul>
                            <?php 
                            }
                        ?>
                    <?php endif; ?>
                    <h2><?php the_title(); ?></h2>
                </div>
            </div>
        </div>
    <?php }
	}
}
/**
 * 
 * Edali Modal
 * 
*/
	if ( ! function_exists( 'edali_search_overlay' ) ) {
		function edali_search_overlay() { 
			global $edali_opt;

			// Modal Data
			if( isset( $edali_opt['enable_search_icon'] ) ):
				$search_icon		= $edali_opt['enable_search_icon'];
				$placeholder_text	= $edali_opt['search_placeholder_text'];
			else:
				$search_icon		= false;
				$placeholder_text	= '';
			endif;
			?>
			<?php if( $search_icon == true): ?>
				<div class="search-overlay">
					<div class="d-table">
						<div class="d-table-cell">
							<div class="search-overlay-layer"></div>
							<div class="search-overlay-layer"></div>
							<div class="search-overlay-layer"></div>
							
							<div class="search-overlay-close">
								<span class="search-overlay-close-line"></span>
								<span class="search-overlay-close-line"></span>
							</div>

							<div class="search-overlay-form">
								<?php if(  $placeholder_text != '' ): ?>
									<form method="get" action="<?php echo site_url( '/' ); ?>">
										<input type="text" value="" name="s" class="input-search" placeholder="<?php echo esc_attr( $placeholder_text ); ?>">
										<input type="hidden" value="course" name="ref" />
										<button type="submit"><i class='bx bx-search-alt'></i></button>
									</form>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			
			<?php
		}
	}

/**
 * Edali header area
 */
if ( ! function_exists( 'edali_header_area' ) ) {
	function edali_header_area(){

		global $edali_opt;
		
		$default_header_style = !empty($edali_opt['default_header_style']) ? $edali_opt['default_header_style'] : '';
		
		if( $default_header_style != '' ):
			$default_header_style = $edali_opt['default_header_style'];
		else:
			$default_header_style = 'style-1';
		endif;

		// Navbar style 
		if( function_exists('acf_add_options_page') ) {
			if( get_field('header_style') != '' ):
				$header_style 	= get_field( 'header_style' );
			else:
				$header_style = $default_header_style;
			endif;
		}else {
			$header_style 	= $default_header_style;
		}

		if( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() && 'post' == get_post_type() ):
			$header_style 	= $default_header_style;
		endif;
		get_template_part( 'template-parts/header/' . $header_style );
	}
}

if ( ! function_exists( 'edali_ajax_login_init' ) ) {
	function edali_ajax_login_init(){

		wp_register_script('ajax-login-script', get_template_directory_uri() . '/assets/js/ajax-login-script.js', array('jquery') ); 
		wp_enqueue_script('ajax-login-script');

		wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'redirecturl' => home_url('/profile'),
			'loadingmessage' => wp_kses_post("<p class='alert alert-primary'>Loading...</p>", "edali")
		));

		add_action( 'wp_ajax_nopriv_ajaxlogin', 'edali_ajax_login' );
	}
}

// Execute the action only if the user isn't logged in
if ( !is_user_logged_in() ) {
    add_action('init', 'edali_ajax_login_init');
}

/**
 * User Login
 */
if ( ! function_exists( 'edali_ajax_login' ) ) {
	function edali_ajax_login(){

		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'ajax-login-nonce', 'security' );

		// Nonce is checked, get the POST data and sign user on
		$info = array();
		$info['user_login'] = $_POST['username'];
		$info['user_password'] = $_POST['password'];
		$info['remember'] = true;

		$user_signon = wp_signon( $info, false );
		if ( is_wp_error($user_signon) ){
			echo json_encode(array('loggedin'=> false, 'message'=>  wp_kses_post("<p class='alert alert-warning'>Wrong username or password.</p>", "edali") ) );
		} else {
			if ( !is_wp_error($user_signon) ){
				wp_set_current_user($user_signon->ID);
				wp_set_auth_cookie($user_signon->ID);
				echo json_encode(array('loggedin' => true, 'message'=> wp_kses_post("<p class='alert alert-success'>Login successful, redirecting...</p>", "edali") ) );
			}
		}
		die();
	}
}


/**
 * Register user
 */
if ( ! function_exists( 'register_user_front_end' ) ) {
	function register_user_front_end() {
		$new_user_name = stripcslashes($_POST['new_user_name']);
		$new_user_email = stripcslashes($_POST['new_user_email']);
		$new_user_password = $_POST['new_user_password'];
		$user_nice_name = strtolower($_POST['new_user_email']);
		$user_data = array(
			'user_login' 		=> $new_user_name,
			'user_email' 		=> $new_user_email,
			'user_pass' 		=> $new_user_password,
			'user_nicename' 	=> $user_nice_name,
			'display_name' 		=> $new_user_first_name,
			);
			$user_id = wp_insert_user( $user_data );
			if ( !is_wp_error( $user_id ) ) {
				echo wp_kses_post("<p class='alert alert-success'>Created an account for you.</p>", "edali" );
				echo "<script>window.open('".home_url()."/login','_self')</script>";
			} else {
				if (isset( $user_id->errors['empty_user_login'] ) ) {
				$notice_key = esc_html__('Error please fill up the sign up form carefully.', 'edali');
				echo $notice_key;
				} elseif (isset( $user_id->errors['existing_user_login'] ) ) {
				echo esc_html__('User name already exist.', 'edali');
				} else {
				echo esc_html__('Error please fill up the sign up form carefully.', 'edali');
				}
			}
		die;
	}
}
add_action('wp_ajax_register_user_front_end', 'register_user_front_end', 0);
add_action('wp_ajax_nopriv_register_user_front_end', 'register_user_front_end');

/**
 * Edali RTL
 */
if( ! function_exists( 'edali_rtl' ) ):
	function edali_rtl() {
		global $edali_opt;

		if(	isset( $edali_opt['edali_enable_rtl'])  ):
			$edali_rtl_opt = $edali_opt['edali_enable_rtl'];
		else:
			$edali_rtl_opt = 'disable';
		endif;

		if ( isset( $_GET['rtl'] ) ) {
			$edali_rtl_opt = $_GET['rtl'];
		}

		if( $edali_rtl_opt == 'enable' ):
			$edali_rtl = true;
		else:
			$edali_rtl = false;
		endif;
		
		return $edali_rtl;
	}
endif;

/**
 * WooCommerce Cart Icon
 */
if( ! function_exists( 'edali_cart_icon' ) ) {
	function edali_cart_icon() {
		global $edali_opt;

		if( isset( $edali_opt['enable_cart_icon'] ) ):
        	$cart_icon 	= $edali_opt['enable_cart_icon'];
		else:
        	$cart_icon 	= false;
		endif;
		              
		if ( class_exists( 'WooCommerce' ) ):?>
			<?php if( $cart_icon == true ): ?>
				<div class="woo-cart-link d-inline-block">
					<a href="<?php echo esc_url(wc_get_cart_url()) ?>" class="cart-link">
						<i class="bx bx-cart-alt"></i>
						<span class="mini-cart-count"></span>
					</a> 
				</div>
			<?php endif; ?>
		<?php endif;
	}
}

/**
 * bbPress
 */
function edali_bbpress_css_enqueue(){
	if( function_exists( 'is_bbpress' ) ) {
		// Deregister default bbPress CSS
		wp_deregister_style( 'bbp-default' );

		$file = 'assets/css/bbpress.min.css';

		// Check child theme
		if ( file_exists( trailingslashit( get_stylesheet_directory() ) . $file ) ) {
			$location = trailingslashit( get_stylesheet_directory_uri() );
			$handle   = 'bbp-child-bbpress';

		// Check parent theme
		} elseif ( file_exists( trailingslashit( get_template_directory() ) . $file ) ) {
			$location = trailingslashit( get_template_directory_uri() );
			$handle   = 'bbp-parent-bbpress';
		}

		// Enqueue the bbPress styling
		wp_enqueue_style( $handle, $location . $file, 'screen' );
	}
}
add_action( 'wp_enqueue_scripts', 'edali_bbpress_css_enqueue' );

/**
 * Elementor post type support
 */
function edali_add_cpt_support() {

    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_cpt_support' );

    //check if option DOESN'T exist in db
    if ( ! $cpt_support ) {
        $cpt_support = [ 'page', 'post', 'header', 'footer' ]; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }
    //if it DOES exist, but header is NOT defined
    elseif ( !in_array( 'header', $cpt_support ) ) {
        $cpt_support[] = 'header'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    //if it DOES exist, but footer is NOT defined
    elseif ( !in_array( 'footer', $cpt_support ) ) {
        $cpt_support[] = 'footer'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
	}
}
add_action( 'after_switch_theme', 'edali_add_cpt_support' );


function edali_function_pcs() {
	$purchase_code = htmlspecialchars(get_option( 'edali_purchase_code' ));
	$purchase_code = str_replace(' ', '', $purchase_code );
	
	if( $purchase_code != '' ){
		require get_template_directory().'/inc/verify/class.verify-purchase.php';
		$o = EnvatoApi2::verifyPurchase( $purchase_code );

		if ( is_object($o) && strpos($o->item_name, 'Edali') !== false ) {

			// Check in localhost
			$whitelist = array(
				'127.0.0.1',
				'::1',
				'192.168.1',
				'192.168.0.1',
				'182.168.1.5',
				'192.168.1.4',
				'192.168.1.5',
				'192.168.1.4',
				'192.168',
				'10.0.2.2',
			);

			if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ // In server
				$url 			= 'https://api.envytheme.com/api/v1/license';
				$purchaseKey 	= $purchase_code;
				$itemName 		= $o->item_name;
				$buyer 			= $o->buyer;
				$purchasedAt 	= $o->created_at;
				$supportUntil 	= $o->supported_until;
				$licenseType 	= $o->licence;
				$domain 		= get_site_url();
				$post_url 		= '';

				$post_url .= $url.'?purchaseKey='.$purchaseKey.'&itemName='.$itemName.'&buyer='.$buyer.'&purchasedAt='.$purchasedAt.'&supportUntil='.$supportUntil.'&licenseType='.$licenseType.'&domain='.$domain.'';

				$post_url = str_replace(' ', '%', $post_url);

				$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_URL 			=> $post_url,
					CURLOPT_RETURNTRANSFER 	=> true,
					CURLOPT_ENCODING 		=> "",
					CURLOPT_MAXREDIRS		=> 10,
					CURLOPT_TIMEOUT 		=> 30,
					CURLOPT_HTTP_VERSION 	=> CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST 	=> "POST",
					CURLOPT_HTTPHEADER 		=> array(
						"cache-control: no-cache",
						"content-type: application/x-www-form-urlencoded"
					),
					CURLOPT_SSL_VERIFYPEER => false,
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);

				if ($err) {
					echo "cURL Error #:" . $err;
				} else {
					$json = json_decode($response);
					$already_registered = $json->message[0]; // Already registered

					$new_response = '';
					$new_response .= 'Congratulations! Updated for this domain '.$domain.'';
					preg_match_all('#https?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $already_registered, $match);
					$url 			= $match[0];
					$protocols 		= array('http://', 'http://www.', 'www.', 'https://', 'https://www.');
					$domain_name 	= str_replace( $protocols, '', $url[0] );	
					$site_url 		= str_replace( $protocols, '', get_site_url() );

					if( $already_registered != '' ){
						if( $already_registered == $new_response ):
							update_option('edali_purchase_code_status', 'valid', 'yes');
							update_option('edali_purchase_valid_code',  $purchase_code, 'yes');
							update_option('edali_valid_url',  $domain, 'yes');
							update_option('valid_url', get_site_url(), 'yes');
							?><script>let date = new Date(Date.now() + 604800);	date = date.toUTCString(); document.cookie = "ET_L_Status=<?php echo $purchase_code; ?>; expires=" + date; </script><?php
						elseif( $domain_name == $site_url ):
							/* Deregister  */
								$url 			= 'https://api.envytheme.com/api/v1/license';
								$purchaseKey 	= $purchase_code;
								$status 		= 'disabled';
								$post_url = '';
								$post_url .= $url.'?purchaseKey='.$purchaseKey.'&status='.$status.'';
								$post_url = str_replace(' ', '%', $post_url);
								$curl = curl_init();
								curl_setopt_array($curl, array(
									CURLOPT_URL 			=> $post_url,
									CURLOPT_RETURNTRANSFER 	=> true,
									CURLOPT_ENCODING 		=> "",
									CURLOPT_MAXREDIRS 		=> 10,
									CURLOPT_TIMEOUT 		=> 30,
									CURLOPT_HTTP_VERSION 	=> CURL_HTTP_VERSION_1_1,
									CURLOPT_CUSTOMREQUEST 	=> "PUT",
									CURLOPT_HTTPHEADER 		=> array(
										"cache-control: no-cache",
										"content-type: application/x-www-form-urlencoded"
									),
									CURLOPT_SSL_VERIFYPEER => false,
								));

								$response = curl_exec($curl);
								$err = curl_error($curl);
								curl_close($curl);
							/* Deregister */

							/* Register */
								$url 			= 'https://api.envytheme.com/api/v1/license';
								$purchaseKey 	= $purchase_code;
								$itemName 		= $o->item_name;
								$buyer 			= $o->buyer;
								$purchasedAt 	= $o->created_at;
								$supportUntil 	= $o->supported_until;
								$licenseType 	= $o->licence;
								$domain 		= get_site_url();
								$post_url 		= '';

								$post_url .= $url.'?purchaseKey='.$purchaseKey.'&itemName='.$itemName.'&buyer='.$buyer.'&purchasedAt='.$purchasedAt.'&supportUntil='.$supportUntil.'&licenseType='.$licenseType.'&domain='.$domain.'';
								
								$post_url = str_replace(' ', '%', $post_url);
							
								$curl = curl_init();

								curl_setopt_array($curl, array(
								CURLOPT_URL => $post_url,
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => "",
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 30,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => "POST",
								CURLOPT_HTTPHEADER => array(
									"cache-control: no-cache",
									"content-type: application/x-www-form-urlencoded"
								),
								CURLOPT_SSL_VERIFYPEER => false,
								));

								$response = curl_exec($curl);
								$err = curl_error($curl);
								curl_close($curl);
							/* Register */

							update_option('edali_purchase_code_status', 'valid', 'yes');
							update_option('edali_purchase_valid_code',  $purchase_code, 'yes');
							update_option('edali_valid_url',  $domain, 'yes');
							update_option('valid_url', get_site_url(), 'yes');						
							?><script>let date = new Date(Date.now() + 604800);	date = date.toUTCString(); document.cookie = "ET_L_Status=<?php echo $purchase_code; ?>; expires=" + date; </script><?php
						else:
							$target_site 	= $url[0];
							$src 			= file_get_contents( $target_site );
							preg_match("/\<link rel='stylesheet' id='edali-style-css'.*href='(.*?style\.css.*?)'.*\>/i", $src, $matches );

							if( $matches ) { // if theme found
								update_option('edali_purchase_code_status', 'already_registered', 'yes');
								update_option('edali_already_registered', $already_registered, 'yes');
							}else{
								/* Deregister  */
									$url 			= 'https://api.envytheme.com/api/v1/license';
									$purchaseKey 	= $purchase_code;
									$status 		= 'disabled';
									$post_url = '';
									$post_url .= $url.'?purchaseKey='.$purchaseKey.'&status='.$status.'';
									$post_url = str_replace(' ', '%', $post_url);
									$curl = curl_init();
									curl_setopt_array($curl, array(
										CURLOPT_URL 			=> $post_url,
										CURLOPT_RETURNTRANSFER 	=> true,
										CURLOPT_ENCODING 		=> "",
										CURLOPT_MAXREDIRS 		=> 10,
										CURLOPT_TIMEOUT 		=> 30,
										CURLOPT_HTTP_VERSION 	=> CURL_HTTP_VERSION_1_1,
										CURLOPT_CUSTOMREQUEST 	=> "PUT",
										CURLOPT_HTTPHEADER 		=> array(
											"cache-control: no-cache",
											"content-type: application/x-www-form-urlencoded"
										),
										CURLOPT_SSL_VERIFYPEER => false,
									));

									$response = curl_exec($curl);
									$err = curl_error($curl);
									curl_close($curl);
								/* Deregister */

								/* Register */
									$url 			= 'https://api.envytheme.com/api/v1/license';
									$purchaseKey 	= $purchase_code;
									$itemName 		= $o->item_name;
									$buyer 			= $o->buyer;
									$purchasedAt 	= $o->created_at;
									$supportUntil 	= $o->supported_until;
									$licenseType 	= $o->licence;
									$domain 		= get_site_url();
									$post_url 		= '';

									$post_url .= $url.'?purchaseKey='.$purchaseKey.'&itemName='.$itemName.'&buyer='.$buyer.'&purchasedAt='.$purchasedAt.'&supportUntil='.$supportUntil.'&licenseType='.$licenseType.'&domain='.$domain.'';
									
									$post_url = str_replace(' ', '%', $post_url);
								
									$curl = curl_init();

									curl_setopt_array($curl, array(
									CURLOPT_URL => $post_url,
									CURLOPT_RETURNTRANSFER => true,
									CURLOPT_ENCODING => "",
									CURLOPT_MAXREDIRS => 10,
									CURLOPT_TIMEOUT => 30,
									CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									CURLOPT_CUSTOMREQUEST => "POST",
									CURLOPT_HTTPHEADER => array(
										"cache-control: no-cache",
										"content-type: application/x-www-form-urlencoded"
									),
									CURLOPT_SSL_VERIFYPEER => false,
									));

									$response = curl_exec($curl);
									$err = curl_error($curl);
									curl_close($curl);
								/* Register */
							}
						endif;
					}else {
						update_option('edali_purchase_code_status', 'valid', 'yes');
						update_option('edali_purchase_valid_code',  $purchase_code, 'yes');
						update_option('edali_valid_url',  $domain, 'yes');
						update_option('valid_url', get_site_url(), 'yes');
						?><script>let date = new Date(Date.now() + 604800);	date = date.toUTCString(); document.cookie = "ET_L_Status=<?php echo $purchase_code; ?>; expires=" + date; </script><?php
					}

				}

			}else{ // In local
				$domain = get_site_url();
				update_option('edali_purchase_code_status', 'valid', 'yes');
				update_option('edali_purchase_valid_code',  $purchase_code, 'yes');
				update_option('edali_valid_url',  $domain, 'yes');
			}
		} elseif( $purchase_code == '' ){
			update_option( 'edali_purchase_code_status', '', 'yes' );
			update_option( 'edali_purchase_code', '', 'yes' );
		}
	}
}

add_action( 'admin_bar_menu', 'edali_header_options', 500 );
function edali_header_options ( WP_Admin_Bar $admin_bar ) {
    global $wp;
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
	if ( $actual_link == home_url('/wp-admin/admin.php?page=edali') ){
		return '';
	}else{
		$site_url 	= get_site_url();
		$valid_url 	= get_option( 'valid_url' );
		$purchase_code = get_option( 'edali_purchase_code' );
	
		if( current_user_can('administrator') ) {
			if(!isset($_COOKIE['ET_L_Status'])) {
				edali_function_pcs();
			}elseif( $site_url !=  $valid_url) {
				edali_function_pcs();
			}
		}else{
			?><script>let date = new Date(Date.now() - 604800);	date = date.toUTCString(); document.cookie = "ET_L_Status=<?php echo $purchase_code; ?>; expires=" + date; </script><?php
		}
	}
}