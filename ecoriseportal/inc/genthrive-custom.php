<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'gform_replace_merge_tags', 'jr_get_admins_options', 10, 7 );
function jr_get_admins_options( $text, $form, $entry, $url_encode, $esc_html, $nl2br, $format ) {

  $post_id = get_queried_object_id();
  if ( !is_admin() && 'service-provider' == get_post_type() && !is_null($post_id) && !is_archive() ) {
    $parentProviderID = (types_render_usermeta( 'user-s-partner-org-id', array( 'user_current' => 'true' ) ));

    if ( strpos( $text, '{get_admin_options}' ) !== false ) {
      $text = str_replace( '{get_admin_options}', $parentProviderID , $text );
    }
    return $text;

  } else {
    return $text;
  }

  }

add_filter( 'gform_replace_merge_tags', 'jr_get_current_reviewer', 10, 7 );
function jr_get_current_reviewer( $text, $form, $entry, $url_encode, $esc_html, $nl2br, $format ) {

  $post_id = get_the_ID();
  if ( !is_admin() && 'service-provider' == get_post_type() && !is_null($post_id) && !is_archive() ) {
      if ($post_id && $post_id != 0) {
          $currentReviewer = types_render_field( 'assigned_partner_approver', array( "id" => $post_id) );
          $post_rel_parent = toolset_get_related_post( $post_id, "partner-to-program-provider" );
          $parentAdmins = types_render_field( 'org_details_administrators', array( "id" => $post_rel_parent) );
      
          if ( strpos( $text, '{get_current_reviewer}' ) !== false ) {
            if (!is_null($currentReviewer) && !empty($currentReviewer) ) {
              $text = str_replace( '{get_current_reviewer}', $currentReviewer , $text );
            } else {
              $text = str_replace( '{get_current_reviewer}', $parentAdmins , $text );
            }
          }
          return $text;
      }
    
    }
    else {
      return $text;
    }
}

add_filter( 'gform_replace_merge_tags', 'jr_get_admins_replace_merge_tags', 10, 7 );
function jr_get_admins_replace_merge_tags( $text, $form, $entry, $url_encode, $esc_html, $nl2br, $format ) {

  $post_id = get_queried_object_id();
  if ( !is_admin() && 'service-provider' == get_post_type() && !is_null($post_id) && !is_archive() ) {
    $currentReviewer = types_render_field( 'assigned_partner_approver', array( "id" => $post_id) );
    $post_rel_parent = toolset_get_related_post( $post_id, "partner-to-program-provider" );
    $parentAdmins = types_render_field( 'org_details_administrators', array( "id" => $post_rel_parent) );
    if ( strpos( $text, '{get_Partner_admin}' ) !== false ) {
      if (!is_null($currentReviewer) && !empty($currentReviewer) ) {
        $text = str_replace( '{get_Partner_admin}', 'user_id|'.$currentReviewer , $text );
      } else {
        $text = str_replace( '{get_Partner_admin}', 'user_id|'.$parentAdmins , $text );
      }
    }
    return $text;
    }
    elseif ( !is_admin() && 'program' == get_post_type() && !is_null($post_id) && !is_archive()) {
      $this_p_ID = get_queried_object_id();
      if ($this_p_ID && $this_p_ID != 0) {
          $post_id = toolset_get_related_post( $this_p_ID, "service-provider-program" );
          $currentReviewer = types_render_field( 'assigned_partner_approver', array( "id" => $post_id) );
          if ($post_id && $post_id != 0) {
              $post_rel_parent = toolset_get_related_post( $post_id, "partner-to-program-provider" );
          $parentAdmins = types_render_field( 'org_details_administrators', array( "id" => $post_rel_parent) );
          if ( strpos( $text, '{get_Partner_admin}' ) !== false ) {
            if (!is_null($currentReviewer) && !empty($currentReviewer) ) {
              $text = str_replace( '{get_Partner_admin}', 'user_id|'.$currentReviewer , $text );
            } else {
              $text = str_replace( '{get_Partner_admin}', 'user_id|'.$parentAdmins , $text );
            }
          }
          return $text;
          }
      }
      
      
      }
    elseif ( !is_admin() && is_page(544) && !is_archive()) {

        $parentProviderID = (types_render_usermeta( 'user-s-partner-org-id', array( 'user_current' => 'true' ) ));

        if ( strpos( $text, '{get_Partner_admin}' ) !== false ) {
          $text = str_replace( '{get_Partner_admin}', $parentProviderID , $text );
        }
        return $text;
      }
    else {
      return $text;
    }
  }

function get_usersrole( $atts ) {

    // Attributes
    $atts = shortcode_atts(
        array(
            'user_id' => '',
        ),
        $atts
    );

    $user_info = get_userdata($atts['user_id']);

          $da_roles = implode(', ', $user_info->roles);
          return str_replace( "_", " ", $da_roles);

}
add_shortcode( 'get_usersrole', 'get_usersrole' );

function get_user_fullname_shortcode($atts) {
  $atts = shortcode_atts(array(
      'id' => '',
  ), $atts);

  $user_id_or_name = $atts['id'];

  if (ctype_digit($user_id_or_name)) {
      $user_id = intval($user_id_or_name);
      $user = get_user_by('id', $user_id);

      if ($user) {
          $first_name = $user->first_name;
          $last_name = $user->last_name;
          return $first_name . ' ' . $last_name;
      } else {
          return 'User not found';
      }
  } else {
      return $user_id_or_name;
  }
}
add_shortcode('user_fullname', 'get_user_fullname_shortcode');

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
  if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
  }
}

