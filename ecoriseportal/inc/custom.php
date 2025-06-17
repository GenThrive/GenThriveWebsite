<?php
require_once "genthrive-custom.php";
require_once "standard_nav.php";
require_once "mobile_locations.php";
// require_once "gw-update-posts.php";
// require_once "gfl-update-posts.php";
// require_once "forms_code.php";

define( 'DISALLOW_FILE_EDIT', true );

//custom shortcode to trim reviews for review slider
add_shortcode('trim', 'trim_shortcode');
function trim_shortcode($atts, $content = '') {
  $content = wpv_do_shortcode($content);
  $length = (int)$atts['length'];
  if (strlen($content) > $length) {
    $content = substr($content, 0, $length) . '&hellip;';
  }
  return $content;
}

/**
 * Add support for custom color palettes in Gutenberg.
 */
 $themeColors = array(
 		array(
 			'name'  => esc_html__( 'Primary', '@@textdomain' ),
 			'slug' => 'primary',
 			'color' => '#ff664b',
 		),
 		array(
 			'name'  => esc_html__( 'Secondary', '@@textdomain' ),
 			'slug' => 'secondary',
 			'color' => '#00A887',
 		),
 		array(
 			'name'  => esc_html__( 'Tertiary', '@@textdomain' ),
 			'slug' => 'tertiary',
 			'color' => '#FFC600',
 		),
 		array(
 			'name'  => esc_html__( 'White', '@@textdomain' ),
 			'slug' => 'white',
 			'color' => '#ffffff',
 		),array(
 			'name'  => esc_html__( 'Light Gray', '@@textdomain' ),
 			'slug' => 'gray-light',
 			'color' => '#CECECE',
 		),array(
 			'name'  => esc_html__( 'Medium Light Gray', '@@textdomain' ),
 			'slug' => 'gray-med-light',
 			'color' => '#A0A0A0',
 		),array(
 			'name'  => esc_html__( 'Medium Gray', '@@textdomain' ),
 			'slug' => 'gray-med',
 			'color' => '#747474',
 		),array(
 			'name'  => esc_html__( 'Medium Dark Gray', '@@textdomain' ),
 			'slug' => 'gray-med-dark',
 			'color' => '#4B4B4B',
 		),array(
 			'name'  => esc_html__( 'Dark Gray', '@@textdomain' ),
 			'slug' => 'gray-dark',
 			'color' => '#252525',
 		),array(
 			'name'  => esc_html__( 'Black', '@@textdomain' ),
 			'slug' => 'black',
 			'color' => '#000000',
 		),array(
 			'name'  => esc_html__( 'Transparent', '@@textdomain' ),
 			'slug' => 'transparent',
 			'color' => 'rgba(0, 0, 0, 0)',
 		)
 );

 function tiny_mce_custom() {
   global $themeColors;
   $results = '';
   $i = 1;
   $length = count($themeColors);
   foreach($themeColors as $innerArray){
       if ($i !== $length) {
         $results .= '"'.substr($innerArray['color'], 1) . '",' . '"' . $innerArray['name'] . '",';
       } else {
         $results .= '"'.substr($innerArray['color'], 1) . '",' . '"' . $innerArray['name'] . '"';
       }
       $i++;
   }
    return $results;
}
$custom_mc = tiny_mce_custom();
// echo $custom_mc;
function jr_gutenberg_color_palette() {
	global $themeColors;
	add_theme_support(
		'editor-color-palette', $themeColors
	);
}
add_action( 'after_setup_theme', 'jr_gutenberg_color_palette' );

