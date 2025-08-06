<?php
	/**
	 * Bootstrap on Wordpress functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
	 * @package 	WordPress
	 * @subpackage 	Bootstrap 5.3.2
	 * @autor 		Babobski
	 */

	define('BOOTSTRAP_VERSION', '5.3.2');
	define('BOOTSTRAP_ICON_VERSION', '1.11.2');

	/* ========================================================================================================================

	01. Add language support to theme

	======================================================================================================================== */

	add_action('after_setup_theme', 'my_theme_setup');

	function my_theme_setup(){
		load_theme_textdomain('wp_babobski', get_template_directory() . '/language');
	}

	/* ========================================================================================================================

	02. Required external files

	======================================================================================================================== */

	require_once( 'external/bootstrap-utilities.php' );
	require_once( 'external/bs5navwalker.php' );

	/* ========================================================================================================================

    03. Add html 5 support to wordpress elements

	======================================================================================================================== */

	add_theme_support( 'html5', [
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	]);

	/* ========================================================================================================================

	04. Theme specific settings

	======================================================================================================================== */

	add_theme_support('post-thumbnails');

	//add_image_size( 'name', width, height, crop true|false );

	register_nav_menus([
		'primary' => 'Primary Navigation'
	]);

	// Add custom cut sizes for the media library

	function custom_image_sizes() {
		add_image_size('square-thumb', 150, 150, true);
		add_image_size('square-medium', 540, 540, true);
		add_image_size('square-large', 1080, 1080, true);
		add_image_size('hero-small', 1280, 250, true);
		add_image_size('hero-medium', 1920, 375, true);
		add_image_size('hero-large', 2560, 500, true);
	}
	add_action('after_setup_theme', 'custom_image_sizes');

	

	/* ========================================================================================================================

	05. Actions and Filters

	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'bootstrap_script_init' );

	$BsWp = new BsWp;
	add_filter( 'body_class', [$BsWp, 'add_slug_to_body_class'] );

	/* Hook into wp_head */
	add_action('wp_head', 'include_googlefonts'); 
	function include_googlefonts() {
		echo "<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>";
	}

	/* ========================================================================================================================

	06. Custom Post Types - include custom post types and taxonomies here

	======================================================================================================================== */

	function create_custom_post_types() {
		register_post_type('faq',
			array(
				'labels' => array(
					'name' => __('FAQs'),
					'singular_name' => __('FAQ'),
					'add_new' => __('Add New FAQ'),
					'add_new_item' => __('Add New FAQ'),
					'edit_item' => __('Edit FAQ'),
					'new_item' => __('New FAQ'),
					'view_item' => __('View FAQ'),
					'search_items' => __('Search FAQs'),
					'not_found' => __('No FAQs found'),
					'not_found_in_trash' => __('No FAQs found in Trash')
				),
				'public' => true,
				'has_archive' => true,
				'supports' => array('title', 'editor', 'page-attributes'),
				'rewrite' => array('slug' => 'faqs'),
				'show_in_rest' => true // This enables Gutenberg/block editor support
			)
		);
		register_post_type('content_blocks',
			array(
				'labels' => array(
					'name' => __('Content Blocks'),
					'singular_name' => __('Content Block'),
					'add_new' => __('Add New Content Block'),
					'add_new_item' => __('Add New Content Block'),
					'edit_item' => __('Edit Block'),
					'new_item' => __('New Block'),
					'view_item' => __('View Block'),
					'search_items' => __('Search Content Blocks'),
					'not_found' => __('No Blocks found'),
					'not_found_in_trash' => __('No Blocks found in Trash')
					
				),
				'public' => true,
				'has_archive' => true,
				'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'tags'),
				'rewrite' => array('slug' => 'content-blocks'),
				'show_in_rest' => true, // This enables Gutenberg/block editor support
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'taxonomies' => array( 'category', 'post_tag' )
			)
		);
	}
	add_action('init', 'create_custom_post_types');

	function add_slug_to_content_block_title($title, $id) {
		if (!is_admin() && get_post_type($id) === 'content_blocks') {
			$post_slug = get_post_field('post_name', $id); // Get post slug
			return '<h2 id="' . esc_attr($post_slug) . '" class="content-block-title ' . esc_attr($post_slug) . '">' . esc_html($title) . '</h2>';
		}
		return $title;
	}
	add_filter('the_title', 'add_slug_to_content_block_title', 10, 2);	
	
	

	/* ========================================================================================================================

	07. Scripts

	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	if ( !function_exists( 'bootstrap_script_init' ) ) {
		function bootstrap_script_init() {

			// Get theme version number (located in style.css)
			$theme = wp_get_theme();

			// Get the last modified time on style.css.
			$int_unixtime_style_modified = filemtime(  get_stylesheet_directory() . '/style.css' );

			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', [ 'jquery' ], BOOTSTRAP_VERSION, true );
			wp_enqueue_script( 'site', get_template_directory_uri() . '/js/app.js', [ 'jquery', 'bootstrap' ], $int_unixtime_style_modified, true );

			// We'll include the Bootstrap CSS we want in this project using node-sass, so no need to declare use of these CSS files.
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', [], BOOTSTRAP_VERSION, 'all' );
			wp_enqueue_style( 'bootstrap_icons', get_template_directory_uri() . '/css/bootstrap-icons.min.css', [], BOOTSTRAP_ICON_VERSION, 'all' );
			wp_enqueue_style( 'screen', get_template_directory_uri() . '/style.css', [], $int_unixtime_style_modified, 'screen' );
		}
	}

	/* ========================================================================================================================

	08. Security & cleanup wp admin

	======================================================================================================================== */

	//remove wp version
	function theme_remove_version() {
		return '';
	}

	add_filter('the_generator', 'theme_remove_version');

	//remove default footer text
	function remove_footer_admin () {
		echo "";
	}

	add_filter('admin_footer_text', 'remove_footer_admin');

	// Remove default Dashboard widgets
	if ( !function_exists( 'disable_default_dashboard_widgets' ) ) {
		function disable_default_dashboard_widgets() {

			remove_meta_box('dashboard_activity', 'dashboard', 'core');
			remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
			remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
			remove_meta_box('dashboard_plugins', 'dashboard', 'core');
	
			remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
			remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
			remove_meta_box('dashboard_primary', 'dashboard', 'core');
			remove_meta_box('dashboard_secondary', 'dashboard', 'core');
		}
	}
	add_action('admin_menu', 'disable_default_dashboard_widgets');

	remove_action('welcome_panel', 'wp_welcome_panel');

	// Disable the emoji's
	if ( !function_exists( 'disable_emojis' ) ) {
		function disable_emojis() {
			remove_action('wp_head', 'print_emoji_detection_script', 7);
			remove_action('admin_print_scripts', 'print_emoji_detection_script');
			remove_action('wp_print_styles', 'print_emoji_styles');
			remove_action('admin_print_styles', 'print_emoji_styles');
			remove_filter('the_content_feed', 'wp_staticize_emoji');
			remove_filter('comment_text_rss', 'wp_staticize_emoji');
			remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

			// Remove from TinyMCE
			add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
		}
	}
	add_action('init', 'disable_emojis');

	// Filter out the tinymce emoji plugin.
	function disable_emojis_tinymce($plugins) {
		if (is_array($plugins)) {
			return array_diff($plugins, array('wpemoji'));
		} else {
			return [];
		}
	}

	add_action('admin_head', 'custom_logo_guttenberg');

	if ( !function_exists( 'custom_logo_guttenberg' ) ) {
		function custom_logo_guttenberg() {
			echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').
			'/css/admin-custom.css?v=1.0.0" />';
		}
	}

	if ( is_user_logged_in() ) {
	    show_admin_bar(true);
	}

	/* ========================================================================================================================

	09. Disabling Guttenberg

	======================================================================================================================== */

	// Optional disable guttenberg block editor
	// add_filter( 'use_block_editor_for_post', '__return_false' );


	//Remove Gutenberg Block Library CSS from loading on the frontend
	// function smartwp_remove_wp_block_library_css() {
	// 	wp_dequeue_style('wp-block-library');
	// 	wp_dequeue_style('wp-block-library-theme');
	// 	wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS
	// wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront 
	// }
	// add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);

	/* ========================================================================================================================

	10. Custom login

	======================================================================================================================== */

	// Add custom css
	if ( !function_exists( 'my_custom_login' ) ) {
		function my_custom_login() {
			echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/custom-login-style.css?v=1.0.0" />';
		}
	}
	add_action('login_head', 'my_custom_login');

	// Link the logo to the home of our website
	if ( !function_exists( 'my_login_logo_url' ) ) {
		function my_login_logo_url() {
			return get_bloginfo( 'url' );
		}
	}
	add_filter( 'login_headerurl', 'my_login_logo_url' );

	// Change the title text
	if ( !function_exists( 'my_login_logo_url_title' ) ) {
		function my_login_logo_url_title() {
			return get_bloginfo( 'name' );
		}
	}
	add_filter( 'login_headertext', 'my_login_logo_url_title' );

	/* ========================================================================================================================

	11. Comments

	======================================================================================================================== */

	if (is_admin()) {
		// Add the meta box
		function add_custom_meta_boxes() {

			// Add second featured image option for events
			add_meta_box(
				'second_featured_image_meta_box', // ID
				'Square Featured image', // Title
				'second_featured_image_meta_box_callback', // Callback
				'tribe_events', // Post type
				'side', // Context
				'low' // Priority
			);
			add_meta_box(
				'custom_meta_box_1', // Unique ID
				'Event Link 1', // Box title
				'display_custom_meta_box_1', // Content callback, must be of type callable
				'tribe_events', // Post type
				'normal', // Context
				'high', // Priority
				array('__back_compat_meta_box' => false) // Ensure compatibility
			);
			add_meta_box(
				'custom_meta_box_2',
				'Event Link 2',
				'display_custom_meta_box_2',
				'tribe_events',
				'normal',
				'high',
				array('__back_compat_meta_box' => false) // Ensure compatibility
			);
			add_meta_box(
				'custom_meta_box_3',
				'Event Link 3',
				'display_custom_meta_box_3',
				'tribe_events',
				'normal',
				'high',
				array('__back_compat_meta_box' => false) // Ensure compatibility
			);
			add_meta_box(
				'custom_meta_box_4',
				'Event Link 4',
				'display_custom_meta_box_4',
				'tribe_events',
				'normal',
				'high',
				array('__back_compat_meta_box' => false) // Ensure compatibility
			);
			add_meta_box(
				'custom_meta_box_5',
				'Event Link 5',
				'display_custom_meta_box_5',
				'tribe_events',
				'normal',
				'high',
				array('__back_compat_meta_box' => false) // Ensure compatibility
			);
			add_meta_box(
				'custom_meta_box_6',
				'Event Link 6',
				'display_custom_meta_box_6',
				'tribe_events',
				'normal',
				'high',
				array('__back_compat_meta_box' => false) // Ensure compatibility
			);
			add_meta_box(
				'custom_meta_box_7',
				'Event Link 7',
				'display_custom_meta_box_7',
				'tribe_events',
				'normal',
				'high',
				array('__back_compat_meta_box' => false) // Ensure compatibility
			);
		}
		add_action('add_meta_boxes', 'add_custom_meta_boxes');

		// Meta box callback function
		function second_featured_image_meta_box_callback($post) {
			wp_nonce_field('save_second_featured_image', 'second_featured_image_nonce');

			// Check if this is a recurring event
			if (function_exists('tribe_is_recurring_event') && tribe_is_recurring_event($post->ID)) {
				// Get the recurring event's parent ID
				$parent_id = wp_get_post_parent_id($post->ID);
				if ($parent_id) {
					$post_id = $parent_id;
				} else {
					$post_id = $post->ID;
				}
			} else {
				$post_id = $post->ID;
			}

			$second_image_id = get_post_meta($post_id, '_second_featured_image', true);
			$second_image_url = $second_image_id ? wp_get_attachment_image_url($second_image_id, 'full') : '';

			echo '<div class="second-featured-image-wrapper">';
			echo '<input type="hidden" id="second_featured_image" name="second_featured_image" value="' . esc_attr($second_image_id) . '">';
			echo '<div style="width: 100%; padding-bottom: 100%; position: relative;">';
			echo '<img id="second_featured_image_preview" alt="Second Featured Image Thumbnail" src="' . esc_url($second_image_url) . '" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"/>';
			echo '</div>';
			echo '<br><a href="#" id="upload_second_featured_image_button" class="button">Upload Image</a>';
			echo '<br><a href="#" id="remove_second_featured_image_button" style="display:' . ($second_image_id ? 'inline' : 'none') . '; color: red;">Remove Image</a>';
			echo '</div>';

			?>
			<script>
				jQuery(document).ready(function($){
					var file_frame;

					$('#upload_second_featured_image_button').on('click', function(e){
						e.preventDefault();

						if (file_frame) {
							file_frame.open();
							return;
						}

						file_frame = wp.media.frames.file_frame = wp.media({
							title: 'Select or Upload Second Featured Image',
							button: {
								text: 'Use this image',
							},
							multiple: false
						});

						file_frame.on('select', function(){
							var attachment = file_frame.state().get('selection').first().toJSON();
							$('#second_featured_image').val(attachment.id);
							$('#second_featured_image_preview').attr('src', attachment.url);
							$('#remove_second_featured_image_button').show();
						});

						file_frame.open();
					});

					$('#remove_second_featured_image_button').on('click', function(e){
						e.preventDefault();
						$('#second_featured_image').val('');
						$('#second_featured_image_preview').attr('src', '');
						$('#remove_second_featured_image_button').hide();
					});
				});
			</script>
		<?php
		} // end second_featured_image_meta_box_callback

		function display_custom_meta_box($post, $box_number) {
			wp_nonce_field(basename(__FILE__), 'custom_meta_box_nonce_' . $box_number);
			$link_label = get_post_meta($post->ID, 'custom_meta_box_' . $box_number . '_label', true);
			$link_target = get_post_meta($post->ID, 'custom_meta_box_' . $box_number . '_target', true);
			$link_url = get_post_meta($post->ID, 'custom_meta_box_' . $box_number . '_url', true);
			?>
			<p>
				<label for="custom_meta_box_<?php echo $box_number; ?>_label">Link Label (max characters =):</label>
				<input type="text" name="custom_meta_box_<?php echo $box_number; ?>_label" value="<?php echo esc_attr($link_label); ?>" class="widefat" maxlength="12" />
				<!-- Character limit set to 12 for Link Label -->
			</p>
			<p>
				<label for="custom_meta_box_<?php echo $box_number; ?>_target">Link Target:</label>
				<select name="custom_meta_box_<?php echo $box_number; ?>_target" class="widefat">
					<option value="" <?php selected($link_target, ''); ?>>Select a target</option>
					<option value="_self" <?php selected($link_target, '_self'); ?>>Same Tab</option>
					<option value="_blank" <?php selected($link_target, '_blank'); ?>>New Tab</option>
				</select>
			</p>
			<p>
				<label for="custom_meta_box_<?php echo $box_number; ?>_url">Link URL:</label>
				<input type="text" name="custom_meta_box_<?php echo $box_number; ?>_url" value="<?php echo esc_attr($link_url); ?>" class="widefat" />
			</p>
			<?php
		} // end display_custom_meta_box

		function collapse_meta_boxes_by_default() {
			echo '
			<script type="text/javascript">
			jQuery(document).ready(function($) {
				$("#custom_meta_box_1, #custom_meta_box_2, #custom_meta_box_3, #custom_meta_box_4").addClass("closed");
			});
			</script>';
		} // end  collapse_meta_boxes_by_default
		add_action('admin_footer-post.php', 'collapse_meta_boxes_by_default');
		add_action('admin_footer-post-new.php', 'collapse_meta_boxes_by_default');

		// Meta box callback function
		function display_custom_meta_box_1($post) {
			display_custom_meta_box($post, 1);
		}

		function display_custom_meta_box_2($post) {
			display_custom_meta_box($post, 2);
		}

		function display_custom_meta_box_3($post) {
			display_custom_meta_box($post, 3);
		}

		function display_custom_meta_box_4($post) {
			display_custom_meta_box($post, 4);
		}

		function display_custom_meta_box_5($post) {
			display_custom_meta_box($post, 5);
		}

		function display_custom_meta_box_6($post) {
			display_custom_meta_box($post, 6);
		}

		function display_custom_meta_box_7($post) {
			display_custom_meta_box($post, 7);
		}

		// Save the meta box data
		function save_custom_meta_boxes($post_id) {
			// Verify nonce
			if (!isset($_POST['second_featured_image_nonce']) || !wp_verify_nonce($_POST['second_featured_image_nonce'], 'save_second_featured_image')) {
				return;
			}

			// Check autosave
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return;
			}

			// Check user permissions
			if (!current_user_can('edit_post', $post_id)) {
				return;
			}

			// Check if this is a recurring event
			if (function_exists('tribe_is_recurring_event') && tribe_is_recurring_event($post_id)) {
				// Get the recurring event's parent ID
				$parent_id = wp_get_post_parent_id($post_id);
				if ($parent_id) {
					$post_id = $parent_id;
				}
			}

			// Save or delete the second featured image
			if (isset($_POST['second_featured_image'])) {
				update_post_meta($post_id, '_second_featured_image', sanitize_text_field($_POST['second_featured_image']));
			} else {
				delete_post_meta($post_id, '_second_featured_image');
			}

			if (!isset($_POST['custom_meta_box_nonce_1']) || !wp_verify_nonce($_POST['custom_meta_box_nonce_1'], basename(__FILE__))) {
			return;
			}
			if (!isset($_POST['custom_meta_box_nonce_2']) || !wp_verify_nonce($_POST['custom_meta_box_nonce_2'], basename(__FILE__))) {
				return;
			}
			if (!isset($_POST['custom_meta_box_nonce_3']) || !wp_verify_nonce($_POST['custom_meta_box_nonce_3'], basename(__FILE__))) {
				return;
			}
			if (!isset($_POST['custom_meta_box_nonce_4']) || !wp_verify_nonce($_POST['custom_meta_box_nonce_4'], basename(__FILE__))) {
				return;
			}
			if (!isset($_POST['custom_meta_box_nonce_5']) || !wp_verify_nonce($_POST['custom_meta_box_nonce_5'], basename(__FILE__))) {
				return;
			}
			if (!isset($_POST['custom_meta_box_nonce_6']) || !wp_verify_nonce($_POST['custom_meta_box_nonce_6'], basename(__FILE__))) {
				return;
			}
			if (!isset($_POST['custom_meta_box_nonce_7']) || !wp_verify_nonce($_POST['custom_meta_box_nonce_7'], basename(__FILE__))) {
				return;
			}

			$fields = array('label', 'target', 'url');

			foreach ($fields as $field) {
				for ($i = 1; $i <= 7; $i++) {
					$meta_key = 'custom_meta_box_' . $i . '_' . $field;
					$new_meta_value = (isset($_POST[$meta_key]) ? sanitize_text_field($_POST[$meta_key]) : '');
					$meta_value = get_post_meta($post_id, $meta_key, true);

					if ($new_meta_value && '' == $meta_value) {
						add_post_meta($post_id, $meta_key, $new_meta_value, true);
					} elseif ($new_meta_value && $new_meta_value != $meta_value) {
						update_post_meta($post_id, $meta_key, $new_meta_value);
					} elseif ('' == $new_meta_value && $meta_value) {
						delete_post_meta($post_id, $meta_key, $meta_value);
					}
				}
			}
			
		}
		add_action('save_post', 'save_custom_meta_boxes');

		// Remove certain meta boxes for Events

		function remove_event_meta_boxes() {
			$post_type = 'tribe_events';

			// Remove the excerpt meta box
			remove_meta_box('postexcerpt', $post_type, 'normal');

			// Remove the discussion meta box
			remove_meta_box('commentstatusdiv', $post_type, 'normal');
			remove_meta_box('commentsdiv', $post_type, 'normal');

			// Remove the author meta box
			remove_meta_box('authordiv', $post_type, 'normal');
		}
		add_action('add_meta_boxes', 'remove_event_meta_boxes', 10, 2);

		// Add Meta Box for Subtitle
