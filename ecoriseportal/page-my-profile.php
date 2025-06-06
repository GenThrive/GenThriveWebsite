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
                <?php 
                    $myPid = get_current_user_id();
                    $parentProviderID = types_render_usermeta( 'user-s-partner-org-id', array( 'user_current' => 'true' ) ); 
                    $parentProviderID = ( !empty($parentProviderID) ) ? $parentProviderID : 0;
                    $serviceProviderID = types_render_usermeta( 'user-s-service-provider-id', array( 'user_current' => 'true' ) );
                    $serviceProviderID = ( !empty($serviceProviderID) ) ? $serviceProviderID : 0;
                ?>
                <div class="container">
                    <?php if ( !is_user_logged_in() ) : ?>
                        <div class="alert alert-primary">
                            <?php _e( 'You must be logged in to access this page. Please log in below.', 'tb_theme' ); ?> <a href="<?php echo esc_url( wp_lostpassword_url( get_site_url().'/my-profile/' ) ); ?>"><?php _e( 'Forgot Password?', 'tb_theme' ); ?></a>
                        </div>
                    <?php elseif ( ( current_user_can('administrator') || current_user_can('partner') || current_user_can('partner_contributor') || current_user_can('service_provider_admin') || current_user_can('service_provider_contributor') ) ) : ?>
                        <?php
                            $user_data = get_userdata( $myPid );
                            $user_email = $user_data->user_email;
                            $user_first_name = get_user_meta( $myPid, 'first_name', true );
                            $user_last_name = get_user_meta( $myPid, 'last_name', true );
                            $user_last_name = get_user_meta( $myPid, 'email', true );
                            $user_preferred_email = get_user_meta( $myPid, 'wpcf-user_preferred_email', true );
                            $user_phone = get_user_meta( $myPid, 'wpcf-user_phone', true );
                            $user_preferred_phone = get_user_meta( $myPid, 'wpcf-user_preferred_phone', true );
                        ?>
                        <div class="row bg-secondary text-white mb-2 rounded-sm py-2 px-1">
                            <div class="col-lg-4">
                                <div class="h3">
                                    <?php _e( 'My Info', 'tb_theme' ); ?>
                                </div>
                                <div id="name"><span><?php echo $user_first_name; ?></span> <span><?php echo $user_last_name; ?></span>
                                </div>
                                <div id="email"><span class="mr-quarter"><?php echo $user_email; ?></span><span><?php echo '('.$user_preferred_email.')'; ?></span>
                                </div>
                                <?php if ($user_phone) : ?>
                                    <div id="phone"><span class="mr-quarter"><?php echo $user_phone; ?></span><span><?php echo '('.$user_preferred_phone.')'; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-8 d-flex">
                                <div class="d-flex align-items-center justify-content-end flex-grow-1">
                                    <a href="#popmake-617" class="btn btn-outline-white mr-1"><?php _e( 'Edit Profile', 'tb_theme' ); ?></a>
                                    <a href="#popmake-1783" class="btn btn-outline-white mr-1"><?php _e( 'Change Password', 'tb_theme' ); ?></a>
                                    <div id="logInOrOut" class="btn btn-outline-white">
                                        <?php wp_loginout( get_site_url().'/my-profile/', true ); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ( is_user_logged_in() && ( current_user_can('administrator') || current_user_can('service_provider_admin') || current_user_can('service_provider_contributor')) ) : ?>
                        <?php echo render_view_template( 29377, $serviceProviderID );?>
                        <div class="align-items-center d-flex justify-content-between">
                            <h3 class="text-black"><?php echo esc_html( get_the_title($serviceProviderID) ); ?><span><?php _e( '&nbsp;Users', 'tb_theme' ); ?></span></h3>
                            <button class="mr-quarter btn mr-half btn-outline-primary" type="button" data-toggle="modal" data-target="#inviteSP" aria-expanded="false">
                                <?php _e( 'Invite User', 'tb_theme' ); ?>
                            </button>
                        </div>
                        <p class="mt-1"><?php _e( 'Now that you have successfully created a Service Provider profile, you can invite others in your organization to add, edit, and delete information by clicking the "Invite User" button.', 'tb_theme' ); ?></p> 
                        <!-- Modal for service provider invite-->
                        <div class="modal fade formModal" id="inviteSP" tabindex="-1" aria-labelledby="inviteSPLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg modal-xg">
                                <div class="modal-content rounded-0">
                                <div class="modal-header">
                                    <h5 class="modal-title text-black" id="inviteSPLabel">Invite Service Provider Contributor</h5>
                                    <button type="button" class="close-formModal" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php gravity_form( 16, false, false, false, array('partnerID' => $parentProviderID, 'servicePid' => $serviceProviderID), true, null, true ); ?>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div>                
                            <?php echo render_view(array( 'name' => 'partner-users-of-service-provider-child-view', 'ofservicep' => $serviceProviderID ));?>
                        </div>
                    <?php endif; ?>
                    <?php if ( is_user_logged_in() && ( current_user_can('administrator') || current_user_can('partner') || current_user_can('partner_contributor')) ) : ?>
                        <ul class="mb-1 nav nav-tabs" id="detailsTab" role="tablist">                                         
                            <li class="nav-item"> <a class="nav-link active" id="serveP-tab" data-toggle="tab" href="#serveP" role="tab" aria-controls="serveP" aria-selected="false"><?php _e( 'Service Providers', 'tb_theme' ); ?></a> 
                            </li>
                            <li class="nav-item"> <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false"><?php _e( 'Users', 'tb_theme' ); ?></a> 
                            </li>
                            <li class="nav-item"> <a class="nav-link" id="communications-tab" data-toggle="tab" href="#comunications" role="tab" aria-controls="comunications" aria-selected="true"><?php _e( 'Communications', 'tb_theme' ); ?></a> 
                            </li>
                        </ul>
                        <div class="tab-content" id="progDetails"> 
                            <div class="tab-pane fade show active" id="serveP" role="tabpanel" aria-labelledby="serveP-tab">
                                <div id="partnerInfo">
                                    <div>
                                        <div>
                                            <div class="h3"> <span><?php _e( 'Service Providers of', 'tb_theme' ); ?> </span> 
                                                <?php echo esc_html( get_the_title($parentProviderID) ); ?> 
                                            </div>
                                            <div class="mb-2">
                                                <?php echo render_view(array( 'name' => 'partner-user-list-of-service-providers', 'wpvrelatedto' => $parentProviderID)); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                             
                            </div>
                            <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                                <div class="row">
                                    <div class="col-12 pt-2">
                                        <div class="mb-2">
                                            <div class="align-items-center d-flex justify-content-between">
                                                <h3 class="text-black"><?php echo esc_html( get_the_title($parentProviderID) ); ?><span><?php _e( '&nbsp;Users', 'tb_theme' ); ?></span></h3>
                                                <button class="mr-quarter btn mr-half btn-outline-primary" type="button" data-toggle="modal" data-target="#invitePartner" aria-expanded="false">
                                                    <?php _e( 'Invite User', 'tb_theme' ); ?>
                                                </button>
                                            </div>
                                            <p class="mt-1"><?php _e( 'Now that you have successfully created a Partner Organization profile, you can invite others in your organization to add, edit, and delete information by clicking the "Invite User" button.', 'tb_theme' ); ?></p> 
                                            <!-- Modal for partner invite-->
                                            <div class="modal fade formModal" id="invitePartner" tabindex="-1" aria-labelledby="invitePartnerLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg modal-xg">
                                                <div class="modal-content rounded-0">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-black" id="invitePartnerLabel">Invite Partners</h5>
                                                    <button type="button" class="close-formModal" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php gravity_form( 17, false, false, false, array('partnerID' => $parentProviderID, 'servicePid' => $serviceProviderID), true, null, true ); ?>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div>
                                                <?php echo render_view(array( 'name' => 'partners-own-users', 'ofparentself' => $parentProviderID )); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                             
                            </div>
                            <div class="tab-pane fade" id="comunications" role="tabpanel" aria-labelledby="comunications-tab">
                                <div> 
                                    <div> 
                                        <div class="h3"> <span><?php _e( 'Email Service Provider Admins', 'tb_theme' );  ?></span></div>                                                             
                                        <?php 
                                            if($parentProviderID){
                                                $not_started = render_view(array( 'name' => 'email-all-sp-in-x-status', 'mypartner'=>$parentProviderID, 'accstatus'=>'0'));
                                                $not_started = preg_replace("/\s+/", "", $not_started);
                                                $in_progress= render_view(array( 'name' => 'email-all-sp-in-x-status', 'mypartner'=>$parentProviderID, 'accstatus'=>'1'));
                                                $in_progress = preg_replace("/\s+/", "", $in_progress);
                                                $complete= render_view(array( 'name' => 'email-all-sp-in-x-status', 'mypartner'=>$parentProviderID, 'accstatus'=>'2'));
                                                $complete = preg_replace("/\s+/", "", $complete);
                                                gravity_form( 23, false, false, false, array('completed' => $complete, 'in_progress' => $in_progress, 'not_started' => $not_started), true);
                                            } 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal for Deleting User-->
                        <div class="modal fade formModal" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-0">
                            <div class="modal-header">
                                <h5 class="modal-title text-black" id="deleteUserLabel">Are you sure you want to remove this user from this account?</h5>
                                <button type="button" class="close-formModal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php gravity_form(15, false, false, false, null, true, null, true); ?>
                            </div>
                            </div>
                        </div>
                        </div>
                        <!-- Modal for Edit User-->
                        <div class="modal fade formModal" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg modal-xl">
                            <div class="modal-content rounded-0">
                            <div class="modal-header">
                                <h5 class="modal-title text-black" id="editUserLabel">Edit User Info</h5>
                                <button type="button" class="close-formModal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php gravity_form(14, false, false, false, null, true, null, true); ?>
                            </div>
                            </div>
                        </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>                

<?php  get_footer( 'a-master' ); ?>