function tb_mce4_options($init) {
  global $custom_mc;
  $default_colours = '"993300", "Burnt orange",
                      "333300", "Dark olive",
                      "003300", "Dark green",
                      "003366", "Dark azure",
                      "000080", "Navy Blue",
                      "333399", "Indigo",
                      "333333", "Very dark gray",
                      "800000", "Maroon",
                      "FF6600", "Orange",
                      "808000", "Olive",
                      "008000", "Green",
                      "008080", "Teal",
                      "0000FF", "Blue",
                      "666699", "Grayish blue",
                      "808080", "Gray",
                      "FF0000", "Red",
                      "FF9900", "Amber",
                      "99CC00", "Yellow green",
                      "339966", "Sea green",
                      "33CCCC", "Turquoise",
                      "3366FF", "Royal blue",
                      "800080", "Purple",
                      "999999", "Medium gray",
                      "FF00FF", "Magenta",
                      "FFCC00", "Gold",
                      "FFFF00", "Yellow",
                      "00FF00", "Lime",
                      "00FFFF", "Aqua",
                      "00CCFF", "Sky blue",
                      "993366", "Red violet",
                      "FF99CC", "Pink",
                      "FFCC99", "Peach",
                      "FFFF99", "Light yellow",
                      "CCFFCC", "Pale green",
                      "CCFFFF", "Pale cyan",
                      "99CCFF", "Light sky blue",
                      "CC99FF", "Plum"';

  // build colour grid default+custom colors
  $init['textcolor_map'] = '['.$custom_mc.','.$default_colours.']';

  // enable 6th row for custom colours in grid
  $init['textcolor_rows'] = 7;

  return $init;
}
add_filter('tiny_mce_before_init', 'tb_mce4_options');

// //AutoFill Search Code Ajax
// add_action('wp_enqueue_scripts', function() {
//
//   wp_enqueue_script('jquery-ui-autocomplete', '',
// 		['jquery'], null, true);
//
//   wp_localize_script('jquery-ui-autocomplete', 'AutocompleteSearch', [
//   		'ajax_url' => admin_url('admin-ajax.php'),
//   		'ajax_nonce' => wp_create_nonce('autocompleteSearchNonce')
//   	]);
// });
//
// add_action('wp_ajax_nopriv_autocompleteSearch', 'awp_autocomplete_search');
// add_action('wp_ajax_autocompleteSearch', 'awp_autocomplete_search');
// function awp_autocomplete_search() {
// 	check_ajax_referer('autocompleteSearchNonce', 'security');
//
// 	$search_term = $_REQUEST['term'];
// 	if (!isset($_REQUEST['term'])) {
// 		echo json_encode([]);
// 	}
//
// 	$suggestions = [];
// 	$query = new WP_Query([
//     's' => $search_term,
//     'post_type' => 'physicians',
//     'post_status' => 'publish',
// 		'posts_per_page' => -1,
// 	]);
// 	if ($query->have_posts()) {
// 		while ($query->have_posts()) {
// 			$query->the_post();
// 			$suggestions[] = [
// 				'label' => get_the_title()
// 			];
// 		}
// 		wp_reset_postdata();
// 	}
// 	echo json_encode($suggestions);
// 	wp_die();
// }

// function phoneNumberOnly() {
//   $string = (types_render_field( 'location-phone-number', array( 'output' => 'raw' ) ));
//   $res = preg_replace("/[^0-9]/", "", $string);
//   return $res;
// }
// add_shortcode('phoneOnly', 'phoneNumberOnly');

function jr_register_starter_blocks() {
  $template = array(
    array('wp-bootstrap-blocks/container', array( ), array (
      array('core/paragraph', array(
      'align' => 'center',
      'content' => 'This is a sample paragraph inside of a container block. All blocks in a container block will be contained in the center of the screen. Blocks outside of a container block will be full-width. You can overwrite this message or remove this block and add another block here in its place.',
    ))
    ))
  );
  $post_type_object = get_post_type_object( 'post' );
  $post_type_object->template = $template;
  $page_type_object = get_post_type_object( 'page' );
  $page_type_object->template = $template;
}
add_action( 'init', 'jr_register_starter_blocks',20 );

function jr_enqueue_block_editor_assets() {
  wp_enqueue_script( 'g_blocks', get_template_directory_uri() . '/a_js/g-blocks.js', array( 'wp-hooks' ), null, true );
}
add_action( 'enqueue_block_editor_assets', 'jr_enqueue_block_editor_assets' );

