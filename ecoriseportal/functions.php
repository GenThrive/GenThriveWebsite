<?php
if (!function_exists('tb_theme_setup')) :

    function tb_theme_setup()
    {

        /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
        /* Pinegrow generated Load Text Domain Begin */
        load_theme_textdomain('tb_theme', get_template_directory() . '/languages');
        /* Pinegrow generated Load Text Domain End */

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
     * Let WordPress manage the document title.
     */
        add_theme_support('title-tag');

        /*
     * Enable support for Post Thumbnails on posts and pages.
     */
        add_theme_support('post-thumbnails');
        //Support custom logo
        add_theme_support('custom-logo');

        // Add menus.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'tb_theme'),
            'social'  => __('Social Links Menu', 'tb_theme'),
        ));

        /*
     * Register custom menu locations
     */
        /* Pinegrow generated Register Menus Begin */

        register_nav_menu('mobile', __('Mobile Menu', 'tb_theme'));

        register_nav_menu('footer', __('Footer Menu', 'tb_theme'));

        /* Pinegrow generated Register Menus End */

        /*
    * Set image sizes
     */
        /* Pinegrow generated Image Sizes Begin */

        add_image_size('med_large', 690, 388, false);
        add_image_size('xl_large', 1340, 754, false);
        update_option('medium_large_size_w', 688);
        update_option('medium_large_size_h', 9999);
        update_option('medium_large_crop', 0);

        /* Pinegrow generated Image Sizes End */

        /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));

        /*
     * Enable support for Post Formats.
     */
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
        ));

        /*
     * Enable support for Page excerpts.
     */
        add_post_type_support('page', 'excerpt');
    }
endif; // tb_theme_setup

add_action('after_setup_theme', 'tb_theme_setup');


if (!function_exists('tb_theme_init')) :

    function tb_theme_init()
    {


        // Use categories and tags with attachments
        register_taxonomy_for_object_type('category', 'attachment');
        register_taxonomy_for_object_type('post_tag', 'attachment');

        /*
     * Register custom post types. You can also move this code to a plugin.
     */
        /* Pinegrow generated Custom Post Types Begin */

        /* Pinegrow generated Custom Post Types End */

        /*
     * Register custom taxonomies. You can also move this code to a plugin.
     */
        /* Pinegrow generated Taxonomies Begin */

        /* Pinegrow generated Taxonomies End */
    }
endif; // tb_theme_setup

add_action('init', 'tb_theme_init');


if (!function_exists('tb_theme_custom_image_sizes_names')) :

    function tb_theme_custom_image_sizes_names($sizes)
    {

        /*
     * Add names of custom image sizes.
     */
        /* Pinegrow generated Image Sizes Names Begin */

        return array_merge($sizes, array(
            'med_large' => __('Medium Large'),
            'xl_large' => __('Extra Large')
        ));

        /* Pinegrow generated Image Sizes Names End */
        return $sizes;
    }
    add_action('image_size_names_choose', 'tb_theme_custom_image_sizes_names');
endif; // tb_theme_custom_image_sizes_names



if (!function_exists('tb_theme_widgets_init')) :

    function tb_theme_widgets_init()
    {

        /*
     * Register widget areas.
     */
        /* Pinegrow generated Register Sidebars Begin */

        register_sidebar(array(
            'name' => __('Archive Widgets', 'tb_theme'),
            'id' => 'archive_widgets',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => __('Blog Archive Sidebar', 'tb_theme'),
            'id' => 'blog_arch_sidebar',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => __('Partner Org Genthrive Info', 'tb_theme'),
            'id' => 'gthrive_single_p',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => __('Shop Page Sidebar', 'tb_theme'),
            'id' => 'woo_shop',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));

        /* Pinegrow generated Register Sidebars End */
    }
    add_action('widgets_init', 'tb_theme_widgets_init');
endif; // tb_theme_widgets_init



if (!function_exists('tb_theme_customize_register')) :

    function tb_theme_customize_register($wp_customize)
    {
        // Do stuff with $wp_customize, the WP_Customize_Manager object.

        /* Pinegrow generated Customizer Controls Begin */

        $wp_customize->add_section('header', array(
            'title' => __('Header Settings', 'tb_theme')
        ));

        $wp_customize->add_section('social', array(
            'title' => __('Social Media Links', 'tb_theme')
        ));

        $wp_customize->add_section('contact_info', array(
            'title' => __('Contact Information', 'tb_theme')
        ));
        $pgwp_sanitize = function_exists('pgwp_sanitize_placeholder') ? 'pgwp_sanitize_placeholder' : null;

        $wp_customize->add_setting('header_header_img', array(
            'type' => 'theme_mod',
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'header_header_img', array(
            'label' => __('Header Image', 'tb_theme'),
            'type' => 'media',
            'mime_type' => 'image',
            'section' => 'header'
        )));

        $wp_customize->add_setting('fb_show', array(
            'type' => 'theme_mod',
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('fb_show', array(
            'label' => __('Show Facebook?', 'tb_theme'),
            'type' => 'checkbox',
            'section' => 'social'
        ));

        $wp_customize->add_setting('fb_link', array(
            'type' => 'theme_mod',
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('fb_link', array(
            'label' => __('Facebook Link', 'tb_theme'),
            'type' => 'url',
            'section' => 'social'
        ));

        $wp_customize->add_setting('yt_show', array(
            'type' => 'theme_mod',
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('yt_show', array(
            'label' => __('Show YouTube?', 'tb_theme'),
            'type' => 'checkbox',
            'section' => 'social'
        ));

        $wp_customize->add_setting('yt_link', array(
            'type' => 'theme_mod',
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('yt_link', array(
            'label' => __('YouTube Link', 'tb_theme'),
            'type' => 'url',
            'section' => 'social'
        ));

        $wp_customize->add_setting('li_show', array(
            'type' => 'theme_mod',
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('li_show', array(
            'label' => __('Show LinkedIn?', 'tb_theme'),
            'type' => 'checkbox',
            'section' => 'social'
        ));

        $wp_customize->add_setting('li_link', array(
            'type' => 'theme_mod',
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('li_link', array(
            'label' => __('LinkedIn Link', 'tb_theme'),
            'type' => 'url',
            'section' => 'social'
        ));

        $wp_customize->add_setting('tw_show', array(
            'type' => 'theme_mod',
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('tw_show', array(
            'label' => __('Show Twitter?', 'tb_theme'),
            'type' => 'checkbox',
            'section' => 'social'
        ));

        $wp_customize->add_setting('tw_link', array(
            'type' => 'theme_mod',
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('tw_link', array(
            'label' => __('Twitter Link', 'tb_theme'),
            'type' => 'url',
            'section' => 'social'
        ));

        $wp_customize->add_setting('insta_show', array(
            'type' => 'theme_mod',
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('insta_show', array(
            'label' => __('Show Instagram?', 'tb_theme'),
            'type' => 'checkbox',
            'section' => 'social'
        ));

        $wp_customize->add_setting('insta_link', array(
            'type' => 'theme_mod',
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('insta_link', array(
            'label' => __('Instagram Link', 'tb_theme'),
            'type' => 'url',
            'section' => 'social'
        ));

        $wp_customize->add_setting('contact_info_company_name', array(
            'type' => 'theme_mod',
            'default' => __('Tecnoideal America', 'tb_theme'),
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('contact_info_company_name', array(
            'label' => __('Company Name', 'tb_theme'),
            'type' => 'text',
            'section' => 'contact_info'
        ));

        $wp_customize->add_setting('contact_info_address1', array(
            'type' => 'theme_mod',
            'default' => __('7600 Standish Place', 'tb_theme'),
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('contact_info_address1', array(
            'label' => __('Address1', 'tb_theme'),
            'type' => 'text',
            'section' => 'contact_info'
        ));

        $wp_customize->add_setting('contact_info_address2', array(
            'type' => 'theme_mod',
            'default' => __('Suite', 'tb_theme'),
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('contact_info_address2', array(
            'label' => __('Address2', 'tb_theme'),
            'type' => 'text',
            'section' => 'contact_info'
        ));

        $wp_customize->add_setting('contact_info_city', array(
            'type' => 'theme_mod',
            'default' => __('Rockville', 'tb_theme'),
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('contact_info_city', array(
            'label' => __('City', 'tb_theme'),
            'type' => 'text',
            'section' => 'contact_info'
        ));

        $wp_customize->add_setting('contact_info_state', array(
            'type' => 'theme_mod',
            'default' => __('Maryland', 'tb_theme'),
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('contact_info_state', array(
            'label' => __('State', 'tb_theme'),
            'type' => 'text',
            'section' => 'contact_info'
        ));

        $wp_customize->add_setting('contact_info_zipcode', array(
            'type' => 'theme_mod',
            'default' => __('20855', 'tb_theme'),
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('contact_info_zipcode', array(
            'label' => __('Zipcode', 'tb_theme'),
            'type' => 'text',
            'section' => 'contact_info'
        ));

        $wp_customize->add_setting('contact_info_email', array(
            'type' => 'theme_mod',
            'default' => __('info@tecnoidealamerica.com', 'tb_theme'),
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('contact_info_email', array(
            'label' => __('Email Address', 'tb_theme'),
            'type' => 'text',
            'section' => 'contact_info'
        ));

        $wp_customize->add_setting('contact_info_email_link', array(
            'type' => 'theme_mod',
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('contact_info_email_link', array(
            'label' => __('Email Link', 'tb_theme'),
            'type' => 'url',
            'section' => 'contact_info'
        ));

        $wp_customize->add_setting('contact_info_phone', array(
            'type' => 'theme_mod',
            'default' => '(555) 403 4063',
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('contact_info_phone', array(
            'label' => __('Phone Number', 'tb_theme'),
            'type' => 'text',
            'section' => 'contact_info'
        ));

        $wp_customize->add_setting('contact_info_phone_link', array(
            'type' => 'theme_mod',
            'default' => __('tel:5554034063', 'tb_theme'),
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('contact_info_phone_link', array(
            'label' => __('Phone Number', 'tb_theme'),
            'type' => 'text',
            'section' => 'contact_info'
        ));

        $wp_customize->add_setting('contact_info_hours', array(
            'type' => 'theme_mod',
            'default' => __('M-F: 9am - 5pm', 'tb_theme'),
            'sanitize_callback' => $pgwp_sanitize
        ));

        $wp_customize->add_control('contact_info_hours', array(
            'label' => __('Hours', 'tb_theme'),
            'type' => 'text',
            'section' => 'contact_info'
        ));

        /* Pinegrow generated Customizer Controls End */
    }
    add_action('customize_register', 'tb_theme_customize_register');
endif; // tb_theme_customize_register


if (!function_exists('tb_theme_enqueue_scripts')) :
    function tb_theme_enqueue_scripts()
    {

        /* Pinegrow generated Enqueue Scripts Begin */

        wp_enqueue_script('jquery', null, null, null, true);

        wp_enqueue_script('popper', get_template_directory_uri() . '/a_js/popper.js', array('jquery'), null, true);

        wp_enqueue_script('tb_theme-bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('popper'), null, true);

        wp_enqueue_script('greensock', get_template_directory_uri() . '/a_js/greensock/gsap.min.js', array('wp-mediaelement'), null, true);

        wp_enqueue_script('scrollTrigger', get_template_directory_uri() . '/a_js/greensock/ScrollTrigger.min.js', array('greensock'), null, true);

        wp_enqueue_script('green_s_starters', get_template_directory_uri() . '/a_js/green_s_starters.js', array('scrollTrigger'), null, true);

        wp_enqueue_script('anamate_green', get_template_directory_uri() . '/a_js/anamate_green.js', array('green_s_starters'), null, true);

        wp_enqueue_script('jr_custom_js', get_template_directory_uri() . '/a_js/custom.js', array('anamate_green'), time(), true);
		wp_localize_script('jr_custom_js', 'service_provider_obj', array('ajax_url' => admin_url('admin-ajax.php')));

        /* Pinegrow generated Enqueue Scripts End */

        /* Pinegrow generated Enqueue Styles Begin */

        wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/bootstrap/css/bootstrap.css', null, null, 'all');

        wp_enqueue_style('main-theme-css', get_template_directory_uri() . '/a_css/theme.css', array('bootstrap-css'), null, 'all');

        wp_enqueue_style('tb_theme-allpro', get_template_directory_uri() . '/a_css/font-awesome/stylesheet/allpro.min.css', null, null, 'all');

        wp_deregister_style('tb_theme-style');
        wp_enqueue_style('tb_theme-style', get_bloginfo('stylesheet_url'), false, null, 'all');

        /* Pinegrow generated Enqueue Styles End */
    }
    add_action('wp_enqueue_scripts', 'tb_theme_enqueue_scripts');
endif;

function pgwp_sanitize_placeholder($input)
{
    return $input;
}
/*
 * Resource files included by Pinegrow.
 */
/* Pinegrow generated Include Resources Begin */
require_once "inc/custom.php";
require_once "inc/wp_pg_helpers.php";
require_once "inc/wp_smart_navwalker.php";

/* Pinegrow generated Include Resources End */

/* Enqueue Admin Styles and Scripts */

function tb_theme_selectively_enqueue_admin_script($page)
{

    // Don't edit anything between the following comments.
    /* Pinegrow generated Enqueue Admin Styles Begin */

    wp_enqueue_style('lazy_blocks_admin', get_template_directory_uri() . '/a_css/lazy-blocks/lazy-blocks-admin.css', null, null, 'all');

    /* Pinegrow generated Enqueue Admin Styles End */

    /* Pinegrow generated Enqueue Admin Scripts Begin */

    /* Pinegrow generated Enqueue Admin Scripts End */
}
add_action('admin_enqueue_scripts', 'tb_theme_selectively_enqueue_admin_script');

/* End Enqueue Admin Styles and Scripts */


/* Creating Editor Blocks with Pinegrow */

function tb_theme_blocks_init()
{
    // Register blocks. Don't edit anything between the following comments.
    /* Pinegrow generated Register Pinegrow Blocks Begin */
    require_once 'blocks/gb-section/gb-section_register.php';
    require_once 'blocks/plaincards/plaincards_register.php';
    require_once 'blocks/imglink/imglink_register.php';
    require_once 'blocks/link-arrow/link-arrow_register.php';
    require_once 'blocks/btn-outline/btn-outline_register.php';
    require_once 'blocks/btn-solid/btn-solid_register.php';

    /* Pinegrow generated Register Pinegrow Blocks End */
}
add_action('init', 'tb_theme_blocks_init');

/* End of creating Editor Blocks with Pinegrow */


/* Register Blocks Categories */

function tb_theme_register_blocks_categories($categories)
{

    // Don't edit anything between the following comments.
    /* Pinegrow generated Register Blocks Category Begin */

    $categories = array_merge($categories, array(array(
        'slug' => 'custblocks',
        'title' => __('Custom', 'tb_theme')
    )));

    /* Pinegrow generated Register Blocks Category End */

    return $categories;
}
add_action(version_compare('5.8', get_bloginfo('version'), '>=') ? 'block_categories_all' : 'block_categories', 'tb_theme_register_blocks_categories');

/* End of registering Blocks Categories */

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
function register_session()
{
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'register_session');

add_filter('gform_field_input_2_37', 'get_service_provider_id', 10, 5);
function get_service_provider_id($input, $fields, $value, $lead_id, $form_id)
{
    $_SESSION['service_provider_id'] = $value;
    return $input;
}

/**
 * 
 * function to display the organization logo dynamically on the org contact info form
 * 
 */

add_filter('gform_field_input_2_36', 'populate_org_logo', 10, 5);
function populate_org_logo($input, $field, $value, $lead_id, $form_id){
    if (isset($_SESSION['service_provider_id'])) {
        $service_provider_id = $_SESSION['service_provider_id'];
        $logo_string = get_post_meta($service_provider_id, 'wpcf-organization_logo', true);
    } else {
        $logo_string = ''; 
    }
    $logo_src = string_between_two_string($logo_string, '["', '"]');
    if ($logo_src) {
        $input = '<div id="logo-preview" style="position: relative;"><figure><img src="' . $logo_src . '" width="100px" height="100px"/></figure><img id="remove-preview" style="cursor: pointer; position: absolute;top: 5px;left: 80px;" src="/wp-content/uploads/2022/09/download.png" width="20px" height="20px" /></div>';
    }
    return $input;
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
    if (metadata_exists('post', $_SESSION['service_provider_id'], 'org_logo_hidden')) {
        $is_logo_hidden = get_post_meta($_SESSION['service_provider_id'], 'org_logo_hidden', true);
    }
    if ($is_file_uploaded) {
        // do nothing extra
    } else if ($is_logo_hidden && $is_logo_hidden == 'yes' && !$is_file_uploaded) {
        // do nothing extra
    } else if ($entry['38'] && !$is_file_uploaded) {
        update_post_meta($_SESSION['service_provider_id'], 'wpcf-organization_logo', '["' . $entry['38'] . '"]');
    }
}

/**
 * 
 * 
 * function to remove preview field
 * 
 */
add_action('wp_ajax_remove_logo_preview', 'remove_logo_preview');
add_action('wp_ajax_nopriv_remove_logo_preview', 'remove_logo_preview');

function remove_logo_preview()
{
    $res = add_post_meta($_SESSION['service_provider_id'], 'org_logo_hidden', 'yes');
    echo $res;
    die();
}

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
    $logo_src_string = do_shortcode($content);
    $logo_src = string_between_two_string($logo_src_string, '["', '"]');
    return stripslashes($logo_src);
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

// define( 'DISALLOW_FILE_EDIT', true ); define( 'DISALLOW_FILE_MODS', true );


//delete /www/genthrive_444/public/wp-exported-files files older than 7 days.

add_action('delete_old_wp_exported_files_hook','delete_old_exported_files_cron');
function delete_old_exported_files_cron(){
    $directory = ABSPATH."wp-exported-files";

    if (is_dir($directory)) {

        $files = scandir($directory);
        $files = array_diff($files, array('.', '..'));
        $fileCreationTimesPartners = array();
        $fileCreationTimesPrograms = array();
        $fileCreationTimesService_providers = array();

        foreach ($files as $file) {
            $filePath = $directory . DIRECTORY_SEPARATOR . $file;
                if (is_file($filePath)) {

                    $creationTime = filectime($filePath);
                    $formattedTime = date("Y-m-d", $creationTime);
                    
                    if(str_contains($file,"partners")){
                        $fileCreationTimesPartners[$file] = $creationTime;
                    }

                    if(str_contains($file,"programs")){
                        $fileCreationTimesPrograms[$file] = $creationTime;
                    }

                    if(str_contains($file,"service_providers")){
                        $fileCreationTimesService_providers[$file] = $creationTime;
                    }
                }
        }

        arsort($fileCreationTimesPartners);
        arsort($fileCreationTimesPrograms);
        arsort($fileCreationTimesService_providers);
       
        $recentFilesPartners = array_slice($fileCreationTimesPartners, 0, 7, true);
        $recentFilesPrograms = array_slice($fileCreationTimesPrograms, 0, 7, true);
        $recentFilesServiceProvider = array_slice($fileCreationTimesService_providers, 0, 7, true);

        foreach ($fileCreationTimesPartners as $file => $creationTime) {
            if (!isset($recentFilesPartners[$file])) {
                $filePath = $directory . DIRECTORY_SEPARATOR . $file;
                if (is_file($filePath)) {
                    if (unlink($filePath)) {
                        echo "Deleted: $file\n";
                    } else {
                        echo "Failed to delete: $file\n";
                    }
                }
            }
        }

        //program

        foreach ($fileCreationTimesPrograms as $file => $creationTime) {
            if (!isset($recentFilesPrograms[$file])) {
                $filePath = $directory . DIRECTORY_SEPARATOR . $file;
                if (is_file($filePath)) {
                    if (unlink($filePath)) {
                        echo "Deleted: $file\n";
                    } else {
                        echo "Failed to delete: $file\n";
                    }
                }
            }
        }

        //service provider

        foreach ($fileCreationTimesService_providers as $file => $creationTime) {
            if (!isset($recentFilesServiceProvider[$file])) {
                $filePath = $directory . DIRECTORY_SEPARATOR . $file;
                if (is_file($filePath)) {
                    if (unlink($filePath)) {
                        echo "Deleted: $file\n";
                    } else {
                        echo "Failed to delete: $file\n";
                    }
                }
            }
        }
    } 

}

add_action('init','run_delete_old_exported_files_cron');

function run_delete_old_exported_files_cron(){
    $request = isset($_REQUEST['cron_job']) ? $_REQUEST['cron_job'] : "";
    if($request == "yes"){
        echo do_action('delete_old_wp_exported_files_hook');
        exit;
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
