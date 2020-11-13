<?php
/**
 * Header Style Two
 * Eadli
 */

    global $edali_opt;

    if( isset( $edali_opt['enable_top_header'] ) ):
        // header default
        $top_header_login_title1 	= $edali_opt['top_header_login_title1'];
        $top_header 				= $edali_opt['enable_top_header'];

        
        if( isset($edali_opt['top_header_register_link_type']) ):
            $top_header_register_link_type  = $edali_opt['top_header_register_link_type'];
            $register_external_link         = $edali_opt['top_header_register_link_external'];
            $top_header_register_link1 	    = $edali_opt['top_header_register_link1'];
            $top_header_login_link_type     = $edali_opt['top_header_login_link_type'];
            $external_link                  = $edali_opt['top_header_login_link_external'];
            $top_header_login_link1 	    = $edali_opt['top_header_login_link1'];
        else:
            $top_header_register_link_type  = '';
            $register_external_link         = '';
            $top_header_register_link1 	    = '';
            $top_header_login_link_type     = '';
            $external_link                  = '';
            $top_header_login_link1 	    = '';
        endif;

        // header style one
        $top_header_phone_title2	= $edali_opt['top_header_phone_title2'];
        $top_header_phone2		 	= $edali_opt['top_header_phone2'];
        $top_header_phone_link2		= $edali_opt['top_header_phone_link2'];
        $top_header_location_title2	= $edali_opt['top_header_location_title2'];
        $top_header_location2		= $edali_opt['top_header_location2'];
        $top_header_location_link2	= $edali_opt['top_header_location_link2'];
        $top_header_email_title2	= $edali_opt['top_header_email_title2'];
        $top_header_email2		 	= $edali_opt['top_header_email2'];
        $top_header_email_link2		= $edali_opt['top_header_email_link2'];
    else:
        // header default
        $top_header 					= false;
        $top_header_login_title1 		= '';
        $top_header_login_link1 		= '';

        // header style one
        $top_header_phone2	 			= '';
        $top_header_phone_link2	 		= '';
        $top_header_location_title2	 	= '';
        $top_header_location2	 		= '';
        $top_header_location_link2	 	= '';
        $top_header_email_title2	 	= '';
        $top_header_email2	 			= '';
        $top_header_email_link2	 		= '';
    endif;

    // Main site logo
    if(isset($edali_opt['main_logo']['url'])):
        $logo 	= $edali_opt['main_logo']['url'];
    else:
        $logo	= '';	
    endif;

    // Logo for mobile device
    if(isset($edali_opt['mobile_logo']['url'])):
        $mobile_logo 	= $edali_opt['mobile_logo']['url'];
    else:
        $mobile_logo	= '';	
    endif;

    $hide_adminbar = 'hide-adminbar';

    // Menu option
    if( isset( $edali_opt['enable_search_icon'] ) ):
        $search_icon 		= $edali_opt['enable_search_icon'];
        $search_place 		= $edali_opt['search_placeholder_text'];
    else:
        $search_icon		= false;
        $search_place 		= '';

    endif;

?>

<header class="header-area <?php if ( current_user_can('administrator') ) { echo esc_attr( $hide_adminbar ); } ?>">

    <?php if( $top_header == true ): ?>
        <?php if( $top_header_phone_title2 != '' || $top_header_phone2 != '' || $top_header_location_title2 != '' || $top_header_location2 != '' || $top_header_email_title2 != '' || $top_header_email2 != '' ): ?>
            <div class="top-header-style-two <?php if ( current_user_can('administrator') ) { echo esc_attr( $hide_adminbar ); } ?>">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <div class="top-header-logo">
                                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <?php if( $logo != '' ): ?>
                                    <img src="<?php echo esc_url( $logo ); ?>" class="d-inline-block" alt="<?php bloginfo( 'name' ); ?>">
                                <?php else: ?>
                                    <h2><?php bloginfo( 'name' ); ?></h2>
                                <?php endif; ?>
                            </a>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <ul class="top-header-contact-info">
                                <?php if( $top_header_phone_title2 != '' || $top_header_phone2 != '' ): ?>
                                    <li>
                                        <i class='bx bx-phone-call'></i>
                                        <span><?php echo esc_html( $top_header_phone_title2 ); ?></span>
                                        <a href="<?php echo esc_url( $top_header_phone_link2 ); ?>"><?php echo esc_html( $top_header_phone2 ); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if( $top_header_location_title2 != '' || $top_header_location2 != '' ): ?>
                                    <li>
                                        <i class='bx bx-map'></i>
                                        <span><?php echo esc_html( $top_header_location_title2 ); ?></span>
                                        <a href="<?php echo esc_url( $top_header_location_link2 ); ?>"><?php echo esc_html( $top_header_location2 ); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if( $top_header_email_title2 != '' || $top_header_email2 != '' ): ?>
                                    <li>
                                        <i class='bx bx-envelope'></i>
                                        <span><?php echo esc_html( $top_header_email_title2 ); ?></span>
                                        <a href="<?php echo esc_url( $top_header_email_link2 ); ?>"><?php echo esc_html( $top_header_email2 ); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Start Navbar Area -->
    <div class="navbar-area navbar-style-two">
        <div class="edali-responsive-nav">
            <div class="container">
                <div class="edali-responsive-menu">
                    <div class="logo">
                        <a href="<?php echo esc_url( home_url( '/' ) );?>">
                            <?php if( $mobile_logo != '' ): ?>
                                <img src="<?php echo esc_url( $mobile_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                            <?php elseif( $logo != '' ): ?>
                                <img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                            <?php else: ?>
                                <h2><?php bloginfo( 'name' ); ?></h2>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="edali-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <div class="collapse navbar-collapse mean-menu">
                        <?php
                            $primary_nav_arg = [
                                'menu'            => 'primary',
                                'theme_location'  => 'primary',
                                'container'       => null,
                                'menu_class'      => 'navbar-nav ml-auto',
                                'depth'           => 3,
                                'walker'          => new Edali_Bootstrap_Navwalker(),
                                'fallback_cb'     => 'Edali_Bootstrap_Navwalker::fallback',
                            ];
                    
                            if(has_nav_menu('primary')){ wp_nav_menu( $primary_nav_arg );  }
                        ?>

                        <div class="others-option">
                            <?php edali_cart_icon(); ?>  
                            <?php if( $search_icon == true ): ?>
                                <div class="search-box d-inline-block">
                                    <i class='bx bx-search'></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="navbar-area navbar-style-two header-sticky <?php if ( current_user_can('administrator') ) { echo esc_attr( $hide_adminbar ); } ?>">
        <div class="edali-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <div class="collapse navbar-collapse">
                        <?php
                            $primary_nav_arg = [
                                'menu'            => 'primary',
                                'theme_location'  => 'primary',
                                'container'       => null,
                                'menu_class'      => 'navbar-nav ml-auto',
                                'depth'           => 3,
                                'walker'          => new Edali_Bootstrap_Navwalker(),
                                'fallback_cb'     => 'Edali_Bootstrap_Navwalker::fallback',
                            ];
                    
                            if(has_nav_menu('primary')){ wp_nav_menu( $primary_nav_arg );  }
                        ?>

                        <div class="others-option">    
                            <?php edali_cart_icon(); ?>  
                            <?php if( $search_icon == true ): ?>
                                <div class="search-box d-inline-block">
                                    <i class='bx bx-search'></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</header>