/** code to get a substring from a string */
function string_between_two_string($str, $starting_word = '["', $ending_word = '"]')
{
    $subtring_start = strpos($str, $starting_word);
    //Adding the starting index of the starting word to
    //its length would give its ending index
    $subtring_start += strlen($starting_word);
    //Length of our required sub string
    if($subtring_start > strlen($str))
    	$size = strpos($str, $ending_word, 0) - $subtring_start;
	else 
	    $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;
    // Return the substring from the index substring_start of length size
    return substr($str, $subtring_start, $size);
}

// Register Session Variables
// function register_session()
// {
//     if (!session_id()) {
//         session_start();
//     }
// }
// add_action('init', 'register_session');

// add_filter('gform_field_input_2_37', 'get_service_provider_id', 10, 5);
// function get_service_provider_id($input, $fields, $value, $lead_id, $form_id)
// {
//     $_SESSION['service_provider_id'] = $value;
//     return $input;
// }

// /**
//  * 
//  * function to display the organization logo dynamically on the org contact info form
//  * 
//  */

add_filter('gform_field_content', 'populate_org_logo', 10, 5);
function populate_org_logo($field_content, $field, $value, $lead_id, $form_id){
    if ($field->id == 35 && $field->formId == 2) { // **REPLACE WITH YOUR ACTUAL IDs**
        $service_provider_id = get_the_ID();
        $logo_string = get_post_meta($service_provider_id, 'wpcf-organization_logo', true);

        if ($logo_string !== "") {
            $logo_src = string_between_two_string($logo_string, '["', '"]');
            if ($logo_src) {
                $image_html = '<div id="logo-preview" style="position: relative;"><small>Current Logo</small><figure><img src="' . $logo_src . '" width="100px" height="100px"/></figure><div><small>Upload a New Logo Below to Replace This Logo</small></div></div>';
                return $image_html . $field_content; // Prepend the image HTML
            }
        }
    }
    return $field_content;
}


/**
 * 
 * 
 * function to store file upload field data
 * 
 */
add_action('gform_after_submission_2', 'save_file_upload_field', 10, 2);
function save_file_upload_field($entry, $form)
{
    //check if logo is being uploaded from the form
    $uploaded_files = json_decode(rgpost("gform_uploaded_files"));
    $is_file_uploaded = !empty($_FILES["input_35"]["name"]) || isset($uploaded_files->input_35);
    $service_provider_id = get_the_ID();
    if (metadata_exists('post', $service_provider_id, 'org_logo_hidden')) {
        $is_logo_hidden = get_post_meta($service_provider_id, 'org_logo_hidden', true);
    }
    if ($is_file_uploaded) {
        // do nothing extra
    } else if ($is_logo_hidden && $is_logo_hidden == 'yes' && !$is_file_uploaded) {
        // do nothing extra
    } else if ($entry['38'] && !$is_file_uploaded) {
        update_post_meta($service_provider_id, 'wpcf-organization_logo', '["' . $entry['38'] . '"]');
    }
}

// /**
//  * 
//  * 
//  * function to remove preview field
//  * 
//  */
// add_action('wp_ajax_remove_logo_preview', 'remove_logo_preview');
// add_action('wp_ajax_nopriv_remove_logo_preview', 'remove_logo_preview');

// function remove_logo_preview()
// {
//     $res = add_post_meta($_SESSION['service_provider_id'], 'org_logo_hidden', 'yes');
//     echo $res;
//     die();
// }

/**
 * 
 * 
 * function to save the user data on support form submission
 * 
 */
add_action('gform_after_submission_24', 'save_support_form_user_meta', 10, 2);
function save_support_form_user_meta($entry, $form)
{
    $org = $entry['6'];
    $email_type = $entry['3'];
    $phone = $entry['4'];
    $phone_type = $entry['5'];

    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        update_user_meta($user_id, 'wpcf-user_preferred_email', $email_type);
        update_user_meta($user_id, 'wpcf-user_phone', $phone);
        update_user_meta($user_id, 'wpcf-user_preferred_phone', $phone_type);
    }
}