//redirect user after passord reset
add_action('login_headerurl', 'wpse_lost_password_redirect');
function wpse_lost_password_redirect() {

    // Check if have submitted
    $confirm = ( isset($_GET['action'] ) && $_GET['action'] == resetpass );

    if( $confirm ) {
        wp_redirect( site_url('/my-profile/') );
        exit;
    }
}

//Return only service providers from the current user:
add_filter( 'wpv_filter_query', 'prefix_show_only_current_user', 101, 3 );
function prefix_show_only_current_user( $query_args, $view_settings, $view_id ) {

    if ($view_id == 551) {

      $pType = (array) $query_args['post_type'];

      $providers = (types_render_usermeta( 'user-s-service-provider-id', array( 'separator' => ',', 'user_current' => 'true') ));
      $user_providers_array = explode (',',$providers);

      if ( !is_admin() && in_array( 'service-provider', $pType ) ) {
          $query_args['post__in'] = $user_providers_array;
      }
    }
    return $query_args;
}

//Return only programs based on the state selected
add_filter( 'wpv_filter_query', 'get_programs_by_state', 102, 3 );
function get_programs_by_state( $query_args, $view_settings, $view_id ) {

    if ($view_id == 1737 && isset($_GET['wpv-wpcf-prgm_offered_states'])) {
      $state = $_GET['wpv-wpcf-prgm_offered_states'];
	  if(!empty($state)){
		 $query_args['meta_query'][] = array(
			 'key'     => 'wpcf-prgm_offered_state_'.strtolower($state),
			 'value'   => 'Active',
			 'compare' => 'LIKE',
		 );
	
		 //removes the faux data (wpv-wpcf-prgm_offered_states)
		 foreach($query_args['meta_query'] as $key => $meta){
      if(!empty($meta) && is_array($meta)){
        foreach($meta as $idx => $val){
          if($val == 'wpv-wpcf-prgm_offered_states'){
            unset($query_args['meta_query'][$key]);
          }
        }
      }
		 }

	  }
    }
    return $query_args;
}


add_filter( 'gform_us_states', 'us_states' );
function us_states( $states ) {
    $new_states = array();
    foreach ( $states as $state ) {
        $new_states[ GF_Fields::get( 'address' )->get_us_state_code( $state ) ] = $state;
    }

    return $new_states;
}

add_filter('gform_field_value_time_now', 'gw_now_time');
function gw_now_time() {
	//return date('Y-m-d H:i:s');
	return strtotime(date('Y-m-d H:i:s'));
}

function shortcodes_init(){
  add_shortcode( 'spsearchbox', 'serve_p_search_box' );
  function serve_p_search_box() {
      $output = '<div class="form-group search-container">
    <div action="/service-provider/" class="search_front ">
        <input class="form-control js-wpv-filter-trigger-delayed mr-half" type="text" placeholder="Search by Service Provider Name" name="search"/>
        <button class="btn btn-secondary js-wpv-submit-trigger search_provider wpv-submit-trigger">Search Service Providers
</button>
    </div>
</div>';

      return $output;
  }
}
add_action('init', 'shortcodes_init');



add_filter('gform_field_value_users_parent_org', 'gw_users_parent_org');
function gw_users_parent_org() {
  // $post_id = get_queried_object_id();
  if ( ! is_admin() ) {
    $parent_org_user_id = (types_render_usermeta( 'user-s-partner-org-id', array( 'user_current' => 'true'  ) ));
    return $parent_org_user_id;
  }
}

add_filter( 'gform_replace_merge_tags', 'djb_gform_replace_custom_site_url_merge_tag', 10, 7 );
function djb_gform_replace_custom_site_url_merge_tag( $text, $form, $entry, $url_encode, $esc_html, $nl2br, $format ) {

    // Check if our custom merge tag '{site_url}' exists in the text.
    if ( strpos( $text, '{site_url}' ) !== false ) {
        // Get the WordPress site URL.
        $site_url = get_site_url();

        // Replace the merge tag with the actual site URL.
        $text = str_replace( '{site_url}', $site_url, $text );
    }

    // You can keep your existing custom merge tag logic here as well.
    if ( strpos( $text, '{current_date_time}' ) !== false ) {
        // Using strtotime(date("Y-m-d H:i:s")) to get a Unix timestamp as per your example.
        $text = str_replace( '{current_date_time}', strtotime( date( "Y-m-d H:i:s" ) ), $text );
    }

    if ( strpos( $text, '{get_user_update_form}' ) !== false ) {
        $text = str_replace( '{get_user_update_form}', do_shortcode( '[wpv-user field="ID"]' ), $text );
    }
    return $text;

    return $text;
}

