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
                                <div id="email"><span class="mr-quarter"><?php echo $user_email; ?></span><span><?php echo (!empty($user_preferred_email)) ? '('.$user_preferred_email.')' : ''; ?></span>
                                </div>
                                <?php if ($user_phone) : ?>
                                    <div id="phone"><span class="mr-quarter"><?php echo $user_phone; ?></span><span><?php echo (!empty($user_preferred_phone)) ? '('.$user_preferred_phone.')' : ''; ?></span>
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
                            <li class="nav-item"> <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false"><?php _e( 'Collaborators', 'tb_theme' ); ?></a> 
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
                                                    <?php _e( 'Invite Collaborator', 'tb_theme' ); ?>
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
                                            

                                            // Your main code block
                                            if ($parentProviderID) {
                                                // Query for 'Not Started' (accstatus = 0)
                                                $args_not_started = array(
                                                    'post_type'  => array('partner-organization', 'service-provider'),
                                                    'meta_query' => array(
                                                        array(
                                                            'key'   => 'wpcf-onboarding_account_status',
                                                            'value' => '0',
                                                        ),
                                                    ),
                                                    'fields'     => 'ids', // Get only post IDs
                                                    'posts_per_page' => -1, // Get all matching posts
                                                );
                                                $query_not_started = new WP_Query($args_not_started);
                                                $not_started_ids = implode(',', $query_not_started->posts);
                                                // The previous count ($query_not_started->found_posts) is the count of posts,
                                                // which you decided not to use for the final count displayed.
                                                // $not_started_post_count = $query_not_started->found_posts;


                                                // Query for 'In Progress' (accstatus = 1)
                                                $args_in_progress = array(
                                                    'post_type'  => array('partner-organization', 'service-provider'),
                                                    'meta_query' => array(
                                                        array(
                                                            'key'   => 'wpcf-onboarding_account_status',
                                                            'value' => '1',
                                                        ),
                                                    ),
                                                    'fields'     => 'ids',
                                                    'posts_per_page' => -1,
                                                );
                                                $query_in_progress = new WP_Query($args_in_progress);
                                                $in_progress_ids = implode(',', $query_in_progress->posts);
                                                // $in_progress_post_count = $query_in_progress->found_posts;


                                                // Query for 'Complete' (accstatus = 2)
                                                $args_complete = array(
                                                    'post_type'  => array('partner-organization', 'service-provider'),
                                                    'meta_query' => array(
                                                        array(
                                                            'key'   => 'wpcf-onboarding_account_status',
                                                            'value' => '2',
                                                        ),
                                                    ),
                                                    'fields'     => 'ids',
                                                    'posts_per_page' => -1,
                                                );
                                                $query_complete = new WP_Query($args_complete);
                                                $complete_ids = implode(',', $query_complete->posts);
                                                // $complete_post_count = $query_complete->found_posts;


                                                // Now, get the user emails and their counts using the helper function
                                                $not_started_data = get_users_by_service_provider_ids($not_started_ids);
                                                $not_started_emails = implode(',', $not_started_data['emails']);
                                                $not_started_count = $not_started_data['count'];

                                                $in_progress_data = get_users_by_service_provider_ids($in_progress_ids);
                                                $in_progress_emails = implode(',', $in_progress_data['emails']);
                                                $in_progress_count = $in_progress_data['count'];

                                                $complete_data = get_users_by_service_provider_ids($complete_ids);
                                                $complete_emails = implode(',', $complete_data['emails']);
                                                $complete_count = $complete_data['count'];



                                                // Pass the IDs (as before) and the new email counts to gravity_form
                                                gravity_form(23, false, false, false, array(
                                                    'completed'   => $complete_emails, // Changed to emails string for consistency with old output
                                                    'in_progress' => $in_progress_emails, // Changed to emails string for consistency with old output
                                                    'not_started' => $not_started_emails, // Changed to emails string for consistency with old output
                                                ), true);

                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
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
                </div>
            </div>
        </div>
    </div>
</div>                

<?php  get_footer( 'a-master' ); ?>