/**
 * 
 *  function to check if the author of service provider is logged in or not. This will be used as a shortcode in toolset view 
 * 
 * */
add_action('wp', 'update_online_users_status');
function update_online_users_status()
{

    if (is_user_logged_in()) {

        // get the online users list
        if (($logged_in_users = get_transient('users_online')) === false) $logged_in_users = array();

        $current_user = wp_get_current_user();
        $current_user = $current_user->ID;
        $current_time = current_time('timestamp');

        if (!isset($logged_in_users[$current_user]) || ($logged_in_users[$current_user] < ($current_time - (15 * 60)))) {
            $logged_in_users[$current_user] = $current_time;
            set_transient('users_online', $logged_in_users, 30 * 60);
        }
    }
}

add_shortcode('author_is_user_logged_in', 'author_is_user_logged_in');
function author_is_user_logged_in($user_id)
{
    if (!$user_id) {
        $user_id =  get_the_author_meta('ID');
    }
    // get the online users list
    $logged_in_users = get_transient('users_online');
    $res = 0;
    // online, if (s)he is in the list and last activity was less than 15 minutes ago
    if (isset($logged_in_users[$user_id]) && ($logged_in_users[$user_id] > (current_time('timestamp') - (15 * 60)))) {
        $res = 1;
    };
    return $res;
}

/**
 * 
 * 
 * function to add shortcode to return first five elements in toolset view
 * 
 */
add_shortcode('get_five_elements', 'toolset_get_five_elements');
function toolset_get_five_elements($atts, $content)
{
    $string = do_shortcode($content);
	if(isset($atts['other_selected_value']))
    	$other_selected_value = do_shortcode($atts['other_selected_value']);
    $separator = $atts['separator'];
    $arr = explode(",", $string);
    $i = 0;
    $result = '';
    foreach ($arr as $value) {
        //if (str_contains($value, 'Other')) {
        if (str_contains($value, 'Other') && isset($other_selected_value)) {
            $value = $other_selected_value;
        }
        if ($i < 5) {
            if ($i == 0) {
                $result .= $value;
            } else {
                $result .= $separator . ' ' . $value;
            }
            $i++;
        } else if ($i == 5) {
            $result .= $atts['ellipses_text'];
            break;
        }
    }
    return $result;
}

/**
 * 
 * 
 * function to add shortcode to show organization logo through toolset view
 * 
 */
add_shortcode('show_organization_logo', 'toolset_show_organization_logo');
function toolset_show_organization_logo($atts, $content)
{
    // Check if the content starts with '[' and ends with ']'
    if ( str_starts_with( $content, '[' ) && str_ends_with( $content, ']' ) ) {
        // Remove the opening and closing brackets
        $content = substr( $content, 1, -1 );
    }

    return $content;
}

/**
 * 
 * 
 * function to add shortcode to get the link from the types field toolset
 * 
 */
add_shortcode('get_the_link', 'toolset_get_the_link');
function toolset_get_the_link($atts, $content)
{
    $link = do_shortcode($content);
    return $link;
}

/**
 * 
 * 
 * function to add shortcode to return first five elements in toolset view
 * 
 */
add_shortcode('trim_program_description', 'toolset_trim_program_description');
function toolset_trim_program_description($atts, $content)
{
    $desc = do_shortcode($content);
    $length = strlen($desc);
    $trimmed_content = substr($desc, 0, 119);
    if ($length >= 119) {
        $trimmed_content .= '...';
    }
    return $trimmed_content;
}