add_filter( 'gform_confirmation', function ( $confirmation, $form, $entry, $ajax ) {

  $forms = array( 25 );
  $form_id = $form['id']; 
    
  if ( !in_array( $form_id, $forms ) ) {
      return $confirmation;
  }

  if ( isset( $confirmation['redirect'] ) ) {
    // current page url
    global $wp;
    $url = esc_url_raw( home_url( add_query_arg( $_GET, $wp->request ) ) );
    
    $confirmation = '<div class="gform_confirmation_wrapper"><div class="alert alert-warning"><h3><span style="color: #000000;">Your information has been submitted.</span></h3>
    This page will now refresh so you can fill in at least one program below to allow your account to be active.</div></div>';
    $confirmation .= "<script type=\"text/javascript\">setTimeout(function () { window.location.assign('$url') }, 3500);</script>";

  }

  return $confirmation;
}, 10, 4 );


// add_filter( 'gform_confirmation_28', 'custom_confirmation', 10, 4 );
// function custom_confirmation( $confirmation, $form, $entry, $ajax ) {
// //   $confirmation = "";
// //   // $meta_auto = [];

// //   // foreach ( $form['fields'] as $field ) {
// //   //   if ($field->type != "checkbox" && !empty($field->postMetaMatch)) {
// //   //     $key = $field->postMetaMatch;
// //   //     $meta_auto[$key] = $field->id;
// //   //   }
// //   // }

//           // $arr = [];

//           // foreach ( $form['fields'] as $field ) {
//           //   if ($field->type == "checkbox" && !empty($field->postMetaMatch)) {
//           //     $inner_array = [];
//           //     $key = $field->postMetaMatch;
//           //     $inner_array[] = strval($key);
//           //     $inner_array[] = strval($field->id);
//           //     $arr[] = $inner_array;
//           //   }
//           // }

// //     // $confirmation = "Thanks for contacting us. We will get in touch with you soon";

//     return $confirmation;
// }

// Array ( [id] => 4668 [status] => active [form_id] => 28 [ip] => 74.110.178.151 [source_url] => https://env-genthrive-dev.kinsta.cloud/?gf_page=preview&id=28 [currency] => USD [post_id] => [date_created] => 2023-07-08 11:52:51 [date_updated] => 2023-07-08 11:52:51 [is_starred] => 0 [is_read] => 0 [user_agent] => Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 [payment_status] => [payment_date] => [payment_amount] => [payment_method] => [transaction_id] => [is_fulfilled] => [created_by] => 637 [transaction_type] => [1] => yhnmju [3] => First Choice [4.1] => [4.2] => Second Choice [4.3] => Third Choice [fg_easypassthrough_token] => da623f37dca2852dc477961f40fb6074 ) 
//   Array ( [fields] => 
//       Array ( 
//       [0] => GF_Field_Text Object ( [type] => text [_is_entry_detail:GF_Field:private] => [_context_properties:GF_Field:private] => Array ( [use_admin_label] => ) [_merge_tag_modifiers:GF_Field:private] => Array ( ) [_supports_state_validation:protected] => [id] => 1 [formId] => 28 [label] => Text Field 1 [adminLabel] => [isRequired] => [size] => large [errorMessage] => [visibility] => visible [inputs] => [description] => [allowsPrepopulate] => [inputMask] => [inputMaskValue] => [inputMaskIsCustom] => [maxLength] => [inputType] => [labelPlacement] => [descriptionPlacement] => [subLabelPlacement] => [placeholder] => [cssClass] => [inputName] => [noDuplicates] => [defaultValue] => [enableAutocomplete] => [autocompleteAttribute] => [choices] => [conditionalLogic] => [productField] => [layoutGridColumnSpan] => [enablePasswordInput] => [gpaaEnable] => [enableEnhancedUI] => 0 [layoutGroupId] => 123c6111 [multipleFiles] => [maxFiles] => [calculationFormula] => [calculationRounding] => [enableCalculation] => [disableQuantity] => [displayAllCategories] => [useRichTextEditor] => [gp-unique-id_starting_number] => [gppa-choices-filter-groups] => Array ( ) [gppa-choices-templates] => Array ( ) [gppa-values-filter-groups] => Array ( ) [gppa-values-templates] => Array ( ) [errors] => Array ( ) [pageNumber] => 1 [fields] => [failed_validation] => [validation_message] => [is_field_hidden] => [enableCopyValuesOption] => [enablePrice] => [displayOnly] => [gp-unique-id_type] => [form_id] => ) 
//       [1] => GF_Field_Select Object ( [type] => select [_supports_state_validation:protected] => 1 [_is_entry_detail:GF_Field:private] => [_context_properties:GF_Field:private] => Array ( [use_admin_label] => ) [_merge_tag_modifiers:GF_Field:private] => Array ( ) [id] => 3 [formId] => 28 [label] => Select Field [adminLabel] => [isRequired] => [size] => large [errorMessage] => [visibility] => visible [validateState] => 1 [inputs] => [choices] => Array ( [0] => Array ( [text] => First Choice [value] => First Choice [isSelected] => [price] => ) [1] => Array ( [text] => Second Choice [value] => Second Choice [isSelected] => [price] => ) [2] => Array ( [text] => Third Choice [value] => Third Choice [isSelected] => [price] => ) ) [description] => [allowsPrepopulate] => [inputMask] => [inputMaskValue] => [inputMaskIsCustom] => [maxLength] => [inputType] => [labelPlacement] => [descriptionPlacement] => [subLabelPlacement] => [placeholder] => [cssClass] => [inputName] => [noDuplicates] => [defaultValue] => [enableAutocomplete] => [autocompleteAttribute] => [conditionalLogic] => [productField] => [layoutGridColumnSpan] => [enablePrice] => [gpaaEnable] => [enableEnhancedUI] => 0 [layoutGroupId] => 3e55f4c8 [multipleFiles] => [maxFiles] => [calculationFormula] => [calculationRounding] => [enableCalculation] => [disableQuantity] => [displayAllCategories] => [useRichTextEditor] => [gp-unique-id_starting_number] => [gppa-choices-filter-groups] => Array ( ) [gppa-choices-templates] => Array ( ) [gppa-values-filter-groups] => Array ( ) [gppa-values-templates] => Array ( ) [errors] => Array ( ) [pageNumber] => 1 [fields] => [failed_validation] => [validation_message] => [displayOnly] => [enableCopyValuesOption] => [gp-unique-id_type] => )
//       [2] => GF_Field_Checkbox Object ( [type] => checkbox [_supports_state_validation:protected] => 1 [_is_entry_detail:GF_Field:private] => [_context_properties:GF_Field:private] => Array ( [use_admin_label] => ) [_merge_tag_modifiers:GF_Field:private] => Array ( ) [id] => 4 [formId] => 28 [label] => Checkbox Field [adminLabel] => [isRequired] => [size] => large [errorMessage] => [visibility] => visible [choices] => Array ( [0] => Array ( [text] => First Choice [value] => First Choice [isSelected] => [price] => ) [1] => Array ( [text] => Second Choice [value] => Second Choice [isSelected] => [price] => ) [2] => Array ( [text] => Third Choice [value] => Third Choice [isSelected] => [price] => ) ) [validateState] => 1 [inputs] => Array ( [0] => Array ( [id] => 4.1 [label] => First Choice [name] => ) [1] => Array ( [id] => 4.2 [label] => Second Choice [name] => ) [2] => Array ( [id] => 4.3 [label] => Third Choice [name] => ) ) [description] => [allowsPrepopulate] => [inputMask] => [inputMaskValue] => [inputMaskIsCustom] => [maxLength] => [inputType] => [labelPlacement] => [descriptionPlacement] => [subLabelPlacement] => [placeholder] => [cssClass] => [inputName] => [noDuplicates] => [defaultValue] => [enableAutocomplete] => [autocompleteAttribute] => [conditionalLogic] => [productField] => [layoutGridColumnSpan] => [enableSelectAll] => [enablePrice] => [gpaaEnable] => [enableEnhancedUI] => 0 [layoutGroupId] => 32debe41 [multipleFiles] => [maxFiles] => [calculationFormula] => [calculationRounding] => [enableCalculation] => [disableQuantity] => [displayAllCategories] => [useRichTextEditor] => [gwlimitcheckboxes_enable] => [gwlimitcheckboxes_span_multiple_fields] => [gp-unique-id_starting_number] => [gppa-choices-filter-groups] => Array ( ) [gppa-choices-templates] => Array ( ) [gppa-values-filter-groups] => Array ( ) [gppa-values-templates] => Array ( ) [errors] => Array ( ) [pageNumber] => 1 [fields] => [failed_validation] => [validation_message] => [displayOnly] => [enableCopyValuesOption] => [gp-unique-id_type] => ) 
//       )
  
