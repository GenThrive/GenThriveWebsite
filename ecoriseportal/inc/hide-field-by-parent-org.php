<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Custom Checkboxes for Hiding Fields by Parent Org
add_action( 'gform_field_advanced_settings', 'my_advanced_settings', 10, 2 );
function my_advanced_settings( $position, $form_id ) {

  $forms = array( 2,3,4,5,6,25 );

    //create settings on position 50 (right after Admin Label)
    //if ( $position == 50 ) {
    if ( $position == 400 && in_array( $form_id, $forms )) {

      ?>
        <li class="post_meta_field field_setting">
          <label for="field_post_meta_match_input">
            <?php _e('Enter Post Meta Field to Update', 'genthrive-custom'); ?>
            <?php gform_tooltip('form_field_postMetaMatch'); ?>
          </label>
          <input type="text" id="field_post_meta_match_input" onchange="SetFieldProperty('postMetaMatch', this.value);" class="fieldwidth-3" />
        </li>

        <li class="restrict_setting field_setting">
            <input type="checkbox" id="field_restrict_value" onclick="SetFieldProperty('restrictField', this.checked);" />
            <label for="field_restrict_value" style="display:inline;">
                <?php //_e("Only Show for Specific Parent Orgs?", "genthrive-custom"); ?>
                <?php _e("Specify Partner Organizations?", "genthrive-custom"); ?>
                <?php gform_tooltip("form_field_restrict_value") ?>
            </label>
        </li>

            <?php
      //$args = array( 'post_type' => 'partner-organization', 'post_status' => 'publish');
      $args = array( 'post_type' => 'partner-organization', 'post_status' => 'publish', 'numberposts' => -1);
      $posts = get_posts($args);
      // var_dump($posts);
      
      if(count($posts) > 0)
		  echo '<li class="with-po-fields" style="display: none;">
		  	<ul class="po-fields" style="max-height: 220px; overflow-y: scroll;">';
		
      foreach ( $posts as $post ) {
        $ID_slug = 'parent_'.$post->ID;
        $postTitle = $post->post_title;

      	echo '<li class="hide_'.$ID_slug.'_setting show_parent field_setting">
            <input type="checkbox" id="field_'.$ID_slug.'_value" onclick="SetFieldProperty('; echo "'".$ID_slug."'"; echo', this.checked);" />
            <label for="field_'.$ID_slug.'_value" style="display:inline;">';
                //_e("Show on $postTitle?", "genthrive-custom");
                _e("$postTitle?", "genthrive-custom");
                gform_tooltip("form_field_'.$ID_slug.'_value");
            echo '</label>
        </li>';

      }
		
	  if(count($posts) > 0)
		  echo '</ul>
		  	</li>';

  }
}
//Action to inject supporting script to the form editor page
add_action( 'gform_editor_js', 'editor_script' );
function editor_script(){
  ?>
  <script type='text/javascript'>

      //adding setting to fields of type "text"
      jQuery.each(fieldSettings, function(index, value) {
         fieldSettings[index] += ", .restrict_setting, .post_meta_field";
       });


      //binding to the load field settings event to initialize the checkbox
      jQuery(document).on("gform_load_field_settings", function(event, field, form){
          jQuery( '#field_restrict_value' ).prop( 'checked', Boolean( rgar( field, 'restrictField' ) ) );
          jQuery("#field_post_meta_match_input").val(field["postMetaMatch"]);
		  
		  if(Boolean( rgar( field, 'restrictField' ) )){
			  jQuery('.with-po-fields').show(); 
		  }else{
			  jQuery('.with-po-fields').hide(); 
		  }
      });
	  
	  //added
	  jQuery('#field_restrict_value').click(function(){
		  if (jQuery(this).is(':checked')){
		  	jQuery(this).parents('#advanced_tab').find('.with-po-fields').show();  
		  }
		  else{
			jQuery(this).parents('#advanced_tab').find('.with-po-fields').hide();
		  }
	  });
  </script>
  <?php

  //$args = array( 'post_type' => 'partner-organization', 'post_status' => 'publish');
  $args = array( 'post_type' => 'partner-organization', 'post_status' => 'publish', 'numberposts' => -1);
  $posts = get_posts($args);
  foreach ( $posts as $post ) {
    $ID_slug = 'parent_'.$post->ID;
    $postTitle = $post->post_title;
    echo "<script type='text/javascript'>";
        //adding setting to fields of type "text"
        // fieldSettings.all += ", .texas_setting";
        echo 'jQuery.each(fieldSettings, function(index, value) {
           fieldSettings[index] += ", .hide_'.$ID_slug.'_setting";
         });';
        //binding to the load field settings event to initialize the checkbox
        echo 'jQuery(document).on("gform_load_field_settings", function(event, field, form){
            '; echo "jQuery( '#field_".$ID_slug."_value' ).prop( 'checked', Boolean( rgar( field, '".$ID_slug."' ) ) );
        });
    </script> ";
    }
}