function manage_button_shortcode( $atts ) {
    // Set default attributes for the shortcode
    $atts = shortcode_atts(
        array(
            'url' => '#', // Default URL if not provided
        ),
        $atts,
        'manage_button'
    );

    $button_url = esc_url( $atts['url'] ); // Sanitize the URL

    // Check if the current page is NOT a single 'service-provider' post
    if ( ! is_singular( 'service-provider' ) ) {
        // Output the button HTML
        $output = '<div class="d-flex justify-content-end align-items-start flex-grow-1"><a class="btn btn-outline-primary" href="' . $button_url . '" target="_blank" rel="noopener noreferrer">Manage</a></div>';
        return $output;
    }

    // If it is a single 'service-provider' post, return nothing
    return '';
}
add_shortcode( 'manage_button', 'manage_button_shortcode' );

/**
 * 
 * 
 * function to archive a program from single service provider page
 * 
 */
add_action('wp_ajax_archive_program', 'archive_program');
add_action('wp_ajax_nopriv_archive_program', 'archive_program');

function archive_program()
{
    extract($_POST);
    $update_parameters = array(
        'ID' => $archive_program_id,
        'post_status' => 'draft'
    );
    $result = wp_update_post($update_parameters); 
    echo $result;
    die();
}

/**
 * 
 * 
 * function to unarchive a program from single service provider page
 * 
 */
add_action('wp_ajax_unarchive_program', 'unarchive_program');
add_action('wp_ajax_nopriv_unarchive_program', 'unarchive_program');

function unarchive_program()
{
    extract($_POST);
    $update_unarchive_parameters = array(
        'ID' => $unarchive_program_id,
        'post_status' => 'publish'
    );
    $result = wp_update_post($update_unarchive_parameters);
    echo $result;
    die();
}

//* Get the Contributor Name
function get_contributor_name_ajax_handler(){
    $id = $_GET['id'];
    if(!empty($id)){
        $user = get_userdata($id);
        echo (!empty($user->display_name)) ? $user->display_name : $user->user_login;
    }

	die();
}
add_action('wp_ajax_get_contributor_name', 'get_contributor_name_ajax_handler');
add_action('wp_ajax_nopriv_get_contributor_name', 'get_contributor_name_ajax_handler');

//* Get the Service Providers
function get_service_provider_names_ajax_handler(){
    global $wpdb;
    $search_term = isset($_GET['search_title']) ? trim($_GET['search_title']) : '';
    if($search_term !=''){
        $sp_names = array();
        $query = $wpdb->prepare(
            "SELECT `post_title` FROM `{$wpdb->posts}` WHERE `post_title` LIKE '%$search_term%' AND `post_status` = 'publish' AND `post_type` = 'service-provider'"
        );
        $results = $wpdb->get_results($query);
        if($results){
            foreach($results as $key => $resultItem){
                array_push($sp_names, $resultItem->post_title);
            }
            echo json_encode($sp_names);
        }else{
            echo 'not';
        }
    }
    die();
}
add_action('wp_ajax_get_sp_name', 'get_service_provider_names_ajax_handler');
add_action('wp_ajax_nopriv_get_sp_name', 'get_service_provider_names_ajax_handler');

function notif_indicator_ajax_handler(){
	$count = 0;
    if(is_user_logged_in()){
        $user_id = get_current_user_id();
        global $wpdb;
        $count = $wpdb->get_var( "SELECT count(gem.entry_id) as count FROM `wp_gf_entry` as ge,  `wp_gf_entry_meta` as gem WHERE ge.id = gem.entry_id AND gem.meta_key = 'workflow_user_id_".$user_id."' AND gem.meta_value = 'pending' AND ge.status = 'active'" );
    }
	
	echo $count;
    
	die();
}
add_action('wp_ajax_notif_indicator', 'notif_indicator_ajax_handler');
add_action('wp_ajax_nopriv_notif_indicator', 'notif_indicator_ajax_handler');

//define( 'DISALLOW_FILE_EDIT', true ); define( 'DISALLOW_FILE_MODS', true );

/**
 * Triggers a WP All Import URL with provided export key and ID as individual arguments.
 *
 * @param string $export_key The export key.
 * @param int    $export_id  The export ID.
 * @param string $action     The action to trigger ('trigger' or 'processing').
 */