//   [button] => Array ( [type] => text [text] => [imageUrl] => [width] => auto [location] => bottom [layoutGridColumnSpan] => 12 ) [title] => A Testing Form [description] => [version] => 2.7.8 [id] => 28 [markupVersion] => 2 [nextFieldId] => 5 [useCurrentUserAsAuthor] => 1 [postContentTemplateEnabled] => [postTitleTemplateEnabled] => [postTitleTemplate] => [postContentTemplate] => [lastPageButton] => [pagination] => [firstPageCssClass] => [notifications] => Array ( [64a6cd02bfa22] => Array ( [id] => 64a6cd02bfa22 [isActive] => 1 [to] => {admin_email} [name] => Admin Notification [event] => form_submission [toType] => email [subject] => New submission from {form_title} [message] => {all_fields} ) ) [confirmations] => Array ( [64a6cd02bfc10] => Array ( [id] => 64a6cd02bfc10 [name] => Default Confirmation [isDefault] => 1 [type] => message [message] => Thanks for contacting us! We will get in touch with you shortly. [url] => [pageId] => [queryString] => ) ) [is_active] => 1 [date_created] => 2023-07-06 14:17:38 [is_trash] => 0 [confirmation] => Array ( [id] => 64a6cd02bfc10 [name] => Default Confirmation [isDefault] => 1 [type] => message [message] => Thanks for contacting us! We will get in touch with you shortly. [url] => [pageId] => [queryString] => ) )
  

add_action( 'gform_after_submission_7', 'set_new_user_to_sp_post', 10, 2 );
function set_new_user_to_sp_post( $entry, $form ) {

  $p_post_id = $entry[12];
  if ($p_post_id && $p_post_id != 0) {
    $post_rel_parent = toolset_get_related_post( $p_post_id, "partner-to-program-provider" );
    $user_id = get_current_user_id();
    add_user_meta( $user_id,'wpcf-user-s-service-provider-id', $p_post_id );
    add_user_meta( $user_id,'wpcf-user-s-partner-org-id', $post_rel_parent );
  }
}

