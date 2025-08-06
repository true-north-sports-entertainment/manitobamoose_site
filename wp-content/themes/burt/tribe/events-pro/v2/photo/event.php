<?php
/**
 * View: Photo Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-pro/v2/photo/event.php
 *
 * See more documentation about our views templating system.
 *
 * @link https://evnt.is/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 * @var string $placeholder_url The url for the placeholder image if a featured image does not exist.
 *
 * @see tribe_get_event() For the format of the event object.
 */

$classes = get_post_class( [ 'tribe-common-g-col', 'tribe-events-pro-photo__event' ], $event->ID );

if ( ! empty( $event->featured ) ) {
	$classes[] = 'tribe-events-pro-photo__event--featured';
}
?>
<article <?php tribe_classes( $classes ) ?>>

	<?php $this->template( 'photo/event/featured-image', [ 'event' => $event ] ); ?>

	<div class="tribe-events-pro-photo__event-details-wrapper">
		<?php $this->template( 'photo/event/date-tag', [ 'event' => $event ] ); ?>
		<div class="tribe-events-pro-photo__event-details">
			<?php $this->template( 'photo/event/date-time', [ 'event' => $event ] ); ?>
			<?php $this->template( 'photo/event/title', [ 'event' => $event ] ); ?>
			<?php $this->template( 'photo/event/cost', [ 'event' => $event ] ); ?>
		</div>
	</div>
    <div class="photo-bu mt-auto mx-auto">
        <?php 
        // Retrieve the event URL or use the permalink if the URL is empty
        $event_url = tribe_get_event_meta( get_the_ID(), '_EventURL', true );
        $link_target = !empty($event_url) ? '_blank' : '_self'; // Open in new tab if event URL, same tab if permalink
        $event_url = !empty($event_url) ? $event_url : get_the_permalink();
        $event_permalink = get_the_permalink();
        ?>
        <a href="<?php echo esc_url($event_permalink); ?>">FIND TICKETS
        </a>
    </div>
</article>
