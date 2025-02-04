<?php

add_filter( 'gform_us_states', 'us_states' );
function us_states( $states ) {
    $new_states = array();
    foreach ( $states as $state ) {
        $new_states[ GF_Fields::get( 'address' )->get_us_state_code( $state ) ] = $state;
    }

    return $new_states;
}

// add_filter( 'gppa_get_input_values_3_10', function ( $value, $field, $template, $objects ) {
//
//
//   $value = types_render_field( "org_work_terms", array( "post_id"=>$post_id, "separator" => "," ) );
//
// 	return $value;
// }, 10, 4 );

// add_filter( 'gppa_get_input_values_3_10', function ( $value, $field, $template, $objects ) {
// 	$processed_values = array();
//
// 	foreach ( $objects as $object ) {
// 		$processed_values[] = gp_populate_anything()->process_template( $field, $template, $object, 'values', $objects );
// 	}
//
// 	return implode( ',', $processed_values );
// }, 10, 4 );

add_filter('gform_field_value_time_now', 'gw_now_time');
function gw_now_time() {
 return date('Y-m-d H:i:s');
}

add_filter( 'gform_replace_merge_tags', 'djb_gform_replace_merge_tags', 10, 7 );
/**
* Replace custom merge tags.
*
* @link https://docs.gravityforms.com/gform_replace_merge_tags/
*
* @param string  $text Current text in which merge tags are being replaced.
* @param object  $form Current Form object.
* @param object  $entry Current Entry object.
* @param boolean $url_encode Whether or not to encode any URLs found in the replaced value.
* @param boolean $esc_html Whether or not to encode HTML found in the replaced value.
* @param boolean $nl2br Whether or not to convert newlines to break tags.
* @param string  $format Determines how the value should be formatted. Default is html.
* @return string Modified data.
*/
function djb_gform_replace_merge_tags( $text, $form, $entry, $url_encode, $esc_html, $nl2br, $format ) {
if ( strpos( $text, '{current_date_time}' ) !== false ) {
$text = str_replace( '{current_date_time}', date("Y-m-d H:i:s"), $text );
}
return $text;
}

add_filter( 'gform_replace_merge_tags', 'jr_get_admins_replace_merge_tags', 10, 7 );
function jr_get_admins_replace_merge_tags( $text, $form, $entry, $url_encode, $esc_html, $nl2br, $format ) {
if ( strpos( $text, '{get_SP_admins}' ) !== false ) {
$text = str_replace( '{get_SP_admins}', 'user_id|'.types_render_field( 'org_details_administrators', array( ) ) , $text );
}
return $text;
}

add_filter( 'gform_pre_render_3', 'my_populate_checkbox' );

function my_populate_checkbox( $form ) {

  foreach( $form['fields'] as &$field ) {

    if( 10 === $field->id ) {

      foreach( $field->choices as &$choice ) {
         $theChecks = types_render_field( "org_work_terms", array( "separator" => "," ) );
         $checksArray = explode(',', $theChecks);
         if( in_array($choice['value'], $checksArray) ) {
           $choice['isSelected'] = true;
         }

      }
    }

    if( 12 === $field->id ) {

      foreach( $field->choices as &$choice ) {
         $theChecks = types_render_field( "org_jedi_initiatives", array( "separator" => "," ) );
         $checksArray = explode(',', $theChecks);
         if( in_array($choice['value'], $checksArray) ) {
           $choice['isSelected'] = true;
         }

      }
    }

  }
  // return the altered `$form` array to Gravity Forms
  return $form;

} // end: my_populate_checkbox

// // capture a GF checkbox field values and serialize so WP Types CPT can display checked properly
// add_action("gform_after_submission_3", "add_custom_post_meta", 10, 2);
// function add_custom_post_meta($entry, $form) {
//     $post_id = get_queried_object_id();
//     $arr = array(
//         array('org_work_terms', '10'),
//         array('org_jedi_initiatives', '12'),
//     );
//     foreach($arr as $v){
//         $items = get_checkbox_value( $entry, $v[1] );
//         $value = my_checkboxes_func($items, $v[0]);
//         update_post_meta($post_id, 'wpcf-' . $v[0], $value);
//     }
// }
//
// function get_checkbox_value( $entry, $field_id ){
//
//     //getting a comma separated list of selected values
//     $lead_field_keys = array_keys( $entry );
//     $items           = array();
//     foreach ( $lead_field_keys as $input_id ) {
//         if ( is_numeric( $input_id ) && absint( $input_id ) == $field_id ) {
//             $items[] = GFCommon::selection_display( rgar( $entry, $input_id ), null, $entry['currency'], false );
//         }
//     }
//
//     return $items;
// }
//
//
// function my_checkboxes_func($items = array(), $types_field = '') {
//     $fields = WPCF_Fields::getFields();
//     $arr = array();
//     if(isset($fields[$types_field]['data']['options'])){
//         foreach ($fields[$types_field]['data']['options'] as $k=> $v){
//             if(in_array($v['set_value'], $items)){
//                 $arr[$k] = array($v['set_value']);
//             }
//         }
//     }
//     return $arr;
// }
//
new GW_Update_Posts( array(
	'form_id' => 2,
	'post_id' => get_queried_object_id(),
	'meta'    => array(
    'wpcf-org_details_status' => 10,
    'wpcf-org_details_last_contributor' => 20,
    'wpcf-org_details_created' => 21,
    'wpcf-org_details_last_updated' => 22
	)
) );

new GW_Update_Posts( array(
	'form_id' => 3,
	'post_id' => get_queried_object_id(),
	'meta'    => array(
    'wpcf-org_mission_status' => 15,
    'wpcf-org_mission_created' => 20,
    'wpcf-org_mission_last_updated' => 19

	)
) );