add_action( 'gform_after_submission_15', 'remove_user_from_account', 10, 2 );
function remove_user_from_account( $entry, $form ) {

  $user_id = $entry[2];
  $servePid = $entry[3];
  $providerid = $entry[4];

  if (!empty($servePid))
  delete_user_meta( $user_id,'wpcf-user-s-service-provider-id', $servePid );

  if (!empty($providerid))
  delete_user_meta( $user_id,'wpcf-user-s-partner-org-id', $providerid );


}

add_action( 'gform_after_submission_20', 'reset_partner_approver', 10, 2 );
function reset_partner_approver( $entry, $form ) {

  $user_id = $entry[1];
  $partnerid = $entry[3];

  update_post_meta( $partnerid,'wpcf-org_details_administrators', $user_id );

}

add_action( 'gform_after_submission_22', 'set_specific_partner_approver', 10, 2 );
function set_specific_partner_approver( $entry, $form ) {

  $user_id = $entry[1];
  $partnerid = $entry[3];

  update_post_meta( $partnerid,'wpcf-assigned_partner_approver', $user_id );

}

add_action( 'gform_after_submission_27', 'set_statuses', 10, 2 );
function set_statuses( $entry, $form ) {

  $post_id = $entry[72];

  update_post_meta( $post_id,'wpcf-org_network_status', 'under_review' );
  update_post_meta( $post_id,'wpcf-org_staff_status', 'under_review' );
  update_post_meta( $post_id,'wpcf-org_mission_status', 'under_review' );
  update_post_meta( $post_id,'wpcf-org_details_status', 'under_review' );
  // update_post_meta( $post_id, 'wpcf-onboarding_account_status', '1' );

}

// add_action( 'gform_after_submission_6', 'test_p_form', 10, 2 );
// function test_p_form( $entry, $form ) {
//
//   $entires_array = [540, 541, 544];
//   // $entires_array = [];
//   // $entires_string= $entry['73'];
//   // $entires_array = explode (",", $entires_string);
//
//   $search_criteria['field_filters'][] = array( 'key' => 'id', 'operator' => 'in', 'value' => $entires_array );
//
//   $embeded_entry = GFAPI::get_entries( '12', $search_criteria );
//
//   $output_array = array();
//
//   foreach ($embeded_entry as $entires) {
//
//           $output_array[$entires['1']] = $entires['2'];
//
//              // $output_array = array($state,$available);
//   }
//
//   var_dump($entires_array);
//   var_dump($output_array);
//   var_dump($embeded_entry);
// }

add_action( 'gform_after_submission_14', 'admin_updates_user', 10, 2 );
function admin_updates_user( $entry, $form ) {

  $user_id = $entry[12];
  $user_fn = $entry["1.3"];
  $user_ln = $entry["1.6"];
  $user_email = $entry[4];
  $user_name = $entry[3];
  $user_email_type = $entry[6];
  $user_phone = $entry[2];
  $user_phone_type = $entry[7];
  $user_role = $entry[5];

  wp_update_user( array( 'ID' => $user_id, 'user_email' => $user_email, 'nickname' => $user_name, 'first_name' => $user_fn, 'last_name' => $user_ln, ) );
  update_user_meta( $user_id,'wpcf-user_preferred_email', $user_email_type );
  update_user_meta( $user_id,'wpcf-user_phone', $user_phone );
  update_user_meta( $user_id,'wpcf-user_preferred_phone', $user_phone_type );
  update_user_meta( $user_id,'wpcf-user_title', $user_role );

}


add_action( 'gform_advancedpostcreation_post_after_creation_8', 'ts_add_relationship', 10, 4 );
function ts_add_relationship( $post_id, $feed, $entry, $form ) {

    // parent org
    $field_id = 2;

    // Get field object.
    $field = GFAPI::get_field( $form, $field_id );

    $p_org_field = $entry[2];
    // var_dump($p_org_field);

    toolset_connect_posts("partner-to-program-provider", $p_org_field, $post_id);

    $data = array(
      'ID' => $post_id,
      'meta_input' => array(
        'wpcf-org_details_new_account' => '1',
        'wpcf-org_mission_new_account' => '1',
        'wpcf-org_staff_new_account' => '1',
        'wpcf-org_network_new_account' => '1',
        'wpcf-org_details_created' => '',
        'wpcf-org_mission_created' => '',
        'wpcf-org_staff_created' => '',
        'wpcf-org_network_created' => ''
       )
     );

    wp_update_post( $data );
    $user_id = get_current_user_id();
    add_user_meta( $user_id,'wpcf-user-s-service-provider-id', $post_id );

}

add_action( 'gform_advancedpostcreation_post_after_creation_9', 'ts_add_prgm_relationship', 10, 4 );
function ts_add_prgm_relationship( $post_id, $feed, $entry, $form ) {

    $p_org_field = $entry[2];

    toolset_connect_posts("service-provider-program", $p_org_field, $post_id);

    update_post_meta( $post_id, 'wpcf-prgm_created', time() );

}

