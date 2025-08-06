<?php
/**
 * Block: Calendar Embed
 */

namespace TEC\Events_Pro\Blocks\Calendar;

use Tribe__Events__Pro__Main;
use Tribe\Events\Views\V2\Manager;
use Tribe__Main;

/**
 * Class Block
 *
 * @since   7.2.0
 *
 * @package TEC\Events_Pro\Blocks\Calendar
 */
class Block {

	/**
	 * Registers the Calendar embed block.
	 *
	 * @since 7.2.0
	 */
	public function register_block() {
		if ( ! file_exists( Tribe__Events__Pro__Main::instance()->pluginPath . 'src/resources/js/blocks/calendar-embed/index.js' ) ) {
			return;
		}

		register_block_type( Tribe__Events__Pro__Main::instance()->pluginPath . 'src/resources/js/blocks/calendar-embed' );

		$this->setup_assets();
	}

	/**
	 * Setup assets and localizes the data to the block editor script.
	 *
	 * @since 7.2.0
	 */
	public function setup_assets() {
		$plugin = Tribe__Events__Pro__Main::instance();
		tribe_asset(
			$plugin,
			'tec-events-pro-iframe-content-resizer',
			'node_modules/@iframe-resizer/child/index.umd.js',
			[],
			null,
			[]
		);

		$embed_url = $this->get_embed_url();

		wp_localize_script(
			'tec-calendar-embed-editor-script',
			'tec_events_pro_calendar_embed_data',
			[
				'embed_url'              => $embed_url,
				'embed_nonce'            => wp_create_nonce( 'wp_rest' ),
				'up_sell_img'            => tribe_resource_url( 'images/icons/circle-bolt.svg', false, null, Tribe__Main::instance() ),
				'has_filter_bar'         => has_action( 'tribe_common_loaded', 'tribe_register_filterbar' ),
				'filter_bar_upsell_link' => 'https://evnt.is/1b31',
				'views'                  => array_map(
					static function ( $view ) {
						return tribe( Manager::class )->get_view_label_by_class( $view );
					},
					tribe( Manager::class )->get_publicly_visible_views( false )
				),
			]
		);
	}

	/**
	 * Get the embed URL for the calendar.
	 *
	 * @since 7.2.0
	 *
	 * @return string The filtered embed URL.
	 */
	private function get_embed_url() {
		$default_embed_url = get_site_url() . '/wp-json/tec/v1/events/calendar-embed/';

		/**
		 * Filters the calendar embed REST URL.
		 *
		 * @since 7.2.0
		 *
		 * @param string $default_embed_url The calendar embed REST URL.
		 */
		return apply_filters( 'tec_events_pro_calendar_embed_block_query_url', $default_embed_url );
	}
}
