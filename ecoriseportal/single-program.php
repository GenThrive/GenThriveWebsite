<?php get_header('a-master'); ?>

<div class="a_jr_pad_md wrapper" id="single-wrapper">
    <div id="content" tabindex="-1">
        <div class="content-area" id="primary">
            <div id="main-content">
                <?php $user_prog_id = types_render_usermeta('user-s-service-provider-id', array('separator' => ',', 'user_current' => 'true')); ?>
                <?php $page_ID = get_the_ID(); ?>
                <?php if (!is_admin() && is_user_logged_in() && !empty($user_prog_id)) {
                    $connected_posts = toolset_get_related_posts(['parent' => [$user_prog_id],         'child' => $page_ID],     'service-provider-program',     ['role_to_return' => 'child']);
                } ?>
                <?php $program_id = get_post(get_the_ID());
                $service_provider_id = toolset_get_related_post($program_id, 'service-provider-program', 'parent');
                $logo_string = get_post_meta($service_provider_id, 'wpcf-organization_logo', true);
                $logo_src = string_between_two_string($logo_string, '["', '"]');
                $website = get_post_meta($service_provider_id, 'wpcf-org_website', true);
                $email = get_post_meta($service_provider_id, 'wpcf-org_email', true);
                $facebook = get_post_meta($service_provider_id, 'wpcf-org_facebook', true);
                $twitter = get_post_meta($service_provider_id, 'wpcf-org_twitter', true);
                $linkedin = get_post_meta($service_provider_id, 'wpcf-org_linkedin', true);
                ?>
                <div class="container">
                    <article>
                        <?php if (!empty($user_prog_id) && is_user_logged_in() && in_array($page_ID, $connected_posts) || current_user_can('administrator') || current_user_can('partner') || current_user_can('partner_contributor')) : ?>
                            <ul class="mb-1 nav nav-tabs" id="detailsTab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" id="pDetails-tab" data-toggle="tab" href="#pDetails" role="tab" aria-controls="pDetails" aria-selected="true"><?php _e('Program Details', 'tb_theme'); ?></a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" id="editP-tab" data-toggle="tab" href="#editP" role="tab" aria-controls="editP" aria-selected="false"><?php _e('Edit Program', 'tb_theme'); ?></a>
                                </li>
                                <?php if (is_user_logged_in() && current_user_can('administrator')) : ?>
                                    <li class="nav-item"> <span class="edit-link text-success nav-link"><?php edit_post_link('<b class="text-success mb-1">Edit Post in WordPress Admin</b>'); ?></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                        <div class="tab-content" id="progDetails">
                            <div class="tab-pane fade show active flex align-items-start justify-content-between" id="pDetails" role="tabpanel" aria-labelledby="pDetails-tab">
                                <div>
                                    <div class="d-flex flex-lg-row align-items-start flex-column pb-2 singleProWrapper">
                                        <?php if ($logo_src) { ?>
                                            <img id="service-logo" src="<?php echo $logo_src ?>" width="150px" height="150px" />
                                        <?php } ?>
                                        <div class="programDetials__wrapper">
                                            <div class="programDetials">
                                                <div class="h3 mb-0">
                                                    <?php the_title(); ?>
                                                </div>
                                                <?php $parentOrg = toolset_get_related_post($page_ID, 'service-provider-program'); ?>
                                                <div class="SPsubTitle mb-half">
                                                    <?php _e('by', 'tb_theme'); ?> <a href="<?php echo get_post_field( 'post_name',($parentOrg)); ?>"><?php echo esc_html(get_the_title($parentOrg)); ?></a>
                                                </div>
                                                <div class="serviceProSocial__wrapper">
                                                    <?php if ($website) { ?>
                                                        <a href="<?php echo $website; ?>" target="_blank" class="serviceProSocial" rel="noopener"><i class="fal fa-globe"></i></a>
                                                    <?php } ?>
                                                    <?php if ($email) { ?>
                                                        <a href="<?php echo 'mailto:' . $email; ?>" target="_blank" class="serviceProSocial" rel="noopener"><i class="fal fa-envelope"></i></a>
                                                    <?php } ?>
                                                    <?php if ($twitter) { ?>
                                                        <a href="<?php echo $twitter; ?>" target="_blank" class="serviceProSocial" rel="noopener"><i class="fab fa-twitter"></i></a>
                                                    <?php } ?>
                                                    <?php if ($facebook) { ?>
                                                        <a href="<?php echo $facebook; ?>" target="_blank" class="serviceProSocial" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                                                    <?php } ?>
                                                    <?php if ($linkedin) { ?>
                                                        <a href="<?php echo $linkedin; ?>" target="_blank" class="serviceProSocial" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php if ((types_render_field('prgm_account_status', array('output' => 'raw'))) != 1) : ?>
                                                <div>
                                                    <?php if ((types_render_field('prgm_status', array('output' => 'raw'))) != 'under_review') : ?>
                                                        <div class="alert alert-primary">
                                                            <b><?php _e('Your Program is not active yet. Please click the &quot;Edit Program&quot; tab above to fill in your program details.', 'tb_theme'); ?></b>
                                                        </div>
                                                    <?php else : ?>
                                                        <div class="alert alert-secondary">
                                                            <b><?php _e('Your Program is under review. After your service provider approves your details will show here.', 'tb_theme'); ?></b>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else : ?>
                                                <div>
                                                    <?php if ((types_render_field('prgm_status', array('output' => 'raw'))) == 'under_review') : ?>
                                                        <div class="alert alert-secondary">
                                                            <b><?php _e('Your newly submitted program details update is under review. After your service provider approves your updated details will show here.', 'tb_theme'); ?></b>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="program__summary"><?php echo (types_render_field('prgm_description', array())); ?></div>
                                                    <?php $termOther = (types_render_field('prgm_themes_other', array('output' => 'raw'))); ?>
                                                    <?php $serviceOther = (types_render_field('prgm_services_other', array('output' => 'raw'))); ?>
                                                    <?php $acaOther = (types_render_field('prgm_standards_other', array('output' => 'raw'))); ?>
                                                    <?php $langOther = (types_render_field('prgm_languages_other', array('output' => 'raw'))); ?>
                                                    <?php $timesOther = (types_render_field('prgm_times_other', array('output' => 'raw'))); ?>
                                                    <table class="table table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row"><img src="/wp-content/uploads/2022/10/icon-1.svg" alt="Offerings" width="50px" height="50px" /><?php _e('Offerings', 'tb_theme'); ?></th>
                                                                <td>
                                                                    <ul class="dotlessUL">
                                                                        <li>
                                                                            <?php echo (types_render_field('prgm_services', array('separator' => ', '))); ?>
																			<?php if ($serviceOther  != "") : ?>
                                                                            <strong>: </strong><strong><?php echo $serviceOther ?></strong>
                                                                        	<?php endif; ?>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row"><img src="/wp-content/uploads/2022/10/icon-2.svg" alt="Audiences" width="50px" height="50px" /><?php _e('Audiences', 'tb_theme'); ?></th>
                                                                <td>
                                                                    <ul class="dotlessUL">
                                                                        <li>
                                                                            <?php echo (types_render_field('prgm_audiences', array('separator' => ', '))); ?>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row"><img src="/wp-content/uploads/2022/10/icon-4.svg" alt="Location" width="50px" height="50px" /><?php _e('Location', 'tb_theme'); ?></th>
                                                                <td>
                                                                    <ul class="dotlessUL">
                                                                        <?php echo (types_render_field('prgm_locations', array('separator' => '</li><li>'))); ?>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row"><img src="/wp-content/uploads/2022/10/icon-5.svg" alt="Timing" width="50px" height="50px" /><?php _e('Timing', 'tb_theme'); ?></th>
                                                                <td>
                                                                    <ul class="dotlessUL">
                                                                        <?php echo (types_render_field('prgm_times', array('separator' => '</li><li>'))); ?>
                                                                        <?php if ($timesOther != "") : ?>
                                                                            <li class="hasOther"><span>: <?php echo $timesOther ?></span>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row"><img src="/wp-content/uploads/2022/10/icon-6.svg" alt="Themes" width="50px" height="50px" /><?php _e('Themes', 'tb_theme'); ?></th>
                                                                <td>
                                                                    <ul class="dotlessUL">
                                                                        <li>
                                                                            <?php echo (types_render_field('prgm_themes', array('separator' => '</li><li>'))); ?>
                                                                        </li>
                                                                        <?php if ($termOther != "") : ?>
                                                                            <li class="hasOther"><span>: <?php echo $termOther ?></span>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row"><img src="/wp-content/uploads/2022/10/icon-7.svg" alt="Academic Alignment" width="50px" height="50px" /><?php _e('Academic Alignment', 'tb_theme'); ?></th>
                                                                <td>
                                                                    <ul class="dotlessUL">
                                                                        <?php echo (types_render_field('prgm_standards', array('separator' => '</li><li>'))); ?>
                                                                        <?php if ($acaOther != "") : ?>
                                                                            <li class="hasOther"><span>: <?php echo $acaOther  ?></span>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row"><img src="/wp-content/uploads/2022/10/icon-8.svg" alt="Languages" width="50px" height="50px" /><?php _e('Languages', 'tb_theme'); ?></th>
                                                                <td>
                                                                    <ul class="dotlessUL">
                                                                        <?php echo (types_render_field('prgm_languages', array('separator' => '</li><li>'))); ?>
                                                                        <?php if ($langOther != "") : ?>
                                                                            <li class="hasOther">
                                                                                <?php echo $langOther  ?>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button onclick="history.back()" class="btn btn-secondary d-block">
                                                        <?php _e('Go Back', 'tb_theme'); ?>
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="editP" role="tabpanel" aria-labelledby="editP-tab">
                                <?php if (is_user_logged_in() && (is_array($connected_posts) && in_array($page_ID, $connected_posts)) || current_user_can('administrator') || current_user_can('partner') || current_user_can('partner_contributor')) : ?>
                                    <div>
                                        <div class="container entry-content">
                                            <?php if ((types_render_field('prgm_status', array('output' => 'raw'))) == 'under_review') : ?>
                                                <div class="alert alert-primary"> <b><?php _e('Your Program details are under review. You will be able submit new details after the approval for your last edit processes.', 'tb_theme'); ?></b>
                                                </div>
                                            <?php else : ?>
                                                <?php gravity_form(6, false, false, true, '', true); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div>
                                        <div class="container">
                                            <div class="alert bg-warning h4 text-body text-center">
                                                <?php _e('You don&apos;t have permission to access this tab.', 'tb_theme'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </article>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer('a-master'); ?>