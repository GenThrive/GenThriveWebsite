<?php get_header(); ?>

                <div id="jumbotron_wrapper">
                    <?php $image_attributes = !empty( get_the_ID() ) ? wp_get_attachment_image_src( PG_Image::isPostImage() ? get_the_ID() : get_post_thumbnail_id( get_the_ID() ), 'full' ) : null; ?>
                    <div style="<?php if($image_attributes) echo 'background-image:url(\''.$image_attributes[0].'\')' ?>">
                        <div>
                            <?php if ( is_single() || is_page() ) : ?>
                                <h1><?php the_title(); ?></h1>
                            <?php else : ?>
                                <h1><?php wp_title(); ?></h1>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div id="content" class="a_jr_pad_lg">
                    <div id="primary">
                        <p><?php _e( 'This is the a-master page and only handles the standard header &amp; footer for entire site. You should also put reusable elements and customizer fields here as a way to keep them orginized in the project.', 'tb_theme' ); ?></p>
                        <p><?php _e( 'All custom work that will be used on more than one page should be built on this page as a component item in Pinegrow (PG) actions (puzzle piece). By putting all reusable items/elements/features on this page it gives us a place to update them once for all pages that use them. Below you have space to look at common styling as well as learn about how our themes are structured.', 'tb_theme' ); ?></p>
                        <h3 class="bg-warning"><?php _e( 'Top Header Component', 'tb_theme' ); ?></h3>
                        <?php $image_attributes = !empty( get_the_ID() ) ? wp_get_attachment_image_src( PG_Image::isPostImage() ? get_the_ID() : get_post_thumbnail_id( get_the_ID() ), 'full' ) : null; ?>
                        <header id="jr-header" style="<?php if($image_attributes) echo 'background-image:url(\''.$image_attributes[0].'\')' ?>" class="<?php if($image_attributes) echo 'hasFeature'; ?>"> 
                            <div id="stickyBar" class="container"> <a class="skip-link sr-only sr-only-focusable" href="#main-content"><?php _e( 'Skip to content', 'tb_theme' ); ?></a> 
                                <div id="mobile_jr_menu"> 
                                    <div id="mobile_jr_inner" class="inner_jr_mobile"> 
                                        <div class="mobile_click" id="mobile_upper_content"> 
                                            <div id="topper"> 
                                                <div>
                                                    <?php _e( 'Menu', 'tb_theme' ); ?>
                                                </div><i class="fa-times-circle far" id="mobile_m_close"></i> 
                                            </div>                                             
                                            <div id="mobile_search" class="head_searches"> 
                                                <form method="get" id="mobile_searchform" action="<?php echo get_site_url(); ?>" role="search" _lpchecked="1" class="shadow"> 
                                                    <label class="sr-only" for="s">
                                                        <?php _e( 'Search', 'tb_theme' ); ?>
                                                    </label>                                                     
                                                    <div class="input-group"> 
                                                        <div class="mobile_s_icon"><i class="fa-search fas"></i> 
                                                        </div>                                                         
                                                        <input class="field form-control" id="s" name="s" type="text" placeholder="Search" value=""/><span class="input-group-append"> <input class="submit btn btn-primary" id="searchsubmit2" name="submit" type="submit" value="Search"/> </span> 
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
                                    <nav class="standard_nav"><a href="<?php echo esc_url( get_home_url() ); ?>" id="logoLink"><img id="jr_head_logo" src="<?php echo get_template_directory_uri(); ?>/a_images/Generation-Thrive-Logo-High-Res.png" class="headLogos skip-lazy" alt="EcoRise Logo"/><img id="jr_head_logo_white" src="<?php echo get_template_directory_uri(); ?>/a_images/Generation-Thrive-Logo-White-High-Res.png" class="headLogos skip-lazy" alt="EcoRise Logo"/></a> 
                                        <div id="userNav"> 
                                            <?php if ( is_user_logged_in() ) : ?>
                                                <div id="myProfile"><a href="<?php echo get_site_url(); ?>/my-profile/" class="btn btn-primary"><?php _e( 'My Profile', 'tb_theme' ); ?></a> 
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
                                                <div class="btn btn-primary"> <span class="popmake-11425"><?php _e( 'Log Out', 'tb_theme' ); ?></span> 
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
                                        <div class="d-lg-none hamMenuWrapper" id="jr_menu_mobile"><i class="fa-2x fa-bars fas"></i> 
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
                        <h2><?php _e( 'Begin Custom Gutenberg Blocks', 'tb_theme' ); ?></h2>
                        <hr/>
                        <h4><?php _e( 'Background Block', 'tb_theme' ); ?></h4>
                        <h4><?php _e( 'Column Style Block with Icon', 'tb_theme' ); ?></h4>
                        <div class="container">
                            <div class="mb-4 row">
                                <div class="col-md-6">