add_filter( 'gform_pre_render', 'my_populate_checkbox' );
function my_populate_checkbox( $form ) {

  $form_id = $form['id'];
 
  $fieldUpdateForms = array( 2,3,4,5,6,25 );

  if ( in_array( $form_id, $fieldUpdateForms )) {

    foreach( $form['fields'] as &$field ) {

      if (( $field->type == "checkbox" || $field->type == "multiselect" ) && !empty($field->postMetaMatch)) {

        foreach( $field->choices as &$choice ) {
          $theChecks = types_render_field( $field->postMetaMatch, array( "separator" => "," ) );
          $checksArray = explode(',', $theChecks);
          if( in_array($choice['value'], $checksArray) ) {
            $choice['isSelected'] = true;
          }
       }

      }

    }
  }

  // return the altered `$form` array to Gravity Forms
  return $form;

} // end: my_populate_checkbox

// add_action( 'gform_after_submission', 'potential_SP_notificatoin', 10, 2 ); // Why is this here only for form 2? G-Flow should control this
function potential_SP_notificatoin( $entry, $form ) {

    function mailNoticeOnboarding($the_mailadress,$the_SPName)
    {
      $siteAdmin = get_option( 'admin_email' );
      $siteAddress = site_url( '/my-inbox/' );

      $to = $the_mailadress;
      $subject = 'New Account Approval Required for '.$the_SPName;
      $body = $the_SPName.' has submitted all onboarding forms and requires approval. Please visit <a href="'.$siteAddress.'">Your Inbox</a> to review and approve form submissions.';
      $headers[] = 'MIME-Version: 1.0';
      $headers[] = 'Content-Type: text/html; charset=UTF-8';
      $headers[] = 'From: Gen:Thrive <'.$siteAdmin.'>';
      $headers[] = 'Reply-To: No Reply <no-reply@genthrive.org>';

      wp_mail( $to, $subject, $body, $headers );

    }

    function mailNoticeActive($the_mailadress,$the_SPName)
    {
      $siteAdmin = get_option( 'admin_email' );
      $siteAddress = site_url( '/my-inbox/' );

      $to = $the_mailadress;
      $subject = 'Account Update Approval Required for '.$the_SPName;
      $body = $the_SPName.' has submitted an edit to their account information which requires approval. Please visit <a href="'.$siteAddress.'">Your Inbox</a> to review and approve form submissions.';
      $headers[] = 'MIME-Version: 1.0';
      $headers[] = 'Content-Type: text/html; charset=UTF-8';
      $headers[] = 'From: Gen:Thrive <'.$siteAdmin.'>';
      $headers[] = 'Reply-To: No Reply <no-reply@genthrive.org>';

      wp_mail( $to, $subject, $body, $headers );

    }

      if ( $form_id === 2 ) {
          $post_id = $entry[24];

          $accountStatus = (types_render_field( 'org_details_account_status', array( 'output' => 'raw', 'item' => $post_id ) ));
          $missionStatus = (types_render_field( 'org_mission_status', array( 'output' => 'raw', 'item' => $post_id ) ));
          $staffStatus = (types_render_field( 'org_staff_status', array( 'output' => 'raw', 'item' => $post_id ) ));
          $networkStatus = (types_render_field( 'org_network_status', array( 'output' => 'raw', 'item' => $post_id ) ));
          $statusArr = array($missionStatus,$staffStatus,$networkStatus);
          // $programsRelated = get_view_query_results( 2739,null,null,['wpvrelatedto'=>$post_id] );
          $programCount = count(get_view_query_results( 2739,null,null,['wpvrelatedto'=>$post_id] ));
          if ($post_id && $post_id != 0) {
              $post_rel_parent = toolset_get_related_post( $post_id, "partner-to-program-provider" );
              $userID = (types_render_field( 'org_details_administrators', array( 'output' => 'raw', 'item' => $post_rel_parent ) ));
              $user_info = get_userdata($userID);
              $mailadress = $user_info->user_email;
              $SPName = get_the_title( $post_id );
    
              if ( $accountStatus != '1' && $programCount > 0 && !in_array("under_review", $statusArr) && !in_array("not_started", $statusArr)) {
                mailNoticeOnboarding($mailadress,$SPName);
              } elseif ( $accountStatus == '1'  ) {
                mailNoticeActive($mailadress,$SPName);
              }
          }
      }
}

//generate lat/long and save
function get_lat_long_from_address($post_id) {
  $street = get_post_meta($post_id, 'wpcf-org_billingstreet', true);
  $city = get_post_meta($post_id, 'wpcf-org_billingcity', true);
  $state = get_post_meta($post_id, 'wpcf-org_billingstate', true);
  $zip = get_post_meta($post_id, 'wpcf-org_billingzippostalcode', true);

  if (empty($street) || empty($city) || empty($state)) {
      return; // Exit if any address component is missing
  }

  $address = "{$street}, {$city}, {$state} {$zip}";

  $api_key = 'AIzaSyD_QcjaaxxLYcHiqG095Bm0aVyAKw6kfio'; // Replace with your API key
  $encoded_address = urlencode($address);
  $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$encoded_address}&key={$api_key}";

  $response = wp_remote_get($url);
  if (is_wp_error($response)) {
      return; // Exit if there's an error with the API request
  }

  $body = wp_remote_retrieve_body($response);
  $data = json_decode($body, true);
  

  if ($data['status'] === 'OK') {
    
    $latitude = $data['results'][0]['geometry']['location']['lat'];
    $longitude = $data['results'][0]['geometry']['location']['lng'];

    update_post_meta($post_id, 'wpcf-address_latitude', $latitude);
    update_post_meta($post_id, 'wpcf-address_longitude', $longitude);

  } else {
    error_log('Google Maps API error or invalid response: ' . print_r($data, true)); // Log the entire response for debugging
  }
}