function add_subtitle_field_above_editor($post) {
    if ($post->post_type == 'tribe_events') {
        wp_nonce_field('save_subtitle', 'subtitle_nonce');

        // Check if this is a recurring event
        if (function_exists('tribe_is_recurring_event') && tribe_is_recurring_event($post->ID)) {
            $parent_id = wp_get_post_parent_id($post->ID);
            $post_id = $parent_id ? $parent_id : $post->ID;
        } else {
            $post_id = $post->ID;
        }

        $subtitle = get_post_meta($post_id, 'subtitle', true);
        echo '<div class="postbox" style="margin-top:10px;">';
        echo '<div class="inside">';
        echo '<label for="subtitle" style="font-weight: bold; display: block; margin-bottom: 5px;">Subtitle</label>';
        echo '<input type="text" id="subtitle" name="subtitle" value="' . esc_attr($subtitle) . '" style="width:100%;" required />';
        echo '</div>';
        echo '</div>';
    }
}
add_action('edit_form_after_title', 'add_subtitle_field_above_editor');

// Prevent saving if subtitle is empty
function save_subtitle($post_id) {
    // Verify nonce
    if (!isset($_POST['subtitle_nonce']) || !wp_verify_nonce($_POST['subtitle_nonce'], 'save_subtitle')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Check if this is a recurring event
    if (function_exists('tribe_is_recurring_event') && tribe_is_recurring_event($post_id)) {
        $parent_id = wp_get_post_parent_id($post_id);
        if ($parent_id) {
            $post_id = $parent_id;
        }
    }

    // Prevent saving if subtitle is empty
    if (!isset($_POST['subtitle']) || empty(trim($_POST['subtitle']))) {
        add_filter('redirect_post_location', function($location) {
            return add_query_arg('subtitle_error', '1', $location);
        });
        return;
    }

    // Save the subtitle
    update_post_meta($post_id, 'subtitle', sanitize_text_field($_POST['subtitle']));
}
add_action('save_post', 'save_subtitle');

// Display error message in admin
function display_subtitle_error_notice() {
    if (isset($_GET['subtitle_error']) && $_GET['subtitle_error'] == '1') {
        echo '<div class="error"><p>' . __('Error: The Subtitle field cannot be empty.', 'text-domain') . '</p></div>';
    }
}
add_action('admin_notices', 'display_subtitle_error_notice');

		function enqueue_admin_scripts_for_tribe_events($hook) {
			global $post_type;
			if ($post_type == 'tribe_events') {
				wp_enqueue_script('tribe-events-admin-script', get_template_directory_uri() . '/js/tribe-events-admin.js', array('jquery'), null, true);
			}
    	}
    	add_action('admin_enqueue_scripts', 'enqueue_admin_scripts_for_tribe_events');

	} // end is_admin

	function display_event_links($post_id) {
		for ($i = 1; $i <= 7; $i++) {
			$link_label = get_post_meta($post_id, 'custom_meta_box_' . $i . '_label', true);
			$link_target = get_post_meta($post_id, 'custom_meta_box_' . $i . '_target', true);
			$link_url = get_post_meta($post_id, 'custom_meta_box_' . $i . '_url', true);

			if (!empty($link_label)) {
				echo '<a href="' . esc_url($link_url) . '" target="' . esc_attr($link_target) . '">' . esc_html($link_label) . '</a>';
			}
		}
	}

	function get_event_links($post_id) {
		$str_event_links = '';

		$arr_post_meta = get_post_meta($post_id);
		for ( $i = 1; $i <= 7; $i++ ) {
			if ( isset($arr_post_meta['custom_meta_box_' . $i . '_label']) && !empty($arr_post_meta['custom_meta_box_' . $i . '_label']) ) {
				$link_label = $arr_post_meta['custom_meta_box_' . $i . '_label'][0];
				$link_target = $arr_post_meta['custom_meta_box_' . $i . '_target'][0];
				$link_url = $arr_post_meta['custom_meta_box_' . $i . '_url'][0];

				$str_event_links .= '<a href="' . esc_url($link_url) . '" target="' . esc_attr($link_target) . '">' . esc_html($link_label) . '</a> ';
			}
		}

		return $str_event_links;
	}