</div>
                                <div class="col-md-6">
                                    <div class="colorShadowImg">
                                        <img src="<?php echo get_template_directory_uri(); ?>/a_images/GenThrive-Home-Hero.jpg" class="shadColor-primary"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-4">
</div>
                            </div>
                        </div>
                        <div class="mb-3"> 
                            <h3 class="bg-warning"><?php _e( 'Gutenberg Buttons', 'tb_theme' ); ?></h3> 
                            <div class="p-1"></div>
                            <div class="p-1"></div>                             
                        </div>
                        <h2><?php _e( 'Begin Custom Reusable Elements', 'tb_theme' ); ?></h2>
                        <hr/>
                        <div class="alert alert-warning div">
                            <?php _e( 'Note where the reusable items are used in the theme. Ex: These icon cards are used on this_page.html, that_page.html&nbsp;', 'tb_theme' ); ?>
                        </div>
                        <div>
                            <h3 class="bg-warning"><?php _e( 'Starter Buttons', 'tb_theme' ); ?></h3>
                            <p class="border border-info pb-1 pl-1 pr-1 pt-1"><?php _e( 'These buttons can be used on all pages... please alter these as needed based on the design.&nbsp;', 'tb_theme' ); ?></p>
                            <div class="row">
                                <div class="col-lg-4">
                                    <h3><?php _e( 'Primary Colors', 'tb_theme' ); ?></h3>
                                    <div class="linkArrow primary"> <a href="link" target="_self" rel="noopener"><?php _e( 'Primary Button Text', 'tb_theme' ); ?></a> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="7.078" height="12.379" viewBox="0 0 7.078 12.379"> 
                                            <path class="a" d="M16.191,12.384,11.506,7.7a.881.881,0,0,1,0-1.249.892.892,0,0,1,1.253,0l5.307,5.3a.883.883,0,0,1,.026,1.22l-5.329,5.341a.885.885,0,0,1-1.253-1.249Z" transform="translate(-11.246 -6.196)"/> 
                                        </svg>                                         
                                    </div>
                                    <div class="p-1"></div>
                                    <a class="btn btn-primary" href="link"><?php _e( 'Primary Button Solid', 'tb_theme' ); ?></a>
                                    <div class="p-1"></div>
                                    <a class="btn btn-outline-primary" href="link"><?php _e( 'Primary Button Outline', 'tb_theme' ); ?></a>
                                </div>
                                <div class="col-lg-4">
                                    <h3><?php _e( 'Secondary Colors', 'tb_theme' ); ?></h3>
                                    <div class="linkArrow secondary">
                                        <a href="link"><?php _e( 'View All Specialties', 'tb_theme' ); ?></a>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="7.078" height="12.379" viewBox="0 0 7.078 12.379">
                                            <path class="a" d="M16.191,12.384,11.506,7.7a.881.881,0,0,1,0-1.249.892.892,0,0,1,1.253,0l5.307,5.3a.883.883,0,0,1,.026,1.22l-5.329,5.341a.885.885,0,0,1-1.253-1.249Z" transform="translate(-11.246 -6.196)"/>
                                        </svg>
                                    </div>
                                    <div class="p-1"></div><a class="btn btn-secondary" href="link"><?php _e( 'Secondary Button Solid', 'tb_theme' ); ?></a><a class="btn btn-secondary" href="filler"><?php _e( 'Close Window', 'tb_theme' ); ?></a>
                                    <div class="p-1"></div><a class="btn btn-outline-secondary" href="link"><?php _e( 'Secondary Button Outline', 'tb_theme' ); ?></a>
                                </div>
                                <div class="bg-dark col-lg-4">
                                    <h3 class="text-white"><?php _e( 'On Dark Background', 'tb_theme' ); ?></h3>
                                    <div class="linkArrow white">
                                        <a href="link"><?php _e( 'View All Specialties', 'tb_theme' ); ?></a>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="7.078" height="12.379" viewBox="0 0 7.078 12.379">
                                            <path class="a" d="M16.191,12.384,11.506,7.7a.881.881,0,0,1,0-1.249.892.892,0,0,1,1.253,0l5.307,5.3a.883.883,0,0,1,.026,1.22l-5.329,5.341a.885.885,0,0,1-1.253-1.249Z" transform="translate(-11.246 -6.196)"/>
                                        </svg>
                                    </div>
                                    <div class="p-1"></div><a class="btn btn-light" href="link"><?php _e( 'On Dark Button Solid', 'tb_theme' ); ?></a>
                                    <div class="p-1"></div><a class="btn btn-outline-light" href="link"><?php _e( 'Primary Button Outline', 'tb_theme' ); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h3 class="bg-warning"><?php _e( 'Article for the loop', 'tb_theme' ); ?></h3>
                            <p class="border border-info pb-1 pl-1 pr-1 pt-1"><?php _e( 'This is used on all standard loops index.php, archive.php, home.php &amp; search.php&nbsp;', 'tb_theme' ); ?></p>
                            <?php if ( have_posts() ) : ?>
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <?php PG_Helper::rememberShownPost(); ?>
                                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                        <header class="page-header">
                                            <?php if ( is_singular() ) : ?>
                                                <h2 class="entry-title"><?php the_title(); ?></h2>
                                            <?php else : ?>
                                                <h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
                                            <?php endif; ?>
                                            <div class="entry-meta">
                                                <?php _e( 'Posted on:', 'tb_theme' ); ?> <span><?php the_modified_date(); ?></span><span> <?php _e( '| Posted by:', 'tb_theme' ); ?> </span><span><?php echo get_the_author_meta( 'display_name', false ) ?></span>
                                            </div>
                                        </header>
                                        <?php echo PG_Image::getPostImage( null, 'thumbnail', array(
                                                'class' => 'blog_left_image'
                                        ), 'both', null ) ?>
                                        <div class="entry-content">
                                            <?php the_excerpt( ); ?>
                                            <a class="btn btn-primary" href="<?php echo esc_url( get_permalink() ); ?>"><?php _e( 'Read More', 'tb_theme' ); ?></a>
                                        </div>
                                        <footer class="entry-footer">
                                            <?php the_tags(); ?>
                                        </footer>
                                    </article>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p><?php _e( 'Sorry, no posts matched your criteria.', 'tb_theme' ); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="alert alert-danger">
                            <?php _e( 'End reusable items area', 'tb_theme' ); ?>
                        </div>
                        <h2><?php _e( 'Customize Sections', 'tb_theme' ); ?></h2>
                        <p><?php _e( 'All customzer fields should be declared on this page (never declare them in the header or footer).', 'tb_theme' ); ?></p>
                        <div class="header">
                            <h3><?php _e( 'Header Settings', 'tb_theme' ); ?></h3>
                            <img src="<?php echo PG_Image::getUrl( get_theme_mod( 'header_header_img', esc_url( get_template_directory_uri() . '/a_images/SculptNation%20logo.png' ) ), 'large' ) ?>"/>
                            <?php _e( 'Sets background image', 'tb_theme' ); ?>
                        </div>
                        <div class="soicial">
                            <h3><?php _e( 'Social Media Settings', 'tb_theme' ); ?></h3>
                            <div class="foot_soc_wrapper">
                                <?php if ( get_theme_mod( 'fb_show' ) ) : ?>
                                    <a class="soc_link" href="<?php echo get_theme_mod( 'fb_link', 'filler' ); ?>" target="_blank"><i class="fa-facebook-square fab"></i></a>
                                <?php endif; ?>
                                <?php if ( get_theme_mod( 'yt_show' ) ) : ?>
                                    <a class="soc_link" href="<?php echo get_theme_mod( 'yt_link', 'filler' ); ?>" target="_blank"><i class="fa-youtube-square fab"></i></a>
                                <?php endif; ?>
                                <?php if ( get_theme_mod( 'li_show' ) ) : ?>
                                    <a class="soc_link" href="<?php echo get_theme_mod( 'li_link', 'filler' ); ?>" target="_blank"><i class="fa-linkedin fab"></i></a>
                                <?php endif; ?>
                                <?php if ( get_theme_mod( 'tw_show' ) ) : ?>
                                    <a class="soc_link" href="<?php echo get_theme_mod( 'tw_link', 'filler' ); ?>" target="_blank"><i class="fa-twitter fab"></i></a>
                                <?php endif; ?>
                                <?php if ( get_theme_mod( 'insta_show' ) ) : ?>
                                    <a class="soc_link" href="<?php echo get_theme_mod( 'insta_link', 'filler' ); ?>" target="_blank"><i class="fa-instagram fab"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="contact_info">
                            <div class="company_name">
                                <h3><?php _e( 'Company Name', 'tb_theme' ); ?></h3>
                                <div class="name">
                                    <?php echo get_theme_mod( 'contact_info_company_name', __( 'Tecnoideal America', 'tb_theme' ) ); ?>
                                </div>
                            </div>
                            <h2><?php _e( 'Address', 'tb_theme' ); ?></h2>
                            <div class="address">
                                <?php echo get_theme_mod( 'contact_info_address1', __( '7600 Standish Place', 'tb_theme' ) ); ?>
                            </div>
                            <div class="address">
                                <?php echo get_theme_mod( 'contact_info_address2', __( 'Suite', 'tb_theme' ) ); ?>
                            </div>
                            <div class="address">
                                <?php echo get_theme_mod( 'contact_info_city', __( 'Rockville', 'tb_theme' ) ); ?>
                            </div>
                            <div class="address">
                                <?php echo get_theme_mod( 'contact_info_state', __( 'Maryland', 'tb_theme' ) ); ?>
                            </div>
                            <div class="address">
                                <?php echo get_theme_mod( 'contact_info_zipcode', __( '20855', 'tb_theme' ) ); ?>
                            </div>
                            <div class="email">
                                <h3><?php _e( 'Email', 'tb_theme' ); ?></h3>
                                <div class="email">
                                    <a href="<?php echo get_theme_mod( 'contact_info_email_link', 'mailto:' ); ?>"><?php echo get_theme_mod( 'contact_info_email', __( 'info@tecnoidealamerica.com', 'tb_theme' ) ); ?></a>
                                </div>
                            </div>
                            <div class="phone">
                                <h3><?php _e( 'Phone', 'tb_theme' ); ?></h3>
                                <div class="phone">
                                    <?php echo get_theme_mod( 'contact_info_phone', '(555) 403 4063' ); ?>
                                </div>
                                <div class="phone">
                                    <?php echo get_theme_mod( 'contact_info_phone_link', __( 'tel:5554034063', 'tb_theme' ) ); ?>
                                </div>
                            </div>
                            <div class="hours">
                                <h3><?php _e( 'Hours', 'tb_theme' ); ?></h3>
                                <div class="hours">
                                    <?php echo get_theme_mod( 'contact_info_hours', __( 'M-F: 9am - 5pm', 'tb_theme' ) ); ?>
                                </div>
                            </div>
                        </div>
                        <h3 class="bg-warning"><?php _e( 'Footer Component', 'tb_theme' ); ?></h3>
                        <footer id="jr_wrapper_footer"> 
                            <div class="bg-gray-med-dark container text-white"> 
                                <div class="pb-2 pt-2 row"> 
                                    <div class="col-lg-4"> 
                                        <img id="jr_foot_logo" src="<?php echo get_template_directory_uri(); ?>/a_images/Generation-Thrive-Logo-High-Res.png" alt="Gen:Thrive Footer Logo"/> 
                                        <p class="about"><?php _e( 'Gen:Thrive is a collaborative initiative to accelerate sustainability and environmental education programs in K&ndash;12 schools.&nbsp;', 'tb_theme' ); ?></p> 
                                    </div>                                     
                                    <div class="col-lg-4 mb-1 mb-lg-0"> 
                                        <div id="footLinks"> 
                                            <div class="title">
                                                <?php _e( 'Featured', 'tb_theme' ); ?>
                                            </div>                                             
                                            <?php if ( has_nav_menu( 'footer' ) ) : ?>
                                                <?php
                                                    PG_Smart_Walker_Nav_Menu::$options['template'] = '<li id="{ID}" class="{CLASSES}"> <a {ATTRS}>{TITLE}</a> 
                                                                                                    </li>';
                                                    wp_nav_menu( array(
                                                        'container' => '',
                                                        'theme_location' => 'footer',
                                                        'items_wrap' => '<ul class="%2$s footMenu" id="%1$s">%3$s</ul>',
                                                        'walker' => new PG_Smart_Walker_Nav_Menu()
                                                ) ); ?>
                                            <?php endif; ?> 
                                        </div>                                         
                                    </div>                                     
                                    <div class="col-lg-4 mb-1 mb-lg-0"> 
                                        <div class="text-secondary title">
                                            <?php _e( 'Gen:Thrive is a program of&nbsp;', 'tb_theme' ); ?>
                                        </div>                                         
                                        <div class="address"> 
                                            <div class="font-weight-bold">
                                                <?php _e( 'EcoRise', 'tb_theme' ); ?>
                                            </div>                                             <a href="https://www.google.com/url?q=https://www.google.com/maps/place/EcoRise/@30.2674947,-97.6952531,17z/data%3D!3m1!4b1!4m5!3m4!1s0x8644b680072295ab:0x7f22e68581468d77!8m2!3d30.2674947!4d-9&amp;sa=D&amp;source=docs&amp;ust=1645037862434769&amp;usg=AOvVaw0hHCSpfbpfSNrNOah5voH9" target="_blank"><?php _e( 'PO Box 152942', 'tb_theme' ); ?> <br/><?php _e( 'Austin, TX 78715', 'tb_theme' ); ?></a> <br/> <a href="https://www.ecorise.org/"><?php _e( 'www.ecorise.org', 'tb_theme' ); ?></a> <br/> 
                                        </div>                                         
                                        <div id="copyRight">&copy; 
                                            <?php echo date('Y'); ?> 
                                            <?php _e( 'EcoRise. All Rights Reserved.', 'tb_theme' ); ?>
                                            <p><a href="/privacy-policy"><?php _e( 'Privacy Policy', 'tb_theme' ); ?></a> | <a href="/terms-of-use"><?php _e( 'Terms of Use', 'tb_theme' ); ?></a></p>
                                        </div>                                         
                                    </div>                                     
                                </div>                                 
                            </div>                             
                            <!-- container end -->                             
                        </footer>
                    </div>
                </div>                

<?php get_footer(); ?>