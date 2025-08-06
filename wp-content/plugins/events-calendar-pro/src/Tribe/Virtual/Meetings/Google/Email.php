<?php
/**
 * Manages the Google Meet Email
 *
 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
 *
 * @package Tribe\Events\Virtual\Meetings\Google
 */

namespace Tribe\Events\Virtual\Meetings\Google;

use Tribe\Events\Virtual\Meetings\Google\Event_Meta as Google_Event_Meta;

/**
 * Class Email
 *
 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
 *
 * @package Tribe\Events\Virtual\Meetings\Google
 */
class Email {

	/**
	 * Conditionally inject content into ticket email templates.
	 *
	 * @since 7.0.0 Migrated to Events Pro from Events Virtual.
	 *
	 * @param string $template The template path, relative to src/views.
	 * @param array  $args     The template arguments.
	 *
	 * @return string
	 */
	public function maybe_change_email_template( $template, $args ) {
		$event = $args['event'];

		// Get event if not an object and an integer.
		if (
			is_integer( $args['event']  )
		) {
			$event = tribe_get_event( $args['event'] );
		}

		if ( empty( $event ) ) {
			return $template;
		}

		if (
			empty( $event->virtual )
			|| empty( $event->virtual_meeting )
			|| Google_Event_Meta::$key_source_id !== $event->virtual_meeting_provider
		) {
			return $template;
		}

		$template = 'google/email/ticket-email-google-details';

		return $template;
	}
}