// Enqueue JavaScript and dependencies
function enqueue_js() {
    // jQuery (full version)
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', array(), null, true);
    // Popper.js
    wp_enqueue_script('popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array(), null, true);
    // Bootstrap JS
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery', 'popper'), null, true);
    // Custom script to add event listener for search module
   	wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/search.js', array('jquery', 'bootstrap-js'), null, true);
	// Update Website URL Label for Event posts
	wp_enqueue_script( 'custom-admin-script', get_template_directory_uri() . '/js/tribe-events-admin.js', array( 'jquery' ), null, true );
	// Add Join All Access link to mobile menu
	wp_enqueue_script( 'add-aa-mbl-lnk', get_template_directory_uri() . '/js/add-aa-mbl-lnk.js', array( 'jquery' ), null, true );

	
	if (is_page('the-venue')) {
        // Enqueue Lightbox CSS
        wp_enqueue_style('lightbox-css', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css', array(), '2.11.3');

        // Enqueue Lightbox JS
        wp_enqueue_script('lightbox-js', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', array('jquery'), '2.11.3', true);

        // Enqueue custom JS for Lightbox behavior
        wp_enqueue_script('lightbox-custom-js', get_template_directory_uri() . '/js/lightbox-custom.js', array('lightbox-js'), null, true);
    }
	else if (is_page('seating')) {
        // Enqueue the seating map script
        wp_enqueue_script('seating-map-script', get_template_directory_uri() . '/js/seating-map.js', ['jquery'], null, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_js');

// Add defer or async to specific scripts
function add_defer_or_async($tag, $handle) {
    // Array of handles for scripts to defer
    $scripts_to_defer = [
        'popper',
        'bootstrap-js',
        'custom-script',
        'lightbox-js',
        'lightbox-custom-js',
        'seating-map-script'
    ];

    if (in_array($handle, $scripts_to_defer)) {
        return str_replace('src', 'defer="defer" src', $tag);
    }

    // Array of handles for scripts to async
    $scripts_to_async = [
        // Add handles for async loading here if needed
    ];

    if (in_array($handle, $scripts_to_async)) {
        return str_replace('src', 'async="async" src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'add_defer_or_async', 10, 2);

add_action('admin_head', function() {
    global $post_type;

    if ($post_type === 'tribe_events') {
        echo '<style>#postcustom { display: none; }</style>';
    }
});

// Redirect author archive to custom 404 page
add_action('template_redirect', function() {
    if (is_author()) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        get_template_part(404); // Make sure you have a 404.php template file
        exit;
    }
});

// Remove WP Admin bar for FB
add_action('after_setup_theme', function() {
    $user_id = 1; // Replace with the user ID for which you want to hide the admin bar

    if (get_current_user_id() == $user_id) {
        show_admin_bar(false);
    }
});

// Change Series view
add_filter(
    'tec_events_pro_custom_tables_v1_series_event_view_slug',
    function ( $view ) {
        return 'list';
    }
);

function conditional_image_loading_script() {
    if (( !is_front_page() )) {
        wp_enqueue_script(
            'image-load-control',
            get_template_directory_uri() . '/js/image-load-control.js', 
            array(),
            null,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'conditional_image_loading_script');

function limit_tribe_events_in_photo_view( $query ) {
    // Check if it's not an admin request, it's the main query, and it's for tribe events
    if ( ! is_admin() && $query->is_main_query() && function_exists( 'tribe_is_event_query' ) && tribe_is_event_query() ) {

        // Check if it's the specific photo view and the correct page
        if ( $query->get( 'tribe_event_display' ) === 'photo' && is_page(32) ) {

            // Set the number of posts (events) to 3
            $query->set( 'posts_per_page', 3 );
        }
    }
}
add_action( 'pre_get_posts', 'limit_tribe_events_in_photo_view', 99 );

// Function to create the custom dashboard widget content for Recent Events
function recent_events_dashboard_widget() {
    $today = date('Y-m-d H:i:s'); // Get the current date and time

    $recent_events = new WP_Query(array(
        'post_type' => 'tribe_events', // Custom post type for events
        'posts_per_page' => 10,        // Number of events to display
        'post_status' => 'publish',    // Only show published events
        'meta_key' => '_EventStartDate', // The event start date field (used by The Events Calendar)
        'orderby' => 'meta_value',     // Order by the event start date
        'order' => 'ASC',              // Show upcoming events first
        'meta_query' => array(
            array(
                'key' => '_EventStartDate',
                'value' => $today,
                'compare' => '>=',      // Only show events that start today or later (upcoming)
                'type' => 'DATETIME'
            )
        )
    ));

    if ($recent_events->have_posts()) {
        echo '<ul>';
        while ($recent_events->have_posts()) {
            $recent_events->the_post();

            // Get the event start date and format it
            $event_start_date = get_post_meta(get_the_ID(), '_EventStartDate', true);
            $formatted_start_date = date('F j, Y', strtotime($event_start_date));

            // Display the event title and start date
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a> - ' . $formatted_start_date . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No upcoming events available.</p>';
    }

    // Add buttons for Add New Event and All Events
    echo '<p><a href="' . admin_url('post-new.php?post_type=tribe_events') . '" class="button button-primary">Add New Event</a> ';
    echo '<a href="' . admin_url('edit.php?post_type=tribe_events') . '" class="button button-secondary">All Events</a></p>';

    wp_reset_postdata(); // Reset post data after query
}


// Function to create the custom dashboard widget content for Recent Pages
function recent_pages_dashboard_widget() {
    $recent_pages = new WP_Query(array(
        'post_type' => 'page',     // Query for pages
        'posts_per_page' => 10,     // Number of pages to display
        'post_status' => 'publish' // Only show published pages
    ));

    if ($recent_pages->have_posts()) {
        echo '<ul>';
        while ($recent_pages->have_posts()) {
            $recent_pages->the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No recent pages available.</p>';
    }

    // Add buttons for Add New Page and All Pages
    echo '<p><a href="' . admin_url('post-new.php?post_type=page') . '" class="button button-primary">Add New Page</a> ';
    echo '<a href="' . admin_url('edit.php?post_type=page') . '" class="button button-secondary">All Pages</a></p>';

    wp_reset_postdata(); // Reset post data after query
}

// Function to register the dashboard widgets
function add_custom_dashboard_widgets() {
    // Register Recent Events Widget
    wp_add_dashboard_widget(
        'recent_events_dashboard_widget',  // Widget slug (unique ID)
        'Upcoming Events',                   // Widget title
        'recent_events_dashboard_widget'   // Callback function to display recent events
    );

    // Register Recently Viewed Pages Widget
    wp_add_dashboard_widget(
        'recent_pages_dashboard_widget',  // Widget slug (unique ID)
        'Pages',                   // Widget title
        'recent_pages_dashboard_widget'   // Callback function to display recent pages
    );
}

// Hook into the 'wp_dashboard_setup' action to register the widgets
add_action('wp_dashboard_setup', 'add_custom_dashboard_widgets');

// Remove dashboard widgets that aren't needed
function remove_default_dashboard_widgets() {
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');    // Site Health Widget
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');     // At A Glance Widget
    remove_meta_box('wp_mail_smtp_reports_widget_lite', 'dashboard', 'normal');    // WP Mail SMTP Reports Widget
	remove_meta_box('tribe_dashboard_widget', 'dashboard', 'normal');    // The Events Calendar News Widget
	remove_meta_box('wpforms_reports_widget_lite', 'dashboard', 'normal');    // WP Forms Widget
	remove_meta_box('optin_monster_db_widget', 'dashboard', 'normal');    // Optin Monster Widget
	remove_meta_box('userfeedback_surveys_widget', 'dashboard', 'normal');    // User Feedback Surveys Widget
	remove_meta_box('wp_dark_mode_dashboard_widget', 'dashboard', 'normal');   // WP Dark Mode Widget
}

add_action('wp_dashboard_setup', 'remove_default_dashboard_widgets');

function remove_menus() {
    // Remove the "Posts" menu
    remove_menu_page('edit.php');
    
    // Remove the "Comments" menu
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_menus');

function custom_admin_link_styles() {
    echo '<style>
        /* Change the color of hovered links */
        .wp-dark-mode-active .wrap ul a:hover {
            text-decoration: underline !important;  /* Your desired hover color */
        }

		.wp-dark-mode-active #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head, .wp-dark-mode-active #adminmenu .wp-menu-arrow, .wp-dark-mode-active #adminmenu .wp-menu-arrow div, .wp-dark-mode-active #adminmenu li.current a.menu-top, .wp-dark-mode-active #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu{
		background-color:#00A562 !important
		}

		.wp-dark-mode-active #adminmenu .awaiting-mod, .wp-dark-mode-active #adminmenu .menu-counter, .wp-dark-mode-active #adminmenu .update-plugins{
			background-color:#00A562 !important
		}

		.wp-dark-mode-active #adminmenu .wp-submenu a:focus, .wp-dark-mode-active #adminmenu .wp-submenu a:hover, .wp-dark-mode-active #adminmenu a:hover, #adminmenu li.menu-top>a:focus{
			color:rgb(109, 241, 181) !important
		}

		.wp-dark-mode-active .wrap .button-primary, .wp-dark-mode-active .wrap .mi-dw-btn-large{
			color:#ffffff !important;
			border-color:#00A562 !important;
			background-color:#00A562 !important;
			font-weight:600
		}

		.wp-toolbar.wp-dark-mode-active .wp-admin .postbox{
			border-color:#ffffff !important
		}

		.wp-dark-mode-active .wrap .add-new-h2, .wp-dark-mode-active .wrap .add-new-h2:active, .wp-dark-mode-active .wrap .page-title-action, .wp-dark-mode-active .wrap .page-title-action:active{
			border-color:#00A562 !important
		}

		.wp-dark-mode-active .wp-core-ui .button{
			color:#ffffff !important
		}

		.wp-dark-mode-active .wp-core-ui .button-secondary{
			border-color:#00A562 !important;
			font-weight:600
		}

		.wp-dark-mode-active #adminmenu li a:focus div.wp-menu-image:before, .wp-dark-mode-active #adminmenu li.opensub div.wp-menu-image:before, .wp-dark-mode-active #adminmenu li:hover div.wp-menu-image:before, #adminmenu li.menu-top:hover, #adminmenu li.opensub>a.menu-top, #adminmenu li>a.menu-top:focus{
			/*color:#ffffff !important*/
		}

		.wp-dark-mode-active #adminmenu a:hover, .wp-dark-mode-active #adminmenu a:focus, .wp-dark-mode-active #adminmenu a:active, .wp-dark-mode-active #adminmenu a:target{
			color:#00A562 !important
		}

		.wp-dark-mode-active .wp-core-ui .button-primary:hover, .wp-dark-mode-active .mi-dw-btn-large:hover{
			border-color:#00A562 !important;
			background-color:#00A562 !important;
			color:#ffffff !important
		}
		
		.metabox-holder .postbox>h3, .metabox-holder .stuffbox>h3, .metabox-holder h2.hndle, .metabox-holder h3.hndle, #monsterinsights_reports_widget .hndle{
			font-size:16px
		}

		.wp-dark-mode-active .wp-core-ui .button-secondary:hover{
			color:#00A562 !important;
			background-color:transparent !important
		}

		.wp-dark-mode-active .wp-core-ui .button-link{
			color:#00A562 !important;
			font-weight:bold
		}

		.wp-dark-mode-active .wp-core-ui .button-link.editinline{
			color:#c5a363 !important
		}

		.wp-dark-mode-active .wrap a, #wpadminbar .ab-top-menu>li.hover>.ab-item, #wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus, #wpadminbar:not(.mobile) .ab-top-menu>li:hover>.ab-item, #wpadminbar:not(.mobile) .ab-top-menu>li>.ab-item:focus{
			color:#00A562
		}

		.wp-dark-mode-active .wrap .row-actions a{
			color:#c5a363;
			font-weight:bold
		}

		.wp-dark-mode-active .wp-core-ui .button, .wp-core-ui .button-secondary{
			border-color:#00A562 !important
		}

		.wp-dark-mode-active .wrap .add-new-h2:hover, .wrap .page-title-action:hover, .wp-dark-mode-active .wp-core-ui .button:hover{
			background-color:#00A562 !important;
			color:#ffffff !important
		}

		.wp-dark-mode-active .wp-core-ui .widefat td, .wp-dark-mode-active .wp-core-ui .widefat th, .wp-dark-mode-active .wp-core-ui input[type="text"], .wp-dark-mode-active .wp-core-ui .inside label, .wp-dark-mode-active .wp-admin #wpadminbar #wp-admin-bar-site-name>.ab-item:before{
			color:#ffffff !important
		}
			
		.wp-dark-mode-active .tribe-event-exclusion:nth-child(2n+2), .wp-dark-mode-active .tribe-event-recurrence:nth-child(2n+2){
			background: inherit !important
		}
			
		.wp-dark-mode-active .wp-core-ui{
			color: #ffffff !important
		}

		.wp-dark-mode-active .wp-core-ui input[type=checkbox]:checked::before{
			content: url("../wp-content/themes/burt/images/wp-core-checkmark-icon.svg") !important
		}

		.wp-dark-mode-active .wp-core-ui a:hover{
			color:#00A562 !important
		}
		
    </style>';
}
add_action('admin_head', 'custom_admin_link_styles');

add_theme_support('wp-block-styles');
add_theme_support('align-wide'); // If you want wide/full alignments for blocks

// Modify Events post type so it defaults to Gutenberg blocks
/*function modify_tribe_events_post_type_args( $args, $post_type ) {
    // Check if the post type is 'tribe_events' (the custom post type used by The Events Calendar)
    if ( $post_type === 'tribe_events' ) {
        // Enable Gutenberg by setting 'show_in_rest' to true
        $args['show_in_rest'] = true;

        // Optionally, ensure other settings needed for Gutenberg are present
        if ( isset( $args['supports'] ) && is_array( $args['supports'] ) ) {
            // Ensure 'editor' is supported so the block editor can be used
            if ( ! in_array( 'editor', $args['supports'], true ) ) {
                $args['supports'][] = 'editor';
            }
        } else {
            // If 'supports' isn't already defined, add default supports including 'editor'
            $args['supports'] = array( 'title', 'editor', 'excerpt', 'thumbnail' );
        }
    }
    
    return $args;
}
add_filter( 'register_post_type_args', 'modify_tribe_events_post_type_args', 10, 2 );*/

function get_seconds_left_in_current_day() {
    $timezone = new DateTimeZone('America/Winnipeg');
    $now = new DateTime('now', $timezone);
    $endOfDay = new DateTime('tomorrow', $timezone);
    $endOfDay->setTime(0, 0, 0);
    
    return $endOfDay->getTimestamp() - $now->getTimestamp();
}

function pre_print_r($output)
{
    echo "<pre>\n";

    print_r($output);

    echo "</pre>\n";
}

function save_post_tribe_events_delete_cached_data( $post_id, $post, $update ) {
	delete_transient('home-page-events-featured');
}
add_action('save_post_tribe_events', 'save_post_tribe_events_delete_cached_data', 10, 3);

function save_post_content_blocks_delete_cached_data( $post_id, $post, $update ) {
	delete_transient('home-page-content-blocks');
}
add_action('save_post_content_blocks', 'save_post_content_blocks_delete_cached_data', 10, 3);

/*function preload_filter_bar_css() {
    // Preload Filter Bar css
    if (is_front_page()) {
        echo '<link rel="preload" href="' . plugins_url('the-events-calendar-filterbar/src/resources/css/views-filter-bar-skeleton.min.css', 'the-events-calendar-filterbar') . '" as="style">';
        echo '<link rel="preload" href="' . plugins_url('the-events-calendar-filterbar/src/resources/css/views-filter-bar-full.min.css', 'the-events-calendar-filterbar') . '" as="style">';
		echo '<link rel="preload" href="' . plugins_url('the-events-calendar-filterbar/src/resources/js/views-filter-bar-state-js.js', 'the-events-calendar-filterbar') . '" as="script">';
        echo '<link rel="preload" href="' . plugins_url('the-events-calendar-filterbar/src/resources/js/views-filter-bar-checkboxes-js.js', 'the-events-calendar-filterbar') . '" as="script">';
        echo '<link rel="preload" href="' . plugins_url('the-events-calendar-filterbar/src/resources/js/views-filter-bar-toggle-js.js', 'the-events-calendar-filterbar') . '" as="script">';
        echo '<link rel="preload" href="' . plugins_url('the-events-calendar-filterbar/src/resources/js/views-filter-bar-slider-js.js', 'the-events-calendar-filterbar') . '" as="script">';
        echo '<link rel="preload" href="' . plugins_url('the-events-calendar-filterbar/src/resources/js/views-filter-bar-radios-js.js', 'the-events-calendar-filterbar') . '" as="script">';
    }
}
add_action('wp_head', 'preload_filter_bar_css');*/

add_filter( 'tribe_events_event_tooltip', function ( $tooltip, $event_id ) {
    $event_featured_image = get_the_post_thumbnail( $event_id, 'medium' );
    if ( $event_featured_image ) {
        $tooltip = $event_featured_image . $tooltip;
    }
    return $tooltip;
}, 10, 2 );

add_filter('tribe_related_posts_args', function($args) {
    // Get the current event's ID
    $post_id = get_the_ID();

    // Get all categories (terms) assigned to the current event
    $terms = wp_get_object_terms($post_id, 'tribe_events_cat', ['fields' => 'all']);

    // Initialize variables to hold subcategories and the parent "Music" category
    $music_subcategories = [];
    $music_parent = null;

    // Iterate through terms to separate "Music" subcategories and the parent
    foreach ($terms as $term) {
        if ($term->slug === 'music') {
            $music_parent = $term->term_id; // Parent "Music" category
        } elseif ($term->parent) {
            $parent_term = get_term($term->parent, 'tribe_events_cat');
            if ($parent_term && $parent_term->slug === 'music') {
                $music_subcategories[] = $term->term_id; // Collect subcategories under "Music"
            }
        }
    }

    // If the event is in "Music," prioritize subcategories; fallback to parent "Music"
    if (!empty($music_subcategories)) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'tribe_events_cat',
                'field'    => 'term_id',
                'terms'    => $music_subcategories, // Use subcategories first
                'operator' => 'IN',
            ],
        ];
    } elseif ($music_parent) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'tribe_events_cat',
                'field'    => 'term_id',
                'terms'    => $music_parent, // Fallback to parent "Music" category
                'operator' => 'IN',
            ],
        ];
    }

    // Set the number of related events
    $args['posts_per_page'] = 3; // Adjust as needed
    $args['orderby'] = 'event_date'; // Optional: Order by event date
    $args['order'] = 'ASC'; // Optional: Ascending order

    return $args;
}, 10);

