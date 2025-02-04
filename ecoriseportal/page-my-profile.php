<?php get_header( 'a-master' ); 

?>
    
<div id="page-wrapper" class="a_jr_pad_md wrapper">
    <div id="content" tabindex="-1">
        <div class="content-area" id="primary">
            <div id="main-content">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php PG_Helper::rememberShownPost(); ?>
                        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    <?php endwhile;?>
                <?php else : ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.', 'tb_theme' ); ?></p>
                <?php endif; ?>
                <?php $myPid = get_current_user_id(); ?>
                <?php $parentProviderID = (types_render_usermeta( 'user-s-partner-org-id', array( 'user_current' => 'true' ) )); ?>
                <?php $serviceProviderID = (types_render_usermeta( 'user-s-service-provider-id', array( 'user_current' => 'true' ) )); ?>
                <div class="container">
                    <?php if ( !is_user_logged_in() ) : ?>
                        <div class="alert alert-primary">
                            <?php _e( 'You must be logged in to access this page. Please log in below.', 'tb_theme' ); ?> <a )" href="<?php echo esc_url( wp_lostpassword_url( get_site_url().'/my-profile/' ) ); ?>"><?php _e( 'Forgot Password?', 'tb_theme' ); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if ( is_user_logged_in() && current_user_can('administrator') || current_user_can('partner') || current_user_can('partner_contributor')  ) : ?>
                        <ul class="mb-1 nav nav-tabs" id="detailsTab" role="tablist"> 
                            <li class="nav-item"> <a class="nav-link active" id="myDetails-tab" data-toggle="tab" href="#myDetails" role="tab" aria-controls="myDetails" aria-selected="true"><?php _e( 'Details', 'tb_theme' ); ?></a> 
                            </li>                                             
                            <li class="nav-item"> <a class="nav-link" id="serveP-tab" data-toggle="tab" href="#serveP" role="tab" aria-controls="serveP" aria-selected="false"><?php _e( 'Service Providers', 'tb_theme' ); ?></a> 
                            </li>
                            <li class="nav-item"> <span class="edit-link text-success nav-link"><a href="<?php echo get_site_url(); ?>/my-inbox/"><?php _e( 'Notifications', 'tb_theme' ); ?></a></span> 
                            </li>
                            <li class="nav-item"> <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false"><?php _e( 'Email', 'tb_theme' ); ?></a> 
                            </li>
                            <li class="nav-item"> <a class="nav-link" id="acsetting-tab" data-toggle="tab" href="#acsetting" role="tab" aria-controls="acsetting" aria-selected="false"><?php _e( 'Account Settings', 'tb_theme' ); ?></a> 
                            </li>                                             
                        </ul>
                    <?php endif; ?>
                    <div class="tab-content" id="progDetails"> 
                        <div class="tab-pane fade show active" id="myDetails" role="tabpanel" aria-labelledby="myDetails-tab">
                            <div class="row">
                                <div id="myInfo" class="col-md-8">
                                    <?php if ( is_user_logged_in() ) : ?>
                                        <div>
                                            <div class="h3">
                                                <?php _e( 'My Info', 'tb_theme' ); ?>
                                            </div>
                                            <div id="name"><span><?php echo do_shortcode('[wpv-user field="user_firstname"]'); ?></span> <span><?php echo do_shortcode('[wpv-user field="user_lastname"]'); ?></span>
                                            </div>
                                            <div id="email"><span id="email" class="mr-1"><?php echo do_shortcode('[wpv-user field="user_email"]'); ?></span><span id="email"><?php echo do_shortcode('[wpv-user field="user_preferred_email"]'); ?></span>
                                            </div>
                                            <div id="phone" class="mb-1"><span id="email" class="mr-1"><?php echo do_shortcode('[wpv-user field="user_phone"]'); ?></span><span id="email"><?php echo do_shortcode('[wpv-user field="user_preferred_phone"]'); ?></span>
                                            </div>
                                            <div id="myLinks"><a href="#popmake-617" class="btn btn-outline-primary mr-1"><?php _e( 'Edit Profile', 'tb_theme' ); ?></a> <a href="#popmake-1783" class="btn btn-outline-primary mr-1"><?php _e( 'Change Password', 'tb_theme' ); ?></a>
                                                <a href="<?php echo get_site_url(); ?>/my-inbox/" class="btn btn-outline-primary mr-1"><?php _e( 'My Inbox', 'tb_theme' ); ?></a>
                                                <div id="logInOrOut" class="btn btn-outline-primary">
                                                    <?php wp_loginout( get_site_url().'/my-profile/', true ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( !is_user_logged_in() ) : ?>
                                        <div id="profileLogin">
                                            <div class="h3 mb-1 text-center">
                                                <?php _e( 'Log In To Your Profile', 'tb_theme' ); ?>
                                            </div>
                                            <?php wp_login_form( array(
                                                    'redirect' => get_site_url().'/my-profile/',
                                                    'remember' => true,
                                                    'value_remember' => false
                                            )); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if ( is_user_logged_in() ) : ?>
                                    <div class="col-12 pt-2">
                                        <?php if ( !current_user_can('partner') && !current_user_can('partner_contributor') ) : ?>
                                            <div>
                                                <div class="h3">
                                                    <?php _e( 'My&nbsp;Organization', 'tb_theme' ); ?>
                                                </div>
                                                <div class="mb-2">
                                                    <?php echo render_view(array( 'name' => 'user-service-providers', 'userid' => '$myPid')); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ( current_user_can('administrator') || current_user_can('partner') || current_user_can('partner_contributor') ) : ?>
                                            <div class="mb-2">
                                                <div class="align-items-center d-flex justify-content-between">
                                                    <h3><?php echo esc_html( get_the_title($parentProviderID) ); ?><span><?php _e( '&nbsp;Users', 'tb_theme' ); ?></span></h3>
                                                    <button class="mr-quarter btn mr-half btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapse-partnerinvite" aria-expanded="false" aria-controls="collapse-partnerinvite">
                                                        <?php _e( 'Invite User', 'tb_theme' ); ?>
                                                    </button>
                                                </div>
                                                <p class="mt-1"><?php _e( 'Now that you have successfully created a Partner Organization profile, you can invite others in your organization to add, edit, and delete information by clicking the "Invite User" button.', 'tb_theme' ); ?></p> 
                                                <div class="collapse mb-1 pt-1" id="collapse-partnerinvite">
                                                    <?php gravity_form( 17, false, false, false, array('partnerID' => $parentProviderID, 'servicePid' => $serviceProviderID), true, null, true ); ?>
                                                </div>
                                                <div>
                                                    <?php echo render_view(array( 'name' => 'partners-own-users', 'ofparentself' => $parentProviderID )); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ( !current_user_can('partner') && !current_user_can('partner_contributor') ) : ?>
                                            <div> 
                                                <div class="align-items-center d-flex justify-content-between">
                                                    <h3><span><?php _e( 'Other&nbsp;', 'tb_theme' ); ?></span><?php echo esc_html( get_the_title($serviceProviderID) ); ?><span><?php _e( '&nbsp;Users', 'tb_theme' ); ?></span></h3>
                                                    <button class="mr-quarter btn mr-half btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapse-userinvite" aria-expanded="false" aria-controls="collapse-userinvite">
                                                        <?php _e( 'Invite User', 'tb_theme' ); ?>
                                                    </button>
                                                </div>
                                                <p class="mt-1"><?php _e( 'Now that you have successfully created a Partner Organization profile, you can invite others in your organization to add, edit, and delete information by clicking the "Invite User" button.', 'tb_theme' ); ?></p> 
                                                <div class="collapse mb-1 pt-1" id="collapse-userinvite">
                                                    <?php gravity_form( 16, false, false, false, array('partnerID' => $parentProviderID, 'servicePid' => $serviceProviderID), true, null, true ); ?>
                                                </div>
                                                <div>
                                                    <?php echo render_view(array( 'name' => 'partner-users-of-service-provider-child-view', 'ofservicep' => $serviceProviderID )); ?>
                                                </div>                                                                 
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>                                             
                        </div>
                        <div class="tab-pane fade" id="serveP" role="tabpanel" aria-labelledby="serveP-tab">
                            <div id="partnerInfo">
                                <?php if ( is_user_logged_in() ) : ?>
                                    <div>
                                        <?php if ( current_user_can('administrator') || current_user_can('partner') || current_user_can('partner_contributor') ) : ?>
                                            <div>
                                                <div class="h3"> <span><?php _e( 'Service Providers of', 'tb_theme' ); ?> </span> 
                                                    <?php echo esc_html( get_the_title($parentProviderID) ); ?> 
                                                </div>
                                                <div class="mb-2">
                                                    <?php echo render_view(array( 'name' => 'partner-user-list-of-service-providers', 'wpvrelatedto' => $parentProviderID)); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>                                             
                        </div>
                        <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                            <?php if ( is_user_logged_in() ) : ?>
                                <div> 
                                    <?php if ( current_user_can('administrator') || current_user_can('partner') || current_user_can('partner_contributor') ) : ?>
                                        <div> 
                                            <div class="h3"> <span><?php _e( 'Email Service Provider Admins', 'tb_theme' );  ?></span> 
                                            </div>                                                             
                                            <?php 
                                              if($parentProviderID){
                                                $not_started = render_view(array( 'name' => 'email-all-sp-in-x-status', 'mypartner'=>$parentProviderID, 'accstatus'=>'0'));
                                               
                                             ?>
                                            <?php $in_progress= render_view(array( 'name' => 'email-all-sp-in-x-status', 'mypartner'=>$parentProviderID, 'accstatus'=>'1')); ?>
                                            <?php $complete= render_view(array( 'name' => 'email-all-sp-in-x-status', 'mypartner'=>$parentProviderID, 'accstatus'=>'2'));  ?>
                                            <?php $complete = preg_replace("/\s+/", "", $complete);$in_progress = preg_replace("/\s+/", "", $in_progress);$not_started = preg_replace("/\s+/", "", $not_started); ?>
                                            <?php gravity_form( 23, false, false, false, array('completed' => $complete, 'in_progress' => $in_progress, 'not_started' => $not_started), true);
                                             } ?>
                                        </div>
                                    <?php endif;  ?> 
                                </div>
                            <?php endif; ?> 
                        </div>
                        <div class="tab-pane fade" id="acsetting" role="tabpanel" aria-labelledby="acsetting-tab">
                            <?php if ( is_user_logged_in() ) : ?>
                                <div> 
                                    <?php if ( current_user_can('administrator') || current_user_can('partner') || current_user_can('partner_contributor') ) : ?>
                                        <div> 
                                            <div class="row">
                                                <div class="col-md-6"> 
                                                    <h3><?php _e( 'Update Account Banner Image', 'tb_theme' ); ?></h3>
                                                    <?php if ( has_post_thumbnail( $serviceProviderID ) ) : ?>
                                                        <?php echo get_the_post_thumbnail( $serviceProviderID, 'medium' ); ?>
                                                    <?php endif; ?>
                                                    <?php echo cred_form(6516,$serviceProviderID); ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <h3><?php _e( 'Default Approver for Company', 'tb_theme' ); ?></h3>
                                                    <?php gravity_form( 20, false, false, false, '', false ); ?> 
                                                </div>
                                            </div>                                                             
                                        </div>
                                    <?php endif; ?> 
                                </div>
                            <?php endif; ?> 
                        </div>                                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>                

<?php  get_footer( 'a-master' ); ?>