function process_service_provider_posts() {
  
  $args = array(
      'post_type' => 'service-provider',
      'posts_per_page' => 100,
      'meta_query' => array(
        'relation' => 'AND',
          array(
              'key' => 'wpcf-address_latitude',
              'compare' => 'NOT EXISTS',
          ),
          array(
              'key' => 'wpcf-org_billingstreet',
              'compare' => '!=',
              'value' => '',
          ),
      )
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) {
      while ($query->have_posts()) {
          $query->the_post();
          $post_id = get_the_ID();
          
          get_lat_long_from_address($post_id);
          // echo "Post Updated: " . $post_id . " ";
          
      }
      
      wp_reset_postdata();
  }
}

add_action('process_posts_cron', 'process_service_provider_posts');
if (!wp_next_scheduled('process_posts_cron')) {
    wp_schedule_event(time(), 'weekly', 'process_posts_cron');
}

add_action( 'gform_after_submission', 'process_after_SP_forms', 10, 2 );
function process_after_SP_forms($entry, $form){

        $form_id = $form['id'];
        $fieldUpdateForms = array( 2,3,4,5,6,25 );
        
        if ( in_array( $form_id, $fieldUpdateForms )) {

          if ( $form_id === 2 ) {
            $post_id = $entry[24];
            $logo = $entry[35];

            $AddressMeta = array(
              'wpcf-org_billingstreet' => '18.1',
              'wpcf-org_billingcity' => '18.3',
              'wpcf-org_billingstate' => '18.4',
              'wpcf-org_billingzippostalcode' => '18.5',
            );

            $physicalAddressMeta = array(
              'wpcf-org_physical_street_address' => '37.1',
              'wpcf-org_physical-city-address' => '37.3',
              'wpcf-org_physical-state-address' => '37.4',
              'wpcf-org_physical-zip-code-address' => '37.5',
            );

            if ($logo != "[]") {
              update_post_meta( $post_id, 'wpcf-organization_logo', $logo );
            }
            
          }
          elseif ( $form_id === 3 ) {
            $post_id = $entry[21];
          }
          elseif ( $form_id === 4 ) {
            $post_id = $entry[15];

          }
          elseif ( $form_id === 5 ) {
            $post_id = $entry[19];
          }
          elseif ( $form_id === 6 ) {
            $post_id = $entry[69];       
          }
          elseif ( $form_id === 25 ) {
            $post_id = $entry[72];
            $date_created = $entry[70];
            $contributor = $entry[73];

            $AddressMeta = array(
              'wpcf-org_billingstreet' => '5.1',
              'wpcf-org_billingcity' => '5.3',
              'wpcf-org_billingstate' => '5.4',
              'wpcf-org_billingzippostalcode' => '5.5',
            );

            $physicalAddressMeta = array(
              'wpcf-org_physical_street_address' => '79.1',
              'wpcf-org_physical-city-address' => '79.3',
              'wpcf-org_physical-state-address' => '79.4',
              'wpcf-org_physical-zip-code-address' => '79.5',
            );

            update_post_meta( $post_id,'wpcf-org_network_status', 'complete' );
            update_post_meta( $post_id,'wpcf-org_staff_status', 'complete' );
            update_post_meta( $post_id,'wpcf-org_mission_status', 'complete' );
            update_post_meta( $post_id,'wpcf-org_details_status', 'complete' );
            update_post_meta( $post_id,'wpcf-org_network_created', $date_created );
            update_post_meta( $post_id,'wpcf-org_mission_created', $date_created );
            update_post_meta( $post_id,'wpcf-org_details_created', $date_created );
            update_post_meta( $post_id,'wpcf-org_network_updated', $date_created );
            update_post_meta( $post_id,'wpcf-org_staff_last_updated', $date_created );
            update_post_meta( $post_id,'wpcf-org_mission_last_updated', $date_created );
            update_post_meta( $post_id,'wpcf-org_details_last_updated', $date_created );
            update_post_meta( $post_id,'wpcf-org_network_contributor', $contributor );
            update_post_meta( $post_id,'wpcf-org_staff_last_contributor', $contributor );
            update_post_meta( $post_id,'wpcf-org_mission_last_contributor', $contributor );
            update_post_meta( $post_id,'wpcf-org_details_last_contributor', $contributor );


            get_lat_long_from_address($post_id);

          }
            
          $arr = [];

          foreach ( $form['fields'] as $field ) {
            if ($field->type == "checkbox" && !empty($field->postMetaMatch)) {
              $inner_array = [];
              $key = $field->postMetaMatch;
              $inner_array[] = strval($key);
              $inner_array[] = strval($field->id);
              $arr[] = $inner_array;
            }
          }
          $arr_multi = [];
      
          foreach ( $form['fields'] as $field ) {
            if ($field->type == "multiselect" && !empty($field->postMetaMatch)) {
    
              $inner_array = [];
              $key = $field->postMetaMatch;
              $inner_array[] = strval($key);
              $inner_array[] = strval($field->id);
              $arr_multi[] = $inner_array;
            }
          }
          
          // $arr_multi = [];

          // foreach ( $form['fields'] as $field ) {
          //   if ($field->type == "multiselect" && !empty($field->postMetaMatch)) {
          //     $key = 'wpcf-'.$field->postMetaMatch;
          //     $meta[$key] = $field->id;
          //   }
          // }

          // var_dump($arr);
          $meta = [];

          foreach ( $form['fields'] as $field ) {
            if ($field->type != "checkbox" && $field->type != "multiselect" && !empty($field->postMetaMatch)) {
              $key = 'wpcf-'.$field->postMetaMatch;
              $meta[$key] = $field->id;
            }
          }

          if(!empty($AddressMeta)) {
            $meta = array_merge($AddressMeta,$meta);
          }

          if(!empty($physicalAddressMeta)) {
            $meta = array_merge($physicalAddressMeta,$meta);
          }

        }

        if(!empty($arr)) {
          foreach($arr as $v){
              $items = get_checkbox_value( $entry, $v[1] );
              $value = my_checkboxes_func($items, $v[0]);
              update_post_meta($post_id, 'wpcf-' . $v[0], $value);
          }
        }

        if(!empty($arr_multi)) {
          foreach($arr_multi as $v){            
              $items = get_checkbox_value( $entry, $v[1] );
              $value = my_multiselect_func($items, $v[0]);
              update_post_meta($post_id, 'wpcf-' . $v[0], $value);
          }
        }

        // var_dump($meta);

        if(!empty($meta)) {
          // start update regular terms
          $meta_input = array();

          // Assign custom fields.
          foreach ( $meta as $key => $value ) {

            $meta_value = rgar( $entry, $value );
            // var_dump($meta_value);

              // Map all other custom fields generically.
              if ( ! rgblank( $meta_value ) ) {
                $meta_input[ $key ] = $meta_value;
              } 
              // else {
              //   delete_post_meta( $post_id, $key );
              // }
          }
          // var_dump($meta_input);

          $post = get_post( $post_id );
          
          $post->meta_input = $meta_input;
            
          wp_update_post( $post );
    }

    if ( $form_id === 6 ) {

      if ($post_id && $post_id != 0) {
        $rel_post_id = toolset_get_related_post( $post_id, "service-provider-program" );
      }

      $publishStatus = (types_render_field( 'org_details_account_status', array( 'output' => 'raw', 'item' => $rel_post_id ) ));
      $accountOnboardStatus = (types_render_field( 'onboarding_account_status', array( 'output' => 'raw', 'item' => $rel_post_id ) ));
      $detailStatus = (types_render_field( 'org_details_status', array( 'output' => 'raw', 'item' => $rel_post_id ) ));
      $missionStatus = (types_render_field( 'org_mission_status', array( 'output' => 'raw', 'item' => $rel_post_id ) ));
      $staffStatus = (types_render_field( 'org_staff_status', array( 'output' => 'raw', 'item' => $rel_post_id ) ));
      $networkStatus = (types_render_field( 'org_network_status', array( 'output' => 'raw', 'item' => $rel_post_id ) ));
      $statusArr = array($detailStatus,$missionStatus,$staffStatus,$networkStatus);

      $programCount = count(get_view_query_results( 2739,null,null,['wpvrelatedto'=>$rel_post_id] ));

      if ( $publishStatus != '1' && $programCount > 0 && !in_array("under_review", $statusArr) && !in_array("not_started", $statusArr) && !in_array("needs_edits", $statusArr) ) {        
        update_post_meta( $rel_post_id, 'wpcf-onboarding_account_status', '2' );
      } elseif ( $accountOnboardStatus != '1') {
        update_post_meta( $rel_post_id, 'wpcf-onboarding_account_status', '1' );
      }

      if ( $publishStatus != '1' ) {
        update_post_meta( $post_id, 'wpcf-prgm_account_status', '1' );
      }

    }


} // end process

