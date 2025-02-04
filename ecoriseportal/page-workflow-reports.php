<?php get_header( 'a-master' ); ?>

<div id="page-wrapper" class="a_jr_pad_md wrapper">
    <div id="content" tabindex="-1">
        <div class="content-area" id="primary">
            <div id="main-content">
                <?php $myPid = get_current_user_id(); ?>
                <?php $parentProviderID = (types_render_usermeta( 'user-s-partner-org-id', array( 'user_current' => 'true' ) )); ?>
                <?php $serviceProviderID = (types_render_usermeta( 'user-s-service-provider-id', array( 'user_current' => 'true' ) )); ?>
                <div class="container">
                    <?php if ( !is_user_logged_in() ) : ?>
                        <div class="alert alert-primary">
                            <?php _e( 'You must be logged in to access this page. Please&nbsp;', 'tb_theme' ); ?>
                            <a href="<?php echo get_site_url(); ?>/my-profile/"><?php _e( 'Log In', 'tb_theme' ); ?></a>. <a )"="" href="<?php echo esc_url( wp_lostpassword_url( get_site_url().'/my-profile/' ) ); ?>"><?php _e( 'Forgot Password?', 'tb_theme' ); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if ( is_user_logged_in() && current_user_can('administrator') || current_user_can('partner') || current_user_can('partner_contributor')  ) : ?>
                        <ul class="mb-1 nav nav-tabs" id="detailsTab" role="tablist"> 
                            <li class="nav-item"> <a class="nav-link" href="<?php echo get_site_url(); ?>/my-profile/?tab=myDetails"><?php _e( 'Details', 'tb_theme' ); ?></a>
                            </li>                                             
                            <li class="nav-item"> <a class="nav-link" href="<?php echo get_site_url(); ?>/my-profile/?tab=serveP"><?php _e( 'Service Providers', 'tb_theme' ); ?></a> 
                            </li>
                            <li class="nav-item"> <span class="edit-link text-success nav-link"><a href="<?php echo get_site_url(); ?>/my-inbox/"><?php _e( 'Notifications', 'tb_theme' ); ?></a></span> 
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="<?php echo get_site_url(); ?>/my-profile/?tab=users"><?php _e( 'Email', 'tb_theme' ); ?></a> 
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="<?php echo get_site_url(); ?>/my-profile/?tab=acsetting"><?php _e( 'Account Settings', 'tb_theme' ); ?></a> 
                            </li>
                            <li class="nav-item"> <span class="edit-link text-success nav-link active"><a href="<?php echo get_site_url(); ?>/workflow-reports/"><?php _e( 'Workflow Reports', 'tb_theme' ); ?></a></span> 
                            </li>                                                     
                        </ul>
                    <?php endif; ?>
                </div>
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php PG_Helper::rememberShownPost(); ?>
                        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.', 'tb_theme' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>                

<?php get_footer( 'a-master' ); ?>