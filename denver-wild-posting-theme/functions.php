<?php
/**
 * Denver Wild Posting Theme Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function denver_wild_posting_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'denver_wild_posting_setup');

// Enqueue styles and scripts
function denver_wild_posting_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('denver-wild-posting-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue custom JavaScript if needed
    wp_enqueue_script('denver-wild-posting-script', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'denver_wild_posting_scripts');

// Register navigation menus
function denver_wild_posting_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'denver-wild-posting'),
    ));
}
add_action('init', 'denver_wild_posting_menus');

// Custom post type for campaigns
function denver_wild_posting_campaigns_post_type() {
    $labels = array(
        'name'                  => 'Campaigns',
        'singular_name'         => 'Campaign',
        'menu_name'             => 'Campaigns',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Campaign',
        'edit_item'             => 'Edit Campaign',
        'new_item'              => 'New Campaign',
        'view_item'             => 'View Campaign',
        'search_items'          => 'Search Campaigns',
        'not_found'             => 'No campaigns found',
        'not_found_in_trash'    => 'No campaigns found in trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'campaigns'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-format-gallery',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    );

    register_post_type('campaign', $args);
}
add_action('init', 'denver_wild_posting_campaigns_post_type');

// Add custom fields for campaigns
function denver_wild_posting_add_campaign_meta_boxes() {
    add_meta_box(
        'campaign_details',
        'Campaign Details',
        'denver_wild_posting_campaign_meta_box_callback',
        'campaign',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'denver_wild_posting_add_campaign_meta_boxes');

function denver_wild_posting_campaign_meta_box_callback($post) {
    wp_nonce_field('denver_wild_posting_save_campaign_meta', 'denver_wild_posting_campaign_meta_nonce');
    
    $client = get_post_meta($post->ID, '_campaign_client', true);
    $city = get_post_meta($post->ID, '_campaign_city', true);
    $services = get_post_meta($post->ID, '_campaign_services', true);
    $year = get_post_meta($post->ID, '_campaign_year', true);
    $role = get_post_meta($post->ID, '_campaign_role', true);
    $metrics = get_post_meta($post->ID, '_campaign_metrics', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="campaign_client">Client</label></th>';
    echo '<td><input type="text" id="campaign_client" name="campaign_client" value="' . esc_attr($client) . '" size="50" /></td></tr>';
    
    echo '<tr><th><label for="campaign_city">City</label></th>';
    echo '<td><input type="text" id="campaign_city" name="campaign_city" value="' . esc_attr($city) . '" size="50" /></td></tr>';
    
    echo '<tr><th><label for="campaign_services">Services</label></th>';
    echo '<td><input type="text" id="campaign_services" name="campaign_services" value="' . esc_attr($services) . '" size="50" /></td></tr>';
    
    echo '<tr><th><label for="campaign_year">Year</label></th>';
    echo '<td><input type="number" id="campaign_year" name="campaign_year" value="' . esc_attr($year) . '" size="10" /></td></tr>';
    
    echo '<tr><th><label for="campaign_role">Role</label></th>';
    echo '<td><textarea id="campaign_role" name="campaign_role" rows="3" cols="50">' . esc_textarea($role) . '</textarea></td></tr>';
    
    echo '<tr><th><label for="campaign_metrics">Metrics</label></th>';
    echo '<td><textarea id="campaign_metrics" name="campaign_metrics" rows="3" cols="50">' . esc_textarea($metrics) . '</textarea></td></tr>';
    echo '</table>';
}

function denver_wild_posting_save_campaign_meta($post_id) {
    if (!isset($_POST['denver_wild_posting_campaign_meta_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['denver_wild_posting_campaign_meta_nonce'], 'denver_wild_posting_save_campaign_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array('campaign_client', 'campaign_city', 'campaign_services', 'campaign_year', 'campaign_role', 'campaign_metrics');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'denver_wild_posting_save_campaign_meta');

// Customizer settings
function denver_wild_posting_customize_register($wp_customize) {
    // Video Section
    $wp_customize->add_section('denver_wild_posting_video', array(
        'title'    => __('Homepage Video', 'denver-wild-posting'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('homepage_video_yt_id', array(
        'default'           => 'VmiR0JEcaYc',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('homepage_video_yt_id', array(
        'label'   => __('YouTube Video ID', 'denver-wild-posting'),
        'section' => 'denver_wild_posting_video',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('homepage_video_mp4', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('homepage_video_mp4', array(
        'label'   => __('MP4 Video URL (Alternative)', 'denver-wild-posting'),
        'section' => 'denver_wild_posting_video',
        'type'    => 'url',
    ));
}
add_action('customize_register', 'denver_wild_posting_customize_register');

// Helper function to get video settings
function get_homepage_video_settings() {
    return array(
        'yt_id' => get_theme_mod('homepage_video_yt_id', 'VmiR0JEcaYc'),
        'mp4'   => get_theme_mod('homepage_video_mp4', ''),
    );
}

/**
 * Retrieve predefined gallery images for specific campaigns by slug.
 *
 * @param string $slug Campaign post slug.
 * @return array Array of image URLs for the campaign gallery.
 */
function denver_wild_posting_get_campaign_gallery($slug) {
    $galleries = array(
        'meta-campaign-in-denver' => array(
            'https://ik.imagekit.io/1kunhjtuk/SLS_3767.jpeg?updatedAt=1759374242687',
            'https://ik.imagekit.io/1kunhjtuk/SLS_3847.jpeg?updatedAt=1759374242731',
            'https://ik.imagekit.io/1kunhjtuk/SLS_3849.jpeg?updatedAt=1759374242710',
            'https://ik.imagekit.io/1kunhjtuk/SLS_3890.jpeg?updatedAt=1759374242262',
            'https://ik.imagekit.io/1kunhjtuk/SLS_3753.jpeg?updatedAt=1759374241338',
            'https://ik.imagekit.io/1kunhjtuk/SLS_3855.jpeg?updatedAt=1759374239495',
            'https://ik.imagekit.io/1kunhjtuk/SLS_3587.jpeg?updatedAt=1759374237770',
            'https://ik.imagekit.io/1kunhjtuk/SLS_3891.jpeg?updatedAt=1759374237273',
            'https://ik.imagekit.io/1kunhjtuk/SLS_3859.jpeg?updatedAt=1759374236587',
            'https://ik.imagekit.io/1kunhjtuk/SLS_3571.jpeg?updatedAt=1759374231669',
            'https://ik.imagekit.io/1kunhjtuk/SLS_3582.jpeg?updatedAt=1759374230679',
            'https://ik.imagekit.io/1kunhjtuk/SLS_3826.jpeg?updatedAt=1759374211638',
            'https://ik.imagekit.io/1kunhjtuk/SLS_3580.jpeg?updatedAt=1759374204437',
            'https://ik.imagekit.io/1kunhjtuk/SLS_3637.jpeg?updatedAt=1759374203561',
        ),
    );

    $galleries = apply_filters('denver_wild_posting_campaign_galleries', $galleries);

    return isset($galleries[$slug]) ? $galleries[$slug] : array();
}