add_action('init', function () {
    // Add a custom feed endpoint
    add_feed('custom', function () {
        load_template(get_template_directory() . '/feed-rss2-custom.php');
    });
});

/*function enqueue_fade_in_script() {
    wp_enqueue_script('fade-in', get_template_directory_uri() . '/js/fade-in.js', [], null, true); // Load in footer
}
add_action('wp_enqueue_scripts', 'enqueue_fade_in_script');*/

function use_stable_event_guid($guid, $post_id) {
    if (get_post_type($post_id) === 'tribe_events') {
        // Map old GUIDs to new events
        $mapping = [
            'https://www.burtoncummingstheatre.ca//6941/var/ri-0' => 1181, // Gerry Dee
            'https://www.burtoncummingstheatre.ca//6925/var/ri-0' => 1185, // Kerry King
            'https://www.burtoncummingstheatre.ca//6992/var/ri-0' => 1236, // Peach Pit
            'https://www.burtoncummingstheatre.ca//7075/var/ri-0' => 1351, // Tim Dillon
            'https://www.burtoncummingstheatre.ca//6659/var/ri-0' => 576,  // Apocalyptica
            'https://www.burtoncummingstheatre.ca//6919/var/ri-0' => 1189, // Colin James
            'https://www.burtoncummingstheatre.ca//6996/var/ri-0' => 1252, // Comeback Kid
            'https://www.burtoncummingstheatre.ca//6998/var/ri-0' => 1272, // Colter Wall and Friends
            'https://www.burtoncummingstheatre.ca//6950/var/ri-0' => 1193, // Tom Petty’s Full Moon Fever Show
            'https://www.burtoncummingstheatre.ca//6905/var/ri-0' => 1197, // The Red Clay Strays
            'https://www.burtoncummingstheatre.ca//7013/var/ri-0' => 1283, // The Man In Black: A Tribute To Johnny Cash
            'https://www.burtoncummingstheatre.ca//6959/var/ri-0' => 1217, // Darcy & Jer
            'https://www.burtoncummingstheatre.ca//7079/var/ri-0' => 1372, // David Cross
            'https://www.burtoncummingstheatre.ca//6966/var/ri-0' => 1221, // Killswitch Engage
            'https://www.burtoncummingstheatre.ca//6620/var/ri-0' => 680,  // Tommy Emmanuel
            'https://www.burtoncummingstheatre.ca//7062/var/ri-0' => 1333, // Dylan Gossett
            'https://www.burtoncummingstheatre.ca//6958/var/ri-0' => 1209, // Mini Pop Kids – The Celebration Tour
            'https://www.burtoncummingstheatre.ca//7080/var/ri-0' => 1378, // The Story of Taylor Swift
            'https://www.burtoncummingstheatre.ca//6934/var/ri-0' => 10000113, // Sarah Millican
			'https://www.burtoncummingstheatre.ca//6922/var/ri-0' => 10000114, // Sarah Millican
            'https://www.burtoncummingstheatre.ca//6972/var/ri-0' => 1225, // Pat Barrett
            'https://www.burtoncummingstheatre.ca//6645/var/ri-0' => 619,  // Jesse Cook
            'https://www.burtoncummingstheatre.ca//7039/var/ri-0' => 10000130, // Nitty Gritty Dirt Band
			'https://www.burtoncummingstheatre.ca//7042/var/ri-0' => 10000131, // Nitty Gritty Dirt Band
            'https://www.burtoncummingstheatre.ca//7027/var/ri-0' => 1307, // Winnipeg Comedy Fest
			'https://www.burtoncummingstheatre.ca//7028/var/ri-0' => 10000126, // Winnipeg Comedy Fest
			'https://www.burtoncummingstheatre.ca//7029/var/ri-0' => 10000127, // Winnipeg Comedy Fest
			'https://www.burtoncummingstheatre.ca//7030/var/ri-0' => 10000128, // Winnipeg Comedy Fest
			'https://www.burtoncummingstheatre.ca//7031/var/ri-0' => 10000129, // Winnipeg Comedy Fest
            'https://www.burtoncummingstheatre.ca//7004/var/ri-0' => 1277, // Machine Head
            'https://www.burtoncummingstheatre.ca//7085/var/ri-0' => 1385, // Niko Moon
			'https://www.burtoncummingstheatre.ca//6656/var/ri-0' => 601, // Dean Lewis
			'https://www.burtoncummingstheatre.ca//7088/var/ri-0' => 1446, // Rainbow Kitten Surprise
			'https://www.burtoncummingstheatre.ca//7045/var/ri-0' => 1320, // Chris D’Elia
			'https://www.burtoncummingstheatre.ca//6610/var/ri-0' => 10000079, // Riverdance 052325 8pm
			'https://www.burtoncummingstheatre.ca//7003/var/ri-0' => 10000122, // Riverdance 052424 4pm
			'https://www.burtoncummingstheatre.ca//6615/var/ri-0' => 10000080, // Riverdance 052424 8pm 
			'https://www.burtoncummingstheatre.ca//6616/var/ri-0' => 10000081, // Riverdance 052524 1pm
			'https://www.burtoncummingstheatre.ca//7091/var/ri-0' => 1482, // Paul Reiser
			'https://www.burtoncummingstheatre.ca//7072/var/ri-0' => 1347, // Abra Cadabra
			'https://www.burtoncummingstheatre.ca//7068/var/ri-0' => 10000136, // Sesame Street Live! Say Hello 062125 1pm
			'https://www.burtoncummingstheatre.ca//7071/var/ri-0' => 10000137, // Sesame Street Live! Say Hello 062125 5pm
        ];

        // Reverse the mapping: New Post ID => Old GUID
        $reversed_mapping = array_flip($mapping);

        // Check if the post ID is in the reversed mapping
        if (isset($reversed_mapping[$post_id])) {
            return $reversed_mapping[$post_id]; // Use the old GUID
        }

        // Default GUID for events not in the mapping
        return home_url('/?post_type=tribe_events&p=' . $post_id);
    }

    return $guid; // Default GUID for non-events
}
add_filter('get_the_guid', 'use_stable_event_guid', 10, 2);