<?php
/**
 * Abstract Class to manage integration settings.
 *
 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
 *
 * @package Tribe\Events\Virtual\Integrations
 */

namespace Tribe\Events\Virtual\Integrations;

use \Tribe\Events\Admin\Settings as TEC_Settings;

/**
 * Class Settings
 *
 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
 *
 * @package Tribe\Events\Virtual\Integrations
 */
abstract class Abstract_Settings {

	/**
	 * The prefix, in the context of tribe options, of each setting for this extension.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @var string
	 */
	public static $option_prefix = '';

	/**
	 * The internal id of the API integration.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @var string
	 */
	public static $api_id = '';

	/**
	 * An instance of the Meeting API handler.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @var Api
	 */
	protected $api;

	/**
	 * An instance of the Meeting Template_Modifications.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @var Template_Modifications
	 */
	protected $template_modifications;

	/**
	 * The Meeting URL handler instance.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @var Url
	 */
	protected $url;

	/**
	 * Returns the URL of the Settings URL page.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @return string The URL of the TEC Integration settings page.
	 */
	public static function admin_url() {
		$admin_page_url = tribe( TEC_Settings::class )->get_url( [ 'tab' => 'addons' ] );

		return $admin_page_url;
	}

	/**
	 * Adds the API fields to the ones in the Events > Settings > APIs tab.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @param array<string,array> $fields The current fields.
	 *
	 * @return array<string,array> The fields, as updated by the settings.
	 */
	public function add_fields( array $fields = [] ) {
		$wrapper_classes = tribe_get_classes( [
			'tec-settings-api-application'                            => true,
			'tec-events-settings-' . static::$api_id . '-application' => true,
			'tec-settings-form__content-section'                      => true,
		] );

		$api_fields = [
			static::$option_prefix . '-wrapper_open'  => [
				'type' => 'html',
				'html' => '<div id="tribe-settings-' . static::$api_id . '-application" class="' . implode( ' ', $wrapper_classes ) . '">'
			],
			static::$option_prefix . 'authorize' => [
				'type' => 'html',
				'html' => $this->get_intro_text() . $this->get_authorize_fields(),
			],
			static::$option_prefix . '-wrapper_close'  => [
				'type' => 'html',
				'html' => '</div">'
			],
		];

		/**
		 * Filters All API settings shown to the user in the Events > Settings > Integrations tab.
		 *
		 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
		 * @todo [plugin-consolidation] Merge VE into ECP, hook to be deprecated and renamed.
		 *
		 * @param array<string,array> A map of the API fields that will be printed on the page.
		 * @param Settings $this This Settings instance.
		 */
		$api_fields = apply_filters( "tec_events_virtual_meetings_api_settings_fields", $api_fields, $this );

		/**
		 * Filters the specific API settings shown to the user in the Events > Settings > Integrations tab.
		 *
		 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
		 * @todo [plugin-consolidation] Merge VE into ECP, hook to be deprecated and renamed.
		 *
		 * @param array<string,array> A map of the API fields that will be printed on the page.
		 * @param Settings $this This Settings instance.
		 */
		$api_fields = apply_filters( 'tec_events_virtual_meetings_' . static::$api_id . '_settings_fields', $api_fields, $this );

		return $fields + $api_fields;
	}

	/**
	 * Get the key to place the API integration fields.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @return string The key to place the API integration fields.
	 */
	protected function get_integrations_fields_key() {
		/**
		 * Filters the array key to place the API integration settings.
		 *
		 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
		 * @todo [plugin-consolidation] Merge VE into ECP, hook to be deprecated and renamed.
		 *
		 * @param string The default array key to place the API integration fields.
		 * @param Settings $this This Settings instance.
		 */
		return apply_filters( 'tec_events_virtual_meetings_' . static::$api_id . '_settings_field_placement_key', 'gmaps-js-api-start', $this );
	}

	/**
	 * Provides the introductory text to the set up and configuration of the API integration.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @return string The introductory text to the the set up and configuration of the API integration.
	 */
	protected function get_intro_text() {
		return $this->template_modifications->get_intro_text();
	}

	/**
	 * Get the API authorization fields.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @return string The HTML fields.
	 */
	protected function get_authorize_fields() {
		return $this->template_modifications->get_api_authorize_fields( $this->api, $this->url );
	}
}
