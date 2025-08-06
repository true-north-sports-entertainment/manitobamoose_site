<?php
/**
 * View: List Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

$container_classes = [ 'tribe-common-g-row', 'tribe-events-calendar-list__event-row' ];
$container_classes['tribe-events-calendar-list__event-row--featured'] = $event->featured;

$event_classes = tribe_get_post_class( [ 'tribe-events-calendar-list__event', 'tribe-common-g-row', 'tribe-common-g-row--gutters' ], $event->ID );
?>
<div <?php tribe_classes( $container_classes ); ?>>

	<?php $this->template( 'list/event/date-tag', [ 'event' => $event ] ); ?>

	<div class="tribe-events-calendar-list__event-wrapper tribe-common-g-col">
		<article <?php tribe_classes( $event_classes ) ?>>
			<?php $this->template( 'list/event/featured-image', [ 'event' => $event ] ); ?>

			<div class="tribe-events-calendar-list__event-details tribe-common-g-col">

				<header class="tribe-events-calendar-list__event-header">
					<?php $this->template( 'list/event/date', [ 'event' => $event ] ); ?>
					<?php $this->template( 'list/event/title', [ 'event' => $event ] ); ?>
				</header>
				<?php $this->template( 'list/event/description', [ 'event' => $event ] ); ?>
				<div class="photo-bu">
					<?php 
					// Retrieve the event URL or use the permalink if the URL is empty
					$event_url = tribe_get_event_meta( get_the_ID(), '_EventURL', true );
					$link_target = !empty($event_url) ? '_blank' : '_self'; // Open in new tab if event URL, same tab if permalink
					$event_url = !empty($event_url) ? $event_url : get_the_permalink();
					?>
					<a href="<?php echo esc_url($event_url); ?>">FIND TICKETS
					</a>
				</div>
			</div>
		</article>
	</div>

</div>