//Filter to add a new tooltip
add_filter( 'gform_tooltips', 'hide_by_parent_tooltips' );
function hide_by_parent_tooltips( $tooltips ) {
    $tooltips['form_field_restrict_value'] = "<strong>Restrict Field</strong>Check this box to enable this field to only be shown for specific Partner Organizations.";
    $tooltips['form_field_postMetaMatch'] = __('<strong>Post Meta Fieild</strong>If this gravity form field updates the organization\'s post meta field then enter the full meta field slug here', 'genthrive-custom');
    //$args = array( 'post_type' => 'partner-organization', 'post_status' => 'publish');
    $args = array( 'post_type' => 'partner-organization', 'post_status' => 'publish', 'numberposts' => -1);
	$posts = get_posts($args);

    foreach ( $posts as $post ) {
      $ID_slug = 'parent_'.$post->ID;
      $postTitle = $post->post_title;

      $tooltips["form_field_'.$ID_slug.'_value"] = "<strong>Hide On $postTitle Forms</strong>Check this box to only show this field on $postTitle Forms";
  }
    return $tooltips;
}

if ( ! is_admin() ) {

  add_filter( 'gform_pre_render', 'hide_by_parent' );
  function hide_by_parent( $form ) {

    $forms = array( 3,2,4,5,6,25 );
    $post_id = get_the_ID();
    if($post_id == 0){ 
      return $form;
    }
    if ( in_array( $form['id'], $forms ) && (!empty($post_id)) ) {

      //added for the programs...	
	  if( get_post_type( $post_id ) == 'program' ){
		  $post_id = toolset_get_related_post( $post_id, "service-provider-program" );
	  }
    if($post_id == 0){ 
      return $form;
    }
      $post_rel_parent = toolset_get_related_post( $post_id, "partner-to-program-provider" );
      //var_dump($post_id);
      //$args = array( 'post_type' => 'partner-organization', 'post_status' => 'publish');
      $args = array( 'post_type' => 'partner-organization', 'post_status' => 'publish', 'numberposts' => -1);
	   $p_posts = get_posts($args);
      $p_items = array();
      foreach ( $p_posts as $post ) {
        $ID_slug = 'parent_'.$post->ID;

        $p_items[] = $ID_slug;
      }
      // var_dump($p_items);

      $fields = $form['fields'];
      // var_dump($fields);

      foreach( $p_items as $p_item ) {
        //$myParent = substr($p_item, -3);
        $myParent = str_replace('parent_', '', $p_item);
        // var_dump($myParent);
        foreach( $form['fields'] as $field ) {
          if ( $field->restrictField == true ) {
			  //echo $field->$p_item."-".$post_rel_parent."-".$myParent."<br>";
            if ( $field->$p_item !== true && $post_rel_parent == $myParent) {
              $field->cssClass = 'gf_invisible';
            }
          }

      }
    }
      return $form;
    }
    //end if in form array
    else {
      return $form;
    }
  }

} //end if admin

add_filter( 'gform_field_validation', 'invalidate_by_parent', 10, 4  );
function invalidate_by_parent( $result, $value, $form, $field ) {

  $forms = array( 3,2,4,5,6,25 );

  if ( in_array( $form['id'], $forms ) ) {


    //Creating item array.
    // $items = array();
    $post_id = get_the_ID();
	  if($post_id == 0){ 
      return $result;
    }
	//added for the programs...	
	if( get_post_type( $post_id ) == 'program' ){
		$post_id = toolset_get_related_post( $post_id, "service-provider-program" );
	}
  if($post_id == 0){ 
    return $result;
  }
    $post_rel_parent = toolset_get_related_post( $post_id, "partner-to-program-provider" );
    // var_dump($post_rel_parent);

    //$args = array( 'post_type' => 'partner-organization', 'post_status' => 'publish');
    $args = array( 'post_type' => 'partner-organization', 'post_status' => 'publish', 'numberposts' => -1);
	$p_posts = get_posts($args);

    $p_items = array();

    foreach ( $p_posts as $post ) {
      $ID_slug = 'parent_'.$post->ID;

      $p_items[] = $ID_slug;
    }
    // var_dump($p_items);

    $fields = $form['fields'];
    // var_dump($fields);

    foreach( $p_items as $p_item ) {
      //$myParent = substr($p_item, -3);
      $myParent = str_replace('parent_', '', $p_item);
	  // var_dump($myParent);
      foreach( $form['fields'] as $field ) {
        if ( $field->restrictField == true ) {
          if ( $field->$p_item !== true && $post_rel_parent == $myParent) {
              if ( $result['is_valid'] == false) {
                $result['is_valid'] = true;
              }
          }
        }

    }
  }


    return $result;

  }//end if in form array
  else {
    return $result;
  }
}