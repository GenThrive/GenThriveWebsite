<?php
/*require_once "custom-woo.php";
require_once "jr_navwalker.php";*/
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
