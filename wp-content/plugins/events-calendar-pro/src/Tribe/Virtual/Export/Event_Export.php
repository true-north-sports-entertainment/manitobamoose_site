<?php
/**
 * Export functions for the plugin.
 *
 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
 * @package Tribe\Events\Virtual\Service_Providers;
 */

namespace Tribe\Events\Virtual\Export;

/**
 * Class Event_Export
 *
 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
 *
 * @package Tribe\Events\Virtual\Export;
 */
class Event_Export extends Abstract_Export {

	/**
	 * Modify the export parameters for a virtual event export.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @param array  $fields   The various file format components for this specific event.
	 * @param int    $event_id The event id.
	 * @param string $key_name The name of the array key to modify.
	 * @param string $type     The name of the export type.
	 *
	 * @return array The various file format components for this specific event.
	 */
	public function modify_export_output( $fields, $event_id, $key_name, $type = null ) {
		$event = tribe_get_event( $event_id );

		if ( ! $event instanceof \WP_Post ) {
			return $fields;
		}

		// If it is not a virtual event, return fields.
		if ( ! $event->virtual ) {
			return $fields;
		}

		/**
		 * Filters whether or not we should respect the Venue value to be listed on the location field. If
		 * false the Venue will be preserved, if true the Virtual Event URL will replace it.
		 *
		 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
		 * @todo [plugin-consolidation] Merge VE into ECP, hook to be deprecated and renamed.
		 *
		 * @param boolean   Whether to override the venue location field with the virtual URL.
		 * @param \WP_Post $event The WP_Post of this event.
		 */
		$should_override_venue = apply_filters( 'tec_events_virtual_export_should_override_venue_location', false, $event );

		// If there is a venue and not overwritten, return fields as is.
		if ( isset( $event->venues[0] ) && ! $should_override_venue ) {
			return $fields;
		}

		/**
		 * Allows filtering of whether the current user should have export fields modified.
		 *
		 * Utilizes the values from the Show To field and provides the result to each video source
		 * where it can be overridden.
		 *
		 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
		 * @todo [plugin-consolidation] Merge VE into ECP, hook to be deprecated and renamed.
		 *
		 * @param boolean   Whether to modify the export fields for the current user, default to false.
		 * @param \WP_Post $event The WP_Post of this event.
		 */
		$should_show = apply_filters( 'tec_events_virtual_export_should_show', false, $event );

		/**
		 * Allow filtering of the export fields by the active video source.
		 *
		 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
		 * @todo [plugin-consolidation] Merge VE into ECP, hook to be deprecated and renamed.
		 *
		 * @param array    $fields      The various file format components for this specific event.
		 * @param \WP_Post $event       The WP_Post of this event.
		 * @param string   $key_name    The name of the array key to modify.
		 * @param string   $type        The name of the export type.
		 * @param boolean  $should_show Whether to modify the export fields for the current user, default to false.
		 */
		$fields = apply_filters( 'tec_events_virtual_export_fields', $fields, $event, $key_name, $type, $should_show );

		return $fields;
	}

	/**
	 * Modify the export parameters for the video source.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @param array    $fields      The various file format components for this specific event.
	 * @param \WP_Post $event       The WP_Post of this event.
	 * @param string   $key_name    The name of the array key to modify.
	 * @param string   $type        The name of the export type.
	 * @param boolean  $should_show Whether to modify the export fields for the current user, default to false.
	 *
	 * @return array The various file format components for this specific event.
	 */
	public function modify_video_source_export_output( $fields, $event, $key_name, $type, $should_show ) {
		if ( 'video' !== $event->virtual_video_source ) {
			return $fields;
		}

		// If it should not show or it should not embed video or no linked button, set the permalink and return.
		if (
			! $should_show ||
			(
				$event->virtual_embed_video &&
				! $event->virtual_linked_button
			)||
			(
				! $event->virtual_embed_video &&
				! $event->virtual_linked_button
			)
		 ) {
			$fields[ $key_name ] = $this->format_value( get_the_permalink( $event->ID ), $key_name, $type );

			return $fields;
		}

		$url = $event->virtual_url;


		$fields[ $key_name ] = $this->format_value( $url, $key_name, $type );

		return $fields;
	}

	/**
	 * Filter whether the current user should see the video source in the export.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @param boolean  $should_show Whether to modify the export fields for the current user, default to false.
	 * @param \WP_Post $event       The WP_Post of this event.
	 *
	 * @return boolean Whether to modify the export fields for the current user.
	 */
	public function filter_export_should_show( $should_show, $event ) {
		if ( ! $event instanceof \WP_Post ) {
			return $should_show;
		}

		$show_to = (array) $event->virtual_show_embed_to;

		if ( empty( $show_to ) ) {
			return false;
		}

		if ( in_array( 'all', $show_to, true ) ) {
			return true;
		}

		// Everything after this depends on the user being logged in.
		if ( ! is_user_logged_in() ) {
			return false;
		}

		// Do we need to be logged in?
		if ( in_array( 'logged-in', $show_to ) ) {
			return true;
		}

		return $should_show;
	}

	/**
	 * Filter the Outlook single event export url for a Zoom source event.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @param string               $url             The url used to subscribe to a calendar in Outlook.
	 * @param string               $base_url        The base url used to subscribe in Outlook.
	 * @param array<string|string> $params          An array of parameters added to the base url.
	 * @param Outlook_Methods      $outlook_methods An instance of the link abstract.
	 *
	 * @return string The export url used to generate an Outlook event for the single event.
	 */
	public function filter_outlook_single_event_export_url( $url, $base_url, $params, $outlook_methods ) {
		if ( ! is_single() ) {
			return $url;
		}

		// Getting the event details.
		$event = tribe_get_event();
		if ( ! $event instanceof \WP_Post ) {
			return $url;
		}

		// If it is not a virtual event, return url.
		if ( ! $event->virtual ) {
			return $url;
		}

		// If there is a venue, return url as is.
		if ( isset( $event->venues[0] ) ) {
			return $url;
		}

		/**
		 * Allows filtering of whether the current user should have export fields modified.
		 *
		 * Utilizes the values from the Show To field and provides the result to each video source
		 * where it can be overridden.
		 *
		 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
		 * @todo [plugin-consolidation] Merge VE into ECP, hook to be deprecated and renamed.
		 *
		 * @param boolean   Whether to modify the export fields for the current user, default to false.
		 * @param \WP_Post $event The WP_Post of this event.
		 */
		$should_show = apply_filters( 'tec_events_virtual_export_should_show', false, $event );

		/**
		 * Allow filtering of the export fields by the active video source.
		 *
		 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
		 * @todo [plugin-consolidation] Merge VE into ECP, hook to be deprecated and renamed.
		 *
		 * @param string               $url             The url used to subscribe to a calendar in Outlook.
		 * @param string               $base_url        The base url used to subscribe in Outlook.
		 * @param array<string|string> $params          An array of parameters added to the base url.
		 * @param Outlook_Methods      $outlook_methods An instance of the link abstract.
		 * @param \WP_Post             $event           The WP_Post of this event.
		 * @param boolean              $should_show     Whether to modify the export fields for the current user, default to false.
		 */
		$url = apply_filters( 'tec_events_virtual_outlook_single_event_export_url', $url, $base_url, $params, $outlook_methods, $event, $should_show );

		return $url;
	}
}