function trigger_wp_all_import_url_callback_individual_args(string $export_key, int $export_id, string $action = 'trigger') {

    $trigger_url = add_query_arg(
        array(
            'export_key' => $export_key,
            'export_id'  => $export_id,
            'action'     => $action,
        ),
        home_url('wp-load.php')
    );

    wp_remote_get($trigger_url);

}
add_action('trigger_wp_all_import_export_hook', 'trigger_wp_all_import_url_callback_individual_args', 10, 3);

/**
 * Moves WP All Export files to the ABSPATH/wp-exported-files directory with a new filename.
 *
 * @param int               $export_id The ID of the export.
 * @param PMXE_Export_Record $exportObj The export record object.
 */
function move_eco_export_file_abspath(int $export_id, $exportObj) {
    if ($export_id == '127' || $export_id == '128' || $export_id == '129') {
        // Define the target directory using ABSPATH.
        $target_dir = ABSPATH . 'wp-exported-files' . DIRECTORY_SEPARATOR;

        // Check if the target directory exists and create it if it doesn't.
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                error_log('Error: Could not create the target directory: ' . $target_dir);
                return;
            }
        }

        // Check whether "Secure Mode" is enabled in All Export > Settings.
        $is_secure_export = PMXE_Plugin::getInstance()->getOption('secure');

        if (!$is_secure_export) {
            // Get filepath when 'Secure Mode' is off.
            $filepath = get_attached_file($exportObj->attch_id);
        } else {
            // Get filepath with 'Secure Mode' on.
            $filepath = wp_all_export_get_absolute_path($exportObj->options['filepath']);
        }

        // Get the original filename and extension.
        $original_filename = basename($filepath);
        $file_extension = pathinfo($original_filename, PATHINFO_EXTENSION);

        // Define the new filename.
        $new_filename_base = '';
        switch ($export_id) {
            case '127':
                $new_filename_base = 'service_providers';
                break;
            case '128':
                $new_filename_base = 'programs';
                break;
            case '129':
                $new_filename_base = 'partners';
                break;
            default:
                $new_filename_base = 'export-' . $export_id;
                break;
        }
        $new_filename = $new_filename_base . '_' . date('mdY') . '.' . $file_extension;

        // Move export file to the target directory with the new filename.
        $new_filepath = $target_dir . $new_filename;
        if (!rename($filepath, $new_filepath)) {
            error_log('Error: Could not move/rename export file for export ID ' . $export_id . ' from: ' . $filepath . ' to: ' . $new_filepath);
        }
    }
}
add_action('pmxe_after_export', 'move_eco_export_file_abspath', 10, 2);

//keep it going for longer cron reports
function wpae_continue_cron( $export_id, $exportObj ) {
    $export_key = "pMM5FrXBdg2I";
    $action = "processing";

    
    // Only run for export ID 12.
    if ( $export_id == '127' || $export_id == '128' || $export_id == '129') {

        $trigger_url = add_query_arg(
            array(
                'export_key' => $export_key,
                'export_id'  => $export_id,
                'action'     => $action,
            ),
            home_url('wp-load.php')
        );

        sleep(5);
    
        wp_remote_get($trigger_url);

    } 
}
add_action( 'pmxe_after_iteration', 'wpae_continue_cron', 10, 2 );


/**
 * Deletes files older than 7 days from the specified directory.
 */
add_action('delete_old_wp_exported_files_hook', 'delete_old_exported_files_cron');
function delete_old_exported_files_cron() {
    $directory = ABSPATH . 'wp-exported-files' . DIRECTORY_SEPARATOR;
    $retention_days = 7;
    $retention_timestamp = time() - ( $retention_days * 24 * 60 * 60 );

    if (is_dir($directory)) {
        $files_to_delete = [];

        $files = scandir($directory);
        $files = array_diff($files, array('.', '..'));

        foreach ($files as $file) {
            $filePath = $directory . $file;
            if (is_file($filePath)) {
                $modifiedTime = filemtime($filePath); // Use modification time for age check

                if ($modifiedTime < $retention_timestamp) {
                    $files_to_delete[] = $filePath;
                }
            }
        }

        if (!empty($files_to_delete)) {
            foreach ($files_to_delete as $filePathToDelete) {
                $filenameToDelete = basename($filePathToDelete);
                if (unlink($filePathToDelete)) {
                    error_log("Cron: Deleted old file: $filenameToDelete");
                } else {
                    error_log("Cron: Failed to delete file: $filenameToDelete");
                }
            }
        } else {
            error_log("Cron: No files older than " . $retention_days . " days found in: " . $directory);
        }
    } else {
        error_log("Cron: Directory not found: " . $directory);
    }
}

function redirect_sample_page_to_404() {
    if (is_page('sample-page')) { 
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
        include(get_404_template());
        exit();
    }
}
add_action('template_redirect', 'redirect_sample_page_to_404');

// wpv-user-reg-date shortcode
function format_reg_date_func($atts)
{
  $user_id = $atts['userid'];
  $format = $atts['format'];
  $reg_date = date($format, strtotime(get_userdata($user_id)->user_registered));
  return $reg_date;
}
add_shortcode( 'wpv-user-reg-date', 'format_reg_date_func');

function add_class_to_gf_submit_button( $button, $form ) {
    // Check if it's the admin backend to avoid affecting the form editor
    if ( is_admin() ) {
        return $button;
    }

    // Define an array of form IDs for which you want to add the class
    $target_form_ids = array( 14, 15, 17 ); // Replace with your actual form IDs

    // Check if the current form's ID is in our target array
    if ( in_array( $form['id'], $target_form_ids ) ) {
        // Define the class you want to add
        $new_class = 'btn btn-primary';

        // Use a regular expression to add the class to the input tag
        // This regex looks for an input tag and inserts the new class before the closing bracket.
        $modified_button = preg_replace( '/<input type=\'submit\'/', '<input type=\'submit\' class=\'' . $new_class . '\'', $button );

        // If you also want to wrap it in a div (as per previous request)
        $wrapped_button = '<div class="d-flex justify-content-between w-100 border-top pt-1"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' . $modified_button . '</div>';

        return $wrapped_button;

    } else {
        // If it's not one of the target forms, return the original button
        return $button;
    }
}
add_filter( 'gform_submit_button', 'add_class_to_gf_submit_button', 10, 2 );

/**
 * Retrieves the email addresses of users associated with a given set of service provider IDs and their count.
 *
 * @param array|string $service_provider_ids An array of service provider IDs or a comma-separated string of IDs.
 * @return array An associative array with 'emails' (array of user email addresses) and 'count' (number of unique emails).
 * Returns an array with empty 'emails' and 0 'count' if no users are found.
 */
function get_users_by_service_provider_ids($service_provider_ids) {
    $result = array(
        'emails' => array(),
        'count'  => 0,
    );

    if (empty($service_provider_ids)) {
        return $result;
    }

    // If a comma-separated string is passed, convert it to an array
    if (is_string($service_provider_ids)) {
        $service_provider_ids = array_map('trim', explode(',', $service_provider_ids));
        // Remove any empty strings that might result from explode (e.g., "1,,2")
        $service_provider_ids = array_filter($service_provider_ids);
    }

    // $service_provider_ids = array_map('intval', $service_provider_ids); // Uncomment if your meta field stores numbers

    $args = array(
        'meta_query' => array(
            array(
                'key'     => 'wpcf-user-s-service-provider-id',
                'value'   => $service_provider_ids,
                'compare' => 'IN', // Look for users where the meta value is IN the array of provided IDs
            ),
        ),
        'fields'     => 'user_email', // Only retrieve user email addresses
    );

    $user_query = new WP_User_Query($args);

    if (!empty($user_query->get_results())) {
        $user_emails = array();
        foreach ($user_query->get_results() as $user_email) {
            $user_emails[] = $user_email;
        }
        $result['emails'] = array_unique($user_emails); // Ensure unique emails
        $result['count'] = count($result['emails']);
    }

    return $result;
}