function get_checkbox_value( $entry, $field_id ){

    //getting a comma separated list of selected values
    $lead_field_keys = array_keys( $entry );
    $items           = array();
    foreach ( $lead_field_keys as $input_id ) {
        if ( is_numeric( $input_id ) && absint( $input_id ) == $field_id ) {
            $items[] = GFCommon::selection_display( rgar( $entry, $input_id ), null, $entry['currency'], false );
        }
    }

    return $items;
}

function my_checkboxes_func($items = array(), $types_field = '') {
  $fields = WPCF_Fields::getFields();
  $arr = array();
  if(isset($fields[$types_field]['data']['options'])){
      foreach ($fields[$types_field]['data']['options'] as $k=> $v){
          if(in_array($v['set_value'], $items)){
              $arr[$k] = array($v['set_value']);
          }
      }
  }
  return $arr;
}

function my_multiselect_func($items = array(), $types_field = ''){
    $fields = WPCF_Fields::getFields();
    $arr = array();
      
      
    if(isset($fields[$types_field]['data']['options'])){
    
        foreach ($fields[$types_field]['data']['options'] as $k=> $v){
          if(in_array($v['set_value'], json_decode($items[0]??'[]'))){
            $arr[$k] = array($v['set_value']);
          }
        }
    }

    return $arr;
}