<?php
/*
Plugin Name: NewsBar
Description: A simple plugin to add a news bar with custom text and link options.
Version: 1.1
Author: Fabio Bellisario
*/

// Create a settings page
function newsbar_add_settings_page() {
    add_options_page(
        'NewsBar Settings',
        'NewsBar',
        'manage_options',
        'newsbar',
        'newsbar_render_settings_page'
    );
}
add_action('admin_menu', 'newsbar_add_settings_page');

// Render the settings page
function newsbar_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>NewsBar Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('newsbar_options_group');
            do_settings_sections('newsbar');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register and define the settings
function newsbar_register_settings() {
    register_setting('newsbar_options_group', 'newsbar_text', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '',
    ]);
    register_setting('newsbar_options_group', 'newsbar_link_label', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '',
    ]);
    register_setting('newsbar_options_group', 'newsbar_link_url', [
        'type' => 'string',
        'sanitize_callback' => 'esc_url_raw',
        'default' => '',
    ]);
    register_setting('newsbar_options_group', 'newsbar_link_target', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '_self',
    ]);

    add_settings_section(
        'newsbar_main_section',
        'Main Settings',
        null,
        'newsbar'
    );

    add_settings_field(
        'newsbar_text_field',
        'NewsBar Text (Max 60 characters)',
        'newsbar_text_field_callback',
        'newsbar',
        'newsbar_main_section'
    );
    add_settings_field(
        'newsbar_link_label_field',
        'Link Label (Max 15 characters)',
        'newsbar_link_label_field_callback',
        'newsbar',
        'newsbar_main_section'
    );
    add_settings_field(
        'newsbar_link_url_field',
        'Link URL',
        'newsbar_link_url_field_callback',
        'newsbar',
        'newsbar_main_section'
    );
    add_settings_field(
        'newsbar_link_target_field',
        'Link Target',
        'newsbar_link_target_field_callback',
        'newsbar',
        'newsbar_main_section'
    );
}
add_action('admin_init', 'newsbar_register_settings');

// Callback for the text field
function newsbar_text_field_callback() {
    $value = get_option('newsbar_text', '');
    echo '<input type="text" id="newsbar_text" name="newsbar_text" value="' . esc_attr($value) . '" size="60" maxlength="60" />';
}

// Callback for the link label field
function newsbar_link_label_field_callback() {
    $value = get_option('newsbar_link_label', '');
    echo '<input type="text" id="newsbar_link_label" name="newsbar_link_label" value="' . esc_attr($value) . '" size="15" maxlength="15" />';
}

// Callback for the link URL field
function newsbar_link_url_field_callback() {
    $value = get_option('newsbar_link_url', '');
    echo '<input type="url" id="newsbar_link_url" name="newsbar_link_url" value="' . esc_attr($value) . '" size="40" />';
}

// Callback for the link target field
function newsbar_link_target_field_callback() {
    $value = get_option('newsbar_link_target', '_self');
    echo '<select id="newsbar_link_target" name="newsbar_link_target">
            <option value="_self"' . selected($value, '_self', false) . '>Same Tab (_self)</option>
            <option value="_blank"' . selected($value, '_blank', false) . '>New Tab (_blank)</option>
        </select>';
}

// Function to display the NewsBar
function display_newsbar() {
    $newsbar_text = get_option('newsbar_text', '');
    $newsbar_link_label = get_option('newsbar_link_label', '');
    $newsbar_link_url = get_option('newsbar_link_url', '');
    $newsbar_link_target = get_option('newsbar_link_target', '_self');

    if (!empty($newsbar_text)) {
        echo '<div class="news-bar">' . esc_html($newsbar_text);
        if (!empty($newsbar_link_label)) {
            if (!empty($newsbar_link_url)) {
                echo ' <a href="' . esc_url($newsbar_link_url) . '" target="' . esc_attr($newsbar_link_target) . '">' . esc_html($newsbar_link_label) . ' &#8250;</a>';
            } else {
                echo ' ' . esc_html($newsbar_link_label);
            }
        }
        echo '</div>';
    }
}

// Add settings link on plugin page
function newsbar_settings_link($links) {
    $settings_link = '<a href="options-general.php?page=newsbar">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'newsbar_settings_link');
