<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="author" content=""/>
        <!-- Bootstrap core CSS -->
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
        <?php wp_head(); ?>
        <style>
        /* Single program detail page */
        .singleProWrapper {
            column-gap: 30px;
            row-gap: 20px;
        }
        .singleProWrapper #service-logo {
            max-width: 150px;
            height: auto;
        }
        .singleProWrapper .programDetials__wrapper {
            width: 100%;
        }
        .singleProWrapper .programDetials__wrapper .program__summary {
            font-size: 18px;
            font-weight: 500;
        }
        .singleProWrapper .serviceProSocial__wrapper{
            display: flex;
            column-gap: 10px;
            padding: 16px 0 20px;
            width: 100%;
        }
        .singleProWrapper .serviceProSocial i {
            background-color: #00A887;
            color: #fff;
            height: 32px;
            width: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .singleProWrapper table {
            margin: 0;
            margin-bottom: 1rem;
        }
        .singleProWrapper table th {
            vertical-align: middle;
            width: 230px;
            padding: 16px;
        }
        .singleProWrapper table th img {
            max-width: 28px;
            width: 100%;
            margin-right: 10px;
        }
        .singleProWrapper .rural__question {
            font-size: 14px;
            font-weight: 300;
        }
        .singleProWrapper table td {
            font-size: 18px;
            font-weight: 500;
            vertical-align: middle;
            padding: 16px;
        }
        .singleProWrapper .rural__question {
            margin: 0;
            padding: 20px 0;
            display: block;
        }
        .singleProWrapper table .hasOther {
            margin-top: -1.65rem;
            margin-left: 3rem;
        }
        .gform_heading {
            display: block !important;
        }
        </style>
    </head>
    <body itemscope="" itemtype="http://schema.org/WebPage" class="<?php echo implode(' ', get_body_class()); ?>">
        <?php if( function_exists( 'wp_body_open' ) ) wp_body_open(); ?>
        <div class="bg-white container shadow-lg site">
            <?php $image_attributes = !empty( get_the_ID() ) ? wp_get_attachment_image_src( PG_Image::isPostImage() ? get_the_ID() : get_post_thumbnail_id( get_the_ID() ), 'full' ) : null; ?>
            <header id="jr-header" style="<?php if($image_attributes) echo 'background-image:url(\''.$image_attributes[0].'\')' ?>" class="<?php if($image_attributes) echo 'hasFeature'; ?>">
                <div id="stickyBar" class="container"> <a class="skip-link sr-only sr-only-focusable" href="#main-content"><?php _e( 'Skip to content', 'tb_theme' ); ?></a> 
                    <div id="mobile_jr_menu"> 
                        <div id="mobile_jr_inner" class="inner_jr_mobile"> 
                            <div class="mobile_click" id="mobile_upper_content"> 
                                <div id="topper"> 
                                    <div>
                                        <?php _e( 'Menu', 'tb_theme' ); ?>
                                    </div>
                                    <i class="fa-times-circle far" id="mobile_m_close"></i> 
                                </div>                                 
                                <div id="mobile_search" class="head_searches"> 
                                    <form method="get" id="mobile_searchform" action="<?php echo get_site_url(); ?>" role="search" _lpchecked="1" class="shadow"> 
                                        <label class="sr-only" for="s">
                                            <?php _e( 'Search', 'tb_theme' ); ?>
                                        </label>                                         
                                        <div class="input-group"> 
                                            <div class="mobile_s_icon">
                                                <i class="fa-search fas"></i> 
                                            </div>                                             
                                            <input class="field form-control" id="s" name="s" type="text" placeholder="Search" value=""/>
                                            <span class="input-group-append"> <input class="submit btn btn-primary" id="searchsubmit2" name="submit" type="submit" value="Search"/> </span> 
                                        </div>                                         
                                    </form>                                     
                                </div>                                 
                            </div>                             
                            <div class="mobile_click" id="wrapper_mm_1"> 
                                <?php wp_nav_menu( array(
                                        'menu' => 'mobile_menu_locations',
                                        'menu_class' => 'mobile_click',
                                        'menu_id' => 'ul_mm_1',
                                        'container' => '',
                                        'theme_location' => 'mobile',
                                        'walker' => new Mobile_Locations_Walker()
                                ) ); ?> 
                            </div>                             
                        </div>                         
                    </div>                     
                    <div id="wrapper-navbar"> 
                        <div class="colorbar"> 
                            <div class="bg-secondary colCol"></div>                             
                            <div class="bg-green-light colCol"></div>                             
                            <div class="bg-tertiary colCol"></div>                             
                            <div class="bg-primary colCol"></div>                             
                            <div class="bg-secondary colCol"></div>                             
                            <div class="bg-green-light colCol"></div>                             
                        </div>                         
                        <nav class="standard_nav">
                            <a href="<?php echo esc_url( get_home_url() ); ?>" id="logoLink"><img id="jr_head_logo" src="<?php echo get_template_directory_uri(); ?>/a_images/Generation-Thrive-Logo-High-Res.png" class="headLogos skip-lazy" alt="EcoRise Logo"/><img id="jr_head_logo_white" src="<?php echo get_template_directory_uri(); ?>/a_images/Generation-Thrive-Logo-White-High-Res.png" class="headLogos skip-lazy" alt="EcoRise Logo"/></a> 
                            <div id="userNav"> 
                                <?php if ( is_user_logged_in() ) : ?>
                                    <div id="myProfile">
                                        <a href="<?php echo get_site_url(); ?>/my-profile/" class="btn btn-primary"><?php _e( 'My Profile', 'tb_theme' ); ?></a> 
                                    </div>
                                <?php endif; ?> 
                                <div id="loginLogout">
                                    <?php if ( !is_user_logged_in() ) : ?>
                                        <a href="<?php echo get_site_url(); ?>/login" class="btn btn-primary"><?php _e( 'Log In', 'tb_theme' ); ?></a>
                                    <?php endif; ?> 
                                    <?php if ( is_user_logged_in() ) : ?>
                                        <div class="btn btn-primary"> 
                                            <?php wp_loginout( get_site_url().'/login', true ); ?> 
                                        </div>
                                    <?php endif; ?> 
                                </div>
                                <?php if ( is_user_logged_in() ) : ?>
                                    <div class="btn btn-primary popmake-11489"> <a id="support-btn"><?php _e( 'Support', 'tb_theme' ); ?></a> 
                                    </div>
                                <?php endif; ?> 
                            </div>                             
                            <div id="primary-nav-wrapper" class="d-lg-flex d-none"> 
                                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                    <?php wp_nav_menu( array(
                                            'menu_class' => 'stand_menu_ul',
                                            'menu_id' => 'menu-main-navigation',
                                            'container' => '',
                                            'depth' => '4',
                                            'theme_location' => 'primary',
                                            'walker' => new JR_Standard_Walker()
                                    ) ); ?>
                                <?php endif; ?> 
                            </div>                             
                            <div class="d-lg-none hamMenuWrapper" id="jr_menu_mobile">
                                <i class="fa-2x fa-bars fas"></i> 
                            </div>                             
                        </nav>                         
                        <div class="colorbar" id="hasNoFeature"> 
                            <div class="bg-secondary colCol"></div>                             
                            <div class="bg-green-light colCol"></div>                             
                            <div class="bg-tertiary colCol"></div>                             
                            <div class="bg-primary colCol"></div>                             
                            <div class="bg-secondary colCol"></div>                             
                            <div class="bg-green-light colCol"></div>                             
                        </div>                         
                    </div>                     
                </div>
                <div class="hero" id="headerHero">
                    <div class="heroWrapper" id="heroWrapper">
                        <div class="container">
</div>
                    </div>
                </div>
            </header>
            <div id="site_content">