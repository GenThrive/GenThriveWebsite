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

const THEME_VER = 1.39;
if (!function_exists('tb_theme_enqueue_scripts')) :
    function tb_theme_enqueue_scripts()
    {

        /* Pinegrow generated Enqueue Scripts Begin */

        wp_enqueue_script('jquery', null, null, THEME_VER, true);

        wp_enqueue_script('popper', get_template_directory_uri() . '/a_js/popper.js', array('jquery'), THEME_VER, true);

        wp_enqueue_script('tb_theme-bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('popper'), THEME_VER, true);

        wp_enqueue_script('greensock', get_template_directory_uri() . '/a_js/greensock/gsap.min.js', array('wp-mediaelement'), THEME_VER, true);

        wp_enqueue_script('scrollTrigger', get_template_directory_uri() . '/a_js/greensock/ScrollTrigger.min.js', array('greensock'), THEME_VER, true);

        wp_enqueue_script('green_s_starters', get_template_directory_uri() . '/a_js/green_s_starters.js', array('scrollTrigger'), THEME_VER, true);

        wp_enqueue_script('anamate_green', get_template_directory_uri() . '/a_js/anamate_green.js', array('green_s_starters'), THEME_VER, true);

        wp_enqueue_script('jr_custom_js', get_template_directory_uri() . '/a_js/custom.js', array('anamate_green'), THEME_VER, true);
		wp_localize_script('jr_custom_js', 'service_provider_obj', array('ajax_url' => admin_url('admin-ajax.php')));

        /* Pinegrow generated Enqueue Scripts End */

        /* Pinegrow generated Enqueue Styles Begin */

        wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/bootstrap/css/bootstrap.css', null, 1.1, 'all');

        wp_enqueue_style('main-theme-css', get_template_directory_uri() . '/a_css/theme.css', array('bootstrap-css'), THEME_VER, 'all');

        wp_enqueue_style('non-pg-theme-css', get_template_directory_uri() . '/a_css/non-pg.css', array('bootstrap-css'), THEME_VER, 'all');

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

