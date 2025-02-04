<?php get_header( 'a-master' ); ?>

                <div class="a_jr_pad_md wrapper" id="single-wrapper">
                    <div id="content" tabindex="-1">
                        <div class="content-area" id="primary">
                            <div id="main-content">
                                <div>
                                    <?php if ( have_posts() ) : ?>
                                        <?php while ( have_posts() ) : the_post(); ?>
                                            <?php PG_Helper::rememberShownPost(); ?>
                                            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                                <header class="container entry-header">
                                                    <h1 class="mb-2 text-center"><span><?php _e( 'Welcome&nbsp;', 'tb_theme' ); ?></span><span><?php //the_title(); ?></span><span><?php _e( 'Service Providers', 'tb_theme' ); ?></span></h1>
                                                    <?php if ( has_excerpt() ) : ?>
                                                        <div class="mb-2 text-center">
                                                            <?php echo get_the_excerpt(); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="pRegRow row shadow">
                                                        <div class="col-md-6 text-center"><a class="btn btn-lg btn-primary pl-3 pl-md-5 popmake-1716 pr-3 pr-md-5" href="filler"><?php _e( 'Register With Code', 'tb_theme' ); ?></a>
                                                        </div>
                                                        <div class="col-md-6 text-center"><a class="btn btn-info btn-lg pl-3 pl-md-5 pr-3 pr-md-5" href="<?php echo get_site_url(); ?>/login"><?php _e( 'Log In', 'tb_theme' ); ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2 row align-items-start">
                                                        <div class="col-lg-4 mb-2 mb-lg-0">
                                                            <div class="leftBarWrapper mb-2">
                                                                <div class="pTitleWrapper">
                                                                    <?php echo (types_render_field( 'partner-logo', array( ) )); ?>
                                                                    <h2 class="flex-grow-1 mb-0"><?php the_title(); ?></h2>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <?php echo (types_render_field( 'brief-partner-bio', array( ) )); ?>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-sm-6">
                                                                        <div id="Paddress" class="mb-1">
                                                                            <div>
                                                                                <?php echo (types_render_field( 'org_billingstreet', array( ) )); ?>
                                                                            </div>
                                                                            <div id="citStZip"> <span class="mr-quarter"><?php echo (types_render_field( 'org_billingcity', array( ) )); ?></span>
                                                                                <span class="mr-quarter"><span><?php echo (types_render_field( 'org_billingstate', array( ) )); ?></span>,</span>
                                                                                <span><?php echo (types_render_field( 'org_billingzippostalcode', array( ) )); ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 col-sm-6"><a href="<?php echo esc_url( (types_render_field( 'org_website', array( 'output' => 'raw' ) )) ); ?>" class="font-weight-bold"><?php _e( 'Our Website', 'tb_theme' ); ?></a>
                                                                        <div>
                                                                            <?php echo (types_render_field( 'org_email', array( ) )); ?>
                                                                        </div>
                                                                        <div>
                                                                            <?php echo (types_render_field( 'org_phone', array( ) )); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="leftBarWrapper mb-2">
                                                                <div class="pTitleWrapper">
                                                                    <img alt="Gen:Thrive Logo" src="<?php echo get_template_directory_uri(); ?>/a_images/Generation-Thrive-ICON-Color-High-Res.png"/>
                                                                    <h2 class="flex-grow-1 mb-0"><?php _e( 'Gen:Thrive', 'tb_theme' ); ?></h2>
                                                                </div>
                                                                <?php if ( is_active_sidebar( 'gthrive_single_p' ) ) : ?>
                                                                    <div>
                                                                        <?php dynamic_sidebar( 'gthrive_single_p' ); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="pOverviewWrapper">
                                                                <?php echo (types_render_field( 'project-overview', array( ) )); ?>
                                                                <div class="entry-content">
                                                                    <?php the_content(); ?>
                                                                </div>
                                                            </div>
															<div class="pOverviewSearch">
																<h2>Is your organization in our directory?</h2>
																<p>Search our directory to find your organization.</p> 
																<?php echo do_shortcode('[spsearchbox]'); ?>

																<p><strong>Find your organization?</strong> Your Partner Organization should have sent you an Invitation Code.  Click the red "Register" button to begin the registration process.  If you do not have any invitation code, <a href="/contact-us/">contact us</a> to receive your code.</p>

<!-- 																<p><strong>Didn't find your organization?</strong> You can <a href="/genthrive-service-provider-registration/?partner_id=<?php echo get_the_ID(); ?>">create a new listing here</a>.</p> -->
															</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4 order-6 order-lg-first">
</div>
                                                        <div class="col-lg-8 mb-2 mb-lg-0">
</div>
                                                    </div>
                                                </header>
                                                <?php wp_link_pages( array() ); ?>
                                                <footer class="container entry-footer">
                                                    <?php if ( has_tag() ) : ?>
                                                        <span class="tags-links"><?php the_tags( 'Tags: ', ', ' ); ?></span>
                                                    <?php endif; ?>
                                                    <?php edit_post_link( '<b class="text-success">Edit Post</b>' ); ?>
                                                </footer>
                                            </article>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <p><?php _e( 'Sorry, no posts matched your criteria.', 'tb_theme' ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                

<?php get_footer( 'a-master' ); ?>