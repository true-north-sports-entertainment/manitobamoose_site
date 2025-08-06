<?php
/**
 * Search results page
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 5.3.2
 * @autor 		Babobski
 */
$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/html-header', 
	'parts/shared/header'
]);
?>

<div id="post-header-cnt" class="mb-3 mb-md-5">
	<div id="post-title">
	<picture>
	<source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/15150118/site-search.png" media="(min-width: 775px)" />
	<source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/15150118/site-search.png"/>
	<img data-src="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/15150118/site-search.png" loading="lazy"/>
	</picture>
	</div>
	<div class="post-thumbnail">		
	<picture>
	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/17124752/whats-on-hero-6.jpg" media="(min-width: 2100px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26170708/whats-on-2100x369-1.jpg" media="(min-width: 1701px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26174847/whats-on-576-192-v12.jpg" media="(max-width: 576px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26174847/whats-on-768x256-v12.jpg" media="(max-width: 768px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26172224/whats-on-1100x300-1.jpg" media="(max-width: 1100px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26171634/whats-on-1700x387-2.jpg" media="(max-width: 1700px)" />

	<img src="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26174847/whats-on-576-192-v12.jpg" />
	</picture>
	</div>
	<div class="brdr"></div>
</div>
<div class="container wrapper px-4 px-md-5 px-xxl-4">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 px-4 px-sm-5 px-md-4 px-lg-4">
			<div class="search-form col-12 mb-5 pt-3 pt-md-2">
				<?php get_search_form(); ?>
			</div>
			<?php if ( have_posts() ): ?>
				<div class="content">
					<h1 class="sr-h1"><?php echo __('Search Results for', 'wp_babobski'); ?> '<?php echo get_search_query(); ?>'</h1>
					<ul class="list-unstyled">
						<?php while ( have_posts() ) : the_post(); ?>
						<li class="media">
							<div class="media-body">
								<h2>
								<a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
								</h2>
								<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
									<?php the_date(); ?> <?php the_time(); ?>
								</time>
							
								<?php the_content(); ?>
							</div>
						</li>
						<?php endwhile; ?>
					</ul>
				</div>
			<?php else: ?>
			<h1>
				<?php echo __('No results found for', 'wp_babobski'); ?> '<?php echo get_search_query(); ?>'
			</h1>
			<?php endif; ?>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 ps-lg-4 pe-lg-4 px-4 px-sm-5 px-md-4 px-lg-4 pb-0 pb-lg-4 pt-3 pt-lg-0 upc-custom">
			<h2 class="mb-5">Upcoming Events</h2>
			<?php
			$events = tribe_get_events( array(
				'posts_per_page' => 3, // Number of events to display
				'eventDisplay'   => 'list',
			) );

			// Output the events (customize this as needed)
			if ( ! empty( $events ) ) {
				foreach ( $events as $event ) {
					// Featured Image (if available)
					if ( has_post_thumbnail( $event->ID ) ) {
						echo get_the_post_thumbnail( $event->ID, 'medium' );  // Display featured image (size: medium)
					}

					// Event Title
					echo '<h3>' . esc_html( $event->post_title ) . '</h3>';
					
					// Event Date
					echo '<p>' . esc_html( tribe_get_start_date( $event ) ) . '</p>';

					$tickets = esc_url( get_permalink( $event ) );

					echo '<div class="evt-bu"><a class="w-100" href="' . $tickets . '">Buy Tickets</a></div>';
					
					
				}
			} else {
				echo 'No upcoming events found.';
			}

			?>
		</div>
	</div>
</div>




<?php 
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>