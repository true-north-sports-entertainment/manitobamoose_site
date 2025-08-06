<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */
?>
<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = Tribe__Events__Main::postIdHelper( get_the_ID() );

/**
 * Allows filtering of the event ID.
 *
 * @since 6.0.1
 *
 * @param numeric $event_id
 */
$event_id = apply_filters( 'tec_events_single_event_id', $event_id );

/**
 * Allows filtering of the single event template title classes.
 *
 * @since 5.8.0
 *
 * @param array   $title_classes List of classes to create the class string from.
 * @param numeric $event_id      The ID of the displayed event.
 */
$title_classes = apply_filters( 'tribe_events_single_event_title_classes', [ 'tribe-events-single-event-title' ], $event_id );
$title_classes = implode( ' ', tribe_get_classes( $title_classes ) );
$website = tribe_get_event_website_url( $event_id );

/**
 * Allows filtering of the single event template title before HTML.
 *
 * @since 5.8.0
 *
 * @param string  $before   HTML string to display before the title text.
 * @param numeric $event_id The ID of the displayed event.
 */
$before = apply_filters( 'tribe_events_single_event_title_html_before', '<h1 class="' . $title_classes . '">', $event_id );

/**
 * Allows filtering of the single event template title after HTML.
 *
 * @since 5.8.0
 *
 * @param string  $after    HTML string to display after the title text.
 * @param numeric $event_id The ID of the displayed event.
 */
$after = apply_filters( 'tribe_events_single_event_title_html_after', '</h1>', $event_id );

/**
 * Allows filtering of the single event template title HTML.
 *
 * @since 5.8.0
 *
 * @param string  $after    HTML string to display. Return an empty string to not display the title.
 * @param numeric $event_id The ID of the displayed event.
 */
$title = apply_filters( 'tribe_events_single_event_title_html', the_title( $before, $after, false ), $event_id );
$cost  = tribe_get_formatted_cost( $event_id );
?>
<div class="row">
	<div class="col-12">
		<p class="tribe-events-back">
			<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '&laquo; ' . esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
		</p>
		<!-- Notices -->
		<?php tribe_the_notices() ?>

		<?php echo $title; ?>

		<div class="tribe-events-schedule tribe-clearfix">
			<?php 
			// Get the start and end date without the year
			$start_date = tribe_get_start_date( $event_id, false, 'D, M j @ g:i a' ); // Example: "November 26"
			$end_date = tribe_get_end_date( $event_id, false, 'D, M j @ g:i a' ); 

			// Check if it's a multi-day event
			if ( $start_date !== $end_date ) {
				echo '<h2>' . esc_html( $start_date ) . '</h2>';
			} else {
				echo '<h2>' . esc_html( $start_date ) . '</h2>';
			}
			?>
			<a href="<?php echo esc_url( $website ); ?>" class="single-evt-bu" target="_blank">Buy Tickets</a>
		</div>

	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-7 col-xl-7 col-xxl-7">
		<!-- Event header -->
		<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>></div>
		<!-- #tribe-events-header -->

		<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Event featured image, but exclude link -->
			<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->
			<div><?php do_action( 'tribe_events_single_event_after_the_content' ) ?></div>
		
		</div> <!-- #post-x -->
	</div> <!-- end left column -->
	<div class="col-sm-12 col-md-12 col-lg-5 col-xl-5 col-xxl-5">
		<!-- Event meta -->
		<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
		<div class="meta-col">
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php echo '<div class="evt-bu justify-content-start ms-0 ms-lg-5 mb-3 mb-lg-0"><a class="mt-0 w-100 w-lg-auto" href="' . $website . '" target="_blank">Buy Tickets</a></div>'; ?>
		</div>
	</div>
</div><!-- end row -->
<div class="row">
	<div class="col-xs-12">
		<!-- Event footer -->
		<div id="tribe-events-footer">
			<!-- Navigation -->
			<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
				<ul class="tribe-events-sub-nav">
					<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> <span class="title-label">Previous Event</span>' ) ?></li>
					<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '<span class="title-label">Next Event</span> <span>&raquo;</span>' ) ?></li>
				</ul>
				<!-- .tribe-events-sub-nav -->
			</nav>
		</div>
		<!-- #tribe-events-footer -->
	</div>
</div>
<div class="row">
	<div class="col-xs-12 px-0 pb-xl-2">
		<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		<?php endwhile; ?>
	</div>
</div>









