<?php
/**
 * View: Month View - Calendar Event Featured Image
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/calendar-body/day/calendar-events/calendar-event/featured-image.php
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

 echo '<!-- Custom edit featured-image.php -->';
 
 $thumbnail = get_the_post_thumbnail( $event->ID, 'thumbnail' );
 
 if ( ! $thumbnail ) {
	 return;
 }
 
 ?>
 <div class="tribe-events-calendar-month__calendar-event-featured-image-wrapper">
	 <a
		 href="<?php echo esc_url( $event->permalink ); ?>"
		 title="<?php echo esc_attr( $event->title ); ?>"
		 rel="bookmark"
		 class="tribe-events-calendar-month__calendar-event-featured-image-link"
	 >
		 <?php echo $thumbnail; ?>
	 </a>
 </div>