/**
 * Dynamically appends counts to Gravity Forms checkbox choices.
 *
 * This function hooks into gform_pre_render to modify the labels
 * of a specific checkbox field by re-querying for the necessary counts.
 *
 * @param array $form The form object.
 * @return array The modified form object.
 */
function custom_gf_append_counts_to_choices($form) {
    // Only apply this to your specific form (Form ID 23)
    if ($form['id'] != 23) {
        return $form;
    }

    $parentProviderID = types_render_usermeta( 'user-s-partner-org-id', array( 'user_current' => 'true' ) ); 
    $parentProviderID = ( !empty($parentProviderID) ) ? $parentProviderID : 0;

    $not_started_count = 0;
    $in_progress_count = 0;
    $complete_count = 0;
    $all_providers_count = 0; // Initialize for summed total

    if ($parentProviderID) {
        // Query for 'Not Started' (onboarding_account_status = 0)
        $args_not_started = array(
            'post_type'      => array('partner-organization', 'service-provider'),
            'meta_query'     => array(
                array(
                    'key'   => 'wpcf-onboarding_account_status',
                    'value' => '0',
                ),
            ),
            'fields'         => 'ids',
            'posts_per_page' => -1,
        );
        $query_not_started = new WP_Query($args_not_started);
        $not_started_ids = implode(',', $query_not_started->posts);
        $not_started_data = get_users_by_service_provider_ids($not_started_ids);
        $not_started_count = $not_started_data['count'];

        // Query for 'In Progress' (onboarding_account_status = 1)
        $args_in_progress = array(
            'post_type'      => array('partner-organization', 'service-provider'),
            'meta_query'     => array(
                array(
                    'key'   => 'wpcf-onboarding_account_status',
                    'value' => '1',
                ),
            ),
            'fields'         => 'ids',
            'posts_per_page' => -1,
        );
        $query_in_progress = new WP_Query($args_in_progress);
        $in_progress_ids = implode(',', $query_in_progress->posts);
        $in_progress_data = get_users_by_service_provider_ids($in_progress_ids);
        $in_progress_count = $in_progress_data['count'];

        // Query for 'Complete' (onboarding_account_status = 2)
        $args_complete = array(
            'post_type'      => array('partner-organization', 'service-provider'),
            'meta_query'     => array(
                array(
                    'key'   => 'wpcf-onboarding_account_status',
                    'value' => '2',
                ),
            ),
            'fields'         => 'ids',
            'posts_per_page' => -1,
        );
        $query_complete = new WP_Query($args_complete);
        $complete_ids = implode(',', $query_complete->posts);
        $complete_data = get_users_by_service_provider_ids($complete_ids);
        $complete_count = $complete_data['count'];

        // Calculate "All Service Providers" count by summing the individual status counts
        $all_providers_count = $not_started_count + $in_progress_count + $complete_count;
    }

    // Loop through form fields to find checkbox field ID 4
    foreach ($form['fields'] as &$field) {
        if ($field->id == 4 && $field->type == 'checkbox') {
            foreach ($field->choices as &$choice) {
                switch ($choice['text']) {
                    case 'Not Started':
                        $choice['text'] .= ' (' . $not_started_count . ')';
                        break;
                    case 'In Progress':
                        $choice['text'] .= ' (' . $in_progress_count . ')';
                        break;
                    case 'Completed':
                        $choice['text'] .= ' (' . $complete_count . ')';
                        break;
                    case 'All Service Providers':
                        $choice['text'] .= ' (' . $all_providers_count . ')';
                        break;
                }
            }
        }
    }

    return $form;
}
add_filter('gform_pre_render_23', 'custom_gf_append_counts_to_choices');

