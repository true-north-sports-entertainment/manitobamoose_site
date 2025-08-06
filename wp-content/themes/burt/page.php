<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/bootsrap-utilities.php for info on BsWp::get_template_parts()
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

// Check if a specific custom field (e.g., 'special_image') is set for the current page
if ((is_page('plan-your-visit')) || (is_page('frequently-asked-questions'))) {
    // If the page is 'about', display this image
    echo '
	<div id="post-header-cnt">
	<div id="post-title" class="fade-in-transform">
	<picture>
	<source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16105248/plan-your-experience-hero-v3.png" media="(min-width: 775px)" />
	<source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16105248/plan-your-experience-hero-v3.png"/>
	<img src="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16105248/plan-your-experience-hero-v3.png" alt="Bold text announcing Visitor Information in neon-style lettering."/>
	</picture>
	

	</div>
	<div class="post-thumbnail">	
	<picture>

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/17160517/plan-your-experience-hero-8.jpg" media="(min-width: 2100px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26145049/plan-your-experience-2100x369-1.jpg" media="(min-width: 1701px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26150623/plan-your-experience-576x192-1.jpg" media="(max-width: 576px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26150632/plan-your-experience-768x256-1.jpg" media="(max-width: 768px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26145544/plan-your-experience-1100x300-2.jpg" media="(max-width: 1100px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26145042/plan-your-experience-1700x387-1.jpg" media="(max-width: 1700px)" />

	<img src="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26145544/plan-your-experience-1100x300-2.jpg" alt="Visitor Information banner featuring a live band performing on stage with bright lights."/>

	</picture>
	</div>
	<div class="brdr"></div>
</div>
	';
} else if (is_page('guest-services')) {
    // If the page is 'contact', display this image
    echo '
	<div id="post-header-cnt">
	<div id="post-title" class="fade-in-transform">
	<picture>
	<source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16100012/guest-services-title.png" media="(min-width: 775px)" />
	<source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16100012/guest-services-title.png"/>
	<img src="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16100012/guest-services-title.png" alt="Bold text announcing Guest Services in neon-style lettering."/>
	</picture>
	</div>
	<div class="post-thumbnail">	
	<picture>

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/17093723/guest-services-hero-3.jpg" media="(min-width: 2100px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26153911/guest-services-2100x369-5.jpg" media="(min-width: 1701px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26155348/guest-services-576x192-6.jpg" media="(max-width: 576px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26154741/guest-services-768x256-2.jpg" media="(max-width: 768px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26154742/guest-services-1100x300-1.jpg" media="(max-width: 1100px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26154743/guest-services-1700x387-1.jpg" media="(max-width: 1700px)" />

	<img src="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26154742/guest-services-1100x300-1.jpg" alt="Guest Services banner featuring an energetic concert scene with colorful laser lights and a cheering crowd."/>

	</picture>
	</div>
	<div class="brdr"></div>
</div>
	';
} else if (is_page('seating')) {
    // Default image if none of the above conditions are met
    echo '
	<div id="post-header-cnt">
        <div id="post-title" class="fade-in-transform">
    <picture>
        <source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16111554/venue-seating-title.png" media="(min-width: 775px)" />
        <source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16111554/venue-seating-title.png" />
        <img src="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16111554/venue-seating-title.png" alt="Bold text announcing The Venue in neon-style lettering." />
    </picture>
</div>
	    <div class="post-thumbnail">	
            <picture>
                <source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/17150037/seating-hero-9.jpg" media="(min-width: 2100px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23123926/the-venue-hdr-2100-v2.jpg" media="(min-width: 1701px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23134001/the-venue-hdr-576.jpg" media="(max-width: 576px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23133828/the-venue-hdr-768.jpg" media="(max-width: 768px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23130147/the-venue-hdr-1100-v3.jpg" media="(max-width: 1100px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23130514/the-venue-hdr-1700-v2.jpg" media="(max-width: 1700px)" />

                <img src="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23130147/the-venue-hdr-1100-v3.jpg" alt="The Venue banner featuring a colorful live concert scene with vibrant stage lights and a performing band."/>
            </picture>
	    </div>
		<div class="brdr"></div>
    </div>
	';
}

else if (is_page('rentals')) {
    // Default image if none of the above conditions are met
    echo '
	<div id="post-header-cnt">
        <div id="post-title" class="fade-in-transform">
    <picture>
        <source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16112623/venue-rentals-title.png" media="(min-width: 775px)" />
        <source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16112623/venue-rentals-title.png" />
        <img src="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16112623/venue-rentals-title.png" alt="Bold text announcing The Venue in neon-style lettering." />
    </picture>
</div>
	    <div class="post-thumbnail">	
            <picture>
                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/17162738/rentals-hero-10.jpg" media="(min-width: 2100px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26194506/rentals-2100x369-1.jpg" media="(min-width: 1701px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26195855/rentals-576x192-1.jpg" media="(max-width: 576px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26195856/rentals-768x256-1.jpg" media="(max-width: 768px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26200138/rentals-1100x300-10.jpg" media="(max-width: 1100px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26195558/rentals-1700x387-2.jpg" media="(max-width: 1700px)" />

                <img src="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26195021/rentals-1100x300-1.jpg" alt="The Venue banner featuring a colorful live concert scene with vibrant stage lights and a performing band."/>
            </picture>
	    </div>
		<div class="brdr"></div>
    </div>
	';
}

else if (is_page('the-ticketmaster-lounge')) {
    // Default image if none of the above conditions are met
    echo '
	<div id="post-header-cnt">
        <div id="post-title" class="fade-in-transform">
            <picture>
                <source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/04/09103334/tm-lounge-title.png" media="(min-width: 775px)" />
                <source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/04/09103334/tm-lounge-title.png" />
                <img src="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/04/09103334/tm-lounge-title.png" alt="Bold text announcing The Venue in neon-style lettering." />
             </picture>
        </div>
	    <div class="post-thumbnail">	
            <picture>
                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/04/17111905/tm-lounge-2560x400-1.jpg" media="(min-width: 2100px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/04/17112805/tm-lounge-2100x369-1.jpg" media="(min-width: 1701px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/04/17123249/tm-lounge-576-2.jpg" media="(max-width: 576px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/04/17123248/tm-lounge-3.jpg" media="(max-width: 768px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/04/17121200/tm-lounge-1100x300-2.jpg" media="(max-width: 1100px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/04/17121529/tm-lounge-1700x300-1.jpg" media="(max-width: 1700px)" />

                <img src="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/04/17121200/tm-lounge-1100x300-2.jpg" alt="The Venue banner featuring a colorful live concert scene with vibrant stage lights and a performing band."/>
            </picture>
	    </div>
		<div class="brdr"></div>
    </div>
	';
}

else {
    // Default image if none of the above conditions are met
    echo '
	<div id="post-header-cnt" class="mb-3 mb-md-5">
	<div id="post-title">
	<picture>
	<source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16102105/whats-on-at-the-burt-hero.png" media="(min-width: 775px)" />
	<source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16102105/whats-on-at-the-burt-hero.png"/>
	<img data-src="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16102105/whats-on-at-the-burt-hero.png" loading="lazy"/>
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
	';
}

if (is_page('guest-services')) {
?>
<div class="container-fluid blocks">
    <?php
    // Custom query to fetch 'content_blocks' post type
    $args = array(
        'post_type'      => 'content_blocks', // Specify the custom post type
        'posts_per_page' => 10, // Set the number of posts you want to display
        'orderby'        => 'menu_order', // Optional: order by 'menu_order'
        'order'          => 'ASC', // Optional: set the order direction
		'tax_query'      => array(
        array(
            'taxonomy' => 'post_tag', // Specify the taxonomy (in this case, tags)
            'field'    => 'name', // You can also use 'slug' instead of 'name'
            'terms'    => 'Guest Services', // The tag you want to query for
        ),
    ),
    );

    $content_blocks_query = new WP_Query( $args );

    // The Loop
    if ( $content_blocks_query->have_posts() ) :
        while ( $content_blocks_query->have_posts() ) : $content_blocks_query->the_post(); ?>
            <div class="row">
				<div class="container d-lg-flex px-0">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 p-4 p-sm-5 pb-sm-0 pb-lg-5">
						<div class="left-cont-inner">
							<?php the_title(); ?>
							<div class="fade-in-transform"><?php the_content(); ?></div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 side-img p-4 pb-5 p-sm-5 pt-0 pt-md-5 pb-lg-5 fade-in-transform">
                    	<div class="fade-in-transform"><img src="<?php echo get_the_post_thumbnail_url(); ?>" style="width:100%;" alt="Featured Image"></div>
                	</div>
				</div>
            </div>
        <?php endwhile;
    else : ?>
        <p>No content blocks found.</p>
    <?php endif; ?>

    <?php
    // Reset post data to avoid conflicts with other queries on the page
    wp_reset_postdata();
    ?>
</div>

<?php
}
else if (is_page('frequently-asked-questions')){
?>
<div class="container px-0 px-sm-4 py-4 py-md-5">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 px-4 pb-4 px-lg-4">
            <div class="container">
                <h2 class="px-0 mb-5 fade-in-transform">Frequently Asked Questions</h2>
                <div class="accordion fade-in-transform" id="faqAccordion">
                    <?php
                    $args = array(
                        'post_type' => 'faq',
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                    );
                    $faq_query = new WP_Query($args);

                    if ($faq_query->have_posts()) : 
                        $count = 0;
                        while ($faq_query->have_posts()) : $faq_query->the_post(); ?>
                            <div class="card">
                                <div class="card-header px-4" id="heading-<?php echo $count; ?>">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link px-0 <?php echo $count === 0 ? '' : 'collapsed'; ?>" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $count; ?>" aria-expanded="<?php echo $count === 0 ? 'true' : 'false'; ?>" aria-controls="collapse-<?php echo $count; ?>">
                                            <div class="pe-4"><?php the_title(); ?></div>
                                            <i class="bi float-right <?php echo $count === 0 ? 'bi-chevron-up' : 'bi-chevron-down'; ?>"></i>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapse-<?php echo $count; ?>" class="collapse<?php echo $count === 0 ? ' show' : ''; ?>" aria-labelledby="heading-<?php echo $count; ?>" data-parent="#faqAccordion">
                                    <div class="card-body px-4 fade-in-transform">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php $count++; ?>
                        <?php endwhile; 
                        wp_reset_postdata();
                    else : ?>
                        <p><?php _e('Sorry, no FAQs found.'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 ps-lg-0 pe-lg-5 px-5 pb-0 pb-lg-4 pt-3 pt-lg-0 upc-custom fade-in-transform">
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
					echo '<h3 class="fade-in-transform">' . esc_html( $event->post_title ) . '</h3>';
					
					// Event Date
					echo '<p class="fade-in-transform">' . esc_html( tribe_get_start_date( $event ) ) . '</p>';

					$tickets = esc_url( get_permalink( $event ) );

					echo '<div class="evt-bu fade-in-transform"><a class="w-100" href="' . $tickets . '">Buy Tickets</a></div>';
					
					
				}
			} else {
				echo 'No upcoming events found.';
			}

			?>
		</div>
    </div>
</div>
<?php
}

else if (is_page('plan-your-visit')) {
    ?>
    <div class="container-fluid blocks">
        <?php
        // Custom query to fetch 'content_blocks' post type
        $args = array(
            'post_type'      => 'content_blocks', // Specify the custom post type
            'posts_per_page' => 10, // Set the number of posts you want to display
            'orderby'        => 'menu_order', // Optional: order by 'menu_order'
            'order'          => 'ASC', // Optional: set the order direction
            'tax_query'      => array(
                array(
                    'taxonomy' => 'post_tag', // Specify the taxonomy (in this case, tags)
                    'field'    => 'name', // You can also use 'slug' instead of 'name'
                    'terms'    => 'Plan Your Visit', // The tag you want to query for
                ),
            ),
        );

        $content_blocks_query = new WP_Query($args);

        // The Loop
        if ($content_blocks_query->have_posts()) :
            while ($content_blocks_query->have_posts()) : $content_blocks_query->the_post();
                $categories = get_the_category(); // Fetch categories for the current post
                $is_location = false;

                // Check if the post has the 'Location' category
                foreach ($categories as $category) {
                    if ($category->name === 'Location') {
                        $is_location = true;
                        break;
                    }
                }
        ?>
                <div class="row">
                    <div class="container d-lg-flex px-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 p-4 p-sm-5 pb-sm-0 pb-lg-5">
                            <div class="left-cont-inner">
                                <?php the_title(); ?>
                                <div class="fade-in-transform"><?php the_content(); ?></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 side-img p-4 pb-5 p-sm-5 pt-0 pt-md-5 pb-lg-5">
                            <div class="fade-in-transform">
                                <?php if ($is_location) : ?>
								
<iframe src="https://widget.arrive.com/index.html?ui-components=event-list,map,location-list&affiliate-code=pa-1246&seller-id=6845%2C6852&destination-venue-id=1794&utm-term=Widget_Web_Parking" style="height:1111px;" width="100%" scrolling="yes"></iframe>
                                
                                <?php else : ?>
                                    <!-- Featured Image -->
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" style="width:100%;" alt="Featured Image">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            endwhile;
        else :
        ?>
            <p>No content blocks found.</p>
        <?php endif; ?>

        <?php
        // Reset post data to avoid conflicts with other queries on the page
        wp_reset_postdata();
        ?>
    </div>
    <?php
}

else if(is_page('seating')){
	?>
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 p-4 p-sm-5 pb-sm-0 pt-4 pt-lg-5">
				<!--<h2 class="text-center fade-in-transform"><?php //echo the_title(); ?></h2>-->
				<div class="fade-in-transform"><?php echo the_content(); ?></div>
				<div class="fade-in-transform" id="svg-container"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-sm-12 col-md-6 p-4 pt-1 pt-md-5 pb-0 pb-sm-4 pb-md-5 px-sm-5 fade-in-transform">
				<div>
					<div class="row">
						<div class="col-xs-12 pe-0">
							<div class="w-100"><div class="blue-swatch float-start me-2 me-lg-3"></div> Main Floor</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 pe-0">
							<div class="w-100"><div class="green-swatch float-start me-2 me-lg-3"></div> Second Balcony</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 pe-0">
							<div class="w-100"><div class="darkgold-swatch float-start me-2 me-lg-3"></div> Third Balcony</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 pe-0">
							<div class="w-100"><div class="gold-swatch float-start me-2 me-lg-3"></div> Third Balcony - Bench Seating</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 p-4 ps-4 pt-sm-0 pt-md-5 px-sm-5 pb-4 pb-sm-5 fade-in-transform">
				<div><b>Note:</b> All balcony seats are accessible by stairs only (no elevator). 35 steps to the 1st balcony and 65 steps to the 2nd balcony.</div>
			</div>
		</div>
		
	</div>
	<?php
}
else if (is_page('rentals')){
	?>
		<div class="container">
			<div class="row" style="border-bottom:2px solid #e7e7e7;">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 p-4 p-sm-5 pb-0 pb-sm-0 pb-lg-5 left-cont">
					<div class="left-cont-inner">

							<h2 class="pt-2 fade-in-transform"><?php echo the_title(); ?></h2>

							<div class="fade-in-transform"><?php echo the_content(); ?></div>

							<div class="d-sm-flex mb-4 mb-md-0 py-2 py-md-0">
								<div class="evt-bu call dark pt-0 pt-md-2 p-2 w-100">
									<a href="tel:+12049877825" class="w-100 fade-in-transform">Call</a>
								</div> 
								<div class="evt-bu email dark p-2 w-100">
									<a href="mailto:bctheatre@tnse.com?subject=Venue%20Rental%20Inquiry" class="w-100 fade-in-transform">Email</a>
								</div> 
							</div>							
						</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 side-img p-4 pb-5 pt-0 pt-sm-0 p-sm-5 pt-lg-5 pb-lg-5">
					<div style="position: relative; width: 100%;">
						<h2 class="pt-md-2 fade-in-transform">Rental Request</h2>
						<p class="fade-in-transform">Please fill out the form below. We do our best to respond to all enquiries promptly. If you do not receive a reply within three (3) business days, please call <a href="tel:+2049877825">204.987.7825</a> for information.</p>
						<iframe class="fade-in-transform" style="height:1200px;display:block;width:100%;" src="https://winnipegjets.formstack.com/forms/untitled_contact_form" title="Burton Cummings Theatre - Rental Request Form" width="600" height="800"></iframe>
					</div>
				</div>
			</div>
		</div>
	<?php
}

else if (is_page('the-ticketmaster-lounge')){
	?>

<div class="fade-in-transform image-bleed-right dk"></div>
<div class="fade-in-transform">
    <?php
    $blocks = parse_blocks(get_the_content());

    foreach ($blocks as $index => $block) {
        echo render_block($block);

        if ($index === 0) {
            // Insert custom HTML after the first block
            echo '<div class="image-bleed-right mb"></div>';
        }
    }
    ?>
</div>

	<?php
}

else if (is_page('burt-block-party')){
// Get the featured image of the current page
    $featured_image_url = get_the_post_thumbnail_url(get_the_ID());

    // Debugging output
    // if ($featured_image_url) {
    //     echo '<p>Featured Image URL: ' . esc_url($featured_image_url) . '</p>';
    // } else {
    //     echo '<p>No featured image found.</p>';
    // }
    // ?>

    <!-- MAIN BANNER -->
    <div class="container" id="main-banner" 
         style="background-image: url('<?php echo esc_url($featured_image_url ?: 'path-to-default-image.jpg'); ?>');">
        <div class="fade-in-transform">
            <?php the_content(); ?>
        </div>
    </div>

<!-- INTRO CONTENT BLOCK -->
<div class="container-fluid blocks" id="intro">
    <?php
    // Custom query to fetch 'content_blocks' post type
    $args = array(
        'post_type'      => 'content_blocks', // Specify the custom post type
        'posts_per_page' => 10, // Set the number of posts you want to display
        'orderby'        => 'menu_order', // Optional: order by 'menu_order'
        'order'          => 'ASC', // Optional: set the order direction
		'tax_query'      => array(
        array(
            'taxonomy' => 'post_tag', // Specify the taxonomy (in this case, tags)
            'field'    => 'name', // You can also use 'slug' instead of 'name'
            'terms'    => 'Block Party - Content', // The tag you want to query for
        ),
    ),
    );

	$content_blocks_query = new WP_Query( $args );
    

    // The Loop
    if ( $content_blocks_query->have_posts() ) :
        while ( $content_blocks_query->have_posts() ) : $content_blocks_query->the_post(); ?>
            <div class="row">
				<div class="container d-xxl-flex">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-6 p-4 p-sm-5 pb-sm-0 pb-lg-5" id="content">
						<div class="left-cont-inner">
							<!-- <h2 class="pt-2 fade-in-transform"><?php the_title(); ?></h2> -->
							<div class="fade-in-transform"><?php the_content(); ?></div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-6 side-img p-4 pb-5 p-sm-5 pt-0 pt-md-5 pb-lg-5 fade-in-transform">
                    	<div class="fade-in-transform"><img src="<?php echo get_the_post_thumbnail_url(); ?>" style="width:100%;" alt="Featured Image"></div>
                	</div>
				</div>
            </div>
        <?php endwhile;
    else : ?>
        <!-- <p>No content blocks found.</p> -->
    <?php endif; ?>

    <?php
    // Reset post data to avoid conflicts with other queries on the page
    wp_reset_postdata();
    ?>
</div>


<!-- Lineup BLOCK -->
<div class="container-fluid blocks"id="lineup">
    <div class="row">
    <div class="container">
    <?php
    // Get only upcoming events in the "block-party" category
    $events = tribe_get_events( array(
        'posts_per_page' => 4,  // Number of events to display
        'eventDisplay'   => 'list',
        'tax_query'      => array(
            array(
                'taxonomy' => 'tribe_events_cat', // Filter by category
                'field'    => 'slug',              // Filter by slug
                'terms'    => 'block-party',       // The category slug
                'operator' => 'IN',                // Operator to match the terms
            ),
        ),
        'start_date'     => current_time( 'Y-m-d H:i:s' ), // Only show upcoming events (starting from now)
    ) );
 
    if ( ! empty( $events ) ) {
        echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 upc-custom fade-in-transform">';
        echo ' <h2 class="mb-5">Lineup</h2>';
        foreach ( $events as $event ) {
            $event_date = tribe_get_start_date( $event, false, 'D, M j @ g:i a' );
            $event_permalink = esc_url( get_permalink( $event ) );
            $event_title = esc_html( $event->post_title );
            $event_datetime_attr = tribe_get_start_date( $event, false, 'Y-m-d' );
            $event_weekday = tribe_get_start_date( $event, false, 'D' );
            $event_daynum = tribe_get_start_date( $event, false, 'j' );
            $event_excerpt = wp_trim_words( $event->post_content, 20, '...' );
            ?>

            <div class="tribe-common-g-row tribe-events-calendar-list__event-row tribe-events-calendar-list__event-row--featured">
                <div class="tribe-events-calendar-list__event-date-tag tribe-common-g-col">
                    <time class="tribe-events-calendar-list__event-date-tag-datetime" datetime="<?php echo $event_datetime_attr; ?>" aria-hidden="true">
                        <span class="tribe-events-calendar-list__event-date-tag-weekday">
                            <?php echo $event_weekday; ?>
                        </span>
                        <span class="tribe-events-calendar-list__event-date-tag-daynum tribe-common-h5 tribe-common-h4--min-medium">
                            <?php echo $event_daynum; ?>
                        </span>
                    </time>
                </div>

                <div class="tribe-events-calendar-list__event-wrapper tribe-common-g-col">
                    <article class="tribe-events-calendar-list__event tribe-common-g-row tribe-common-g-row--gutters">
                        <div class="tribe-events-calendar-list__event-featured-image-wrapper tribe-common-g-col">
                            <a href="<?php echo $event_permalink; ?>" title="<?php echo $event_title; ?>" class="tribe-events-calendar-list__event-featured-image-link" tabindex="-1" aria-hidden="true">
                                <?php if ( has_post_thumbnail( $event->ID ) ) {
                                    echo get_the_post_thumbnail( $event->ID, 'medium', ['class' => 'tribe-events-calendar-list__event-featured-image'] );
                                } ?>
                            </a>
                        </div>

                        <div class="tribe-events-calendar-list__event-details tribe-common-g-col">
                            <header class="tribe-events-calendar-list__event-header">
                                <div class="tribe-events-calendar-list__event-datetime-wrapper tribe-common-b2">
                                    <time class="tribe-events-calendar-list__event-datetime" datetime="<?php echo $event_datetime_attr; ?>">
                                        <span class="tribe-event-date-start"> <?php echo $event_date; ?> </span>
                                    </time>
                                </div>
                                <h3 class="tribe-events-calendar-list__event-title tribe-common-h6 tribe-common-h4--min-medium">
                                    <a href="<?php echo $event_permalink; ?>" title="<?php echo $event_title; ?>" class="tribe-events-calendar-list__event-title-link tribe-common-anchor-thin">
                                        <?php echo $event_title; ?>
                                    </a>
                                </h3>
                            </header>
                            <div class="tribe-events-calendar-list__event-description tribe-common-b2">
                                <p><?php echo $event_excerpt; ?></p>
                            </div>
                            <div class="photo-bu">
                                <a href="<?php echo $event_permalink; ?>">FIND TICKETS</a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <?php
        }
        echo '</div>';
    }
    
    else {
        // echo 'No upcoming Block Party events found.';
    }
    ?>

</div>
</div>
</div>

<!-- VIP TICKET BLOCK -->
<div class="container-fluid blocks" id="VIP-tickets">
    <?php
    // Custom query to fetch 'content_blocks' post type
    $args = array(
        'post_type'      => 'content_blocks',
        'posts_per_page' => 10,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'tax_query'      => array(
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'name',
                'terms'    => 'Block Party - VIP Content',
            ),
        ),
    );

    $content_blocks_query = new WP_Query( $args );

    // The Loop
    if ( $content_blocks_query->have_posts() ) :
        while ( $content_blocks_query->have_posts() ) : $content_blocks_query->the_post();
            $featured_image_url = get_the_post_thumbnail_url(); // Get the featured image URL
            ?>
            <div class="row">
                <div class="container d-lg-flex px-0">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 col-xxl-7 side-img p-4 pb-5 p-sm-5 pt-0 pt-md-5 pb-lg-5 fade-in-transform">
                        <div class="fade-in-transform" id="background-img" style="background-image: url('<?php echo esc_url($featured_image_url); ?>'); background-size: cover; background-position: bottom center; width: 100%; height: 100%;"></div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-xxl-5 p-4 p-sm-5 pb-sm-0 pb-lg-5" id="content">
                        <div class="left-cont-inner">
                            <div class="fade-in-transform"><?php the_content(); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile;
    endif;

    // Reset post data to avoid conflicts with other queries on the page
    wp_reset_postdata();
    ?>
</div>
<!--<script>
document.addEventListener("scroll", function () {
    let scrolled = window.scrollY;
    let parallaxAmount = Math.min(scrolled * -0.05, -8); // Moves up max -8px
    let bgPositionY = 50 + parallaxAmount; // Keeps background aligned

    let bg = document.getElementById("background-img");
    let parent = bg.parentElement; // Gets the parent container (.side-img)

    // Make the image 20% taller than the parent
    let newHeight = parent.clientHeight * 1.3; 

    bg.style.transform = `translate3d(0px, ${parallaxAmount}px, 0px)`;
    bg.style.backgroundPosition = `center ${bgPositionY}%`;
    bg.style.height = `${newHeight}px`; // Set height to 120% of parent
});



</script>-->


<!-- FAQ BLOCK -->
<div class="container-fluid blocks" id="faq">
    <?php
    // Custom query to fetch 'content_blocks' post type
    $args = array(
        'post_type'      => 'content_blocks', // Specify the custom post type
        'posts_per_page' => 10, // Set the number of posts you want to display
        'orderby'        => 'menu_order', // Optional: order by 'menu_order'
        'order'          => 'ASC', // Optional: set the order direction
		'tax_query'      => array(
        array(
            'taxonomy' => 'post_tag', // Specify the taxonomy (in this case, tags)
            'field'    => 'name', // You can also use 'slug' instead of 'name'
            'terms'    => 'Block Party - FAQ', // The tag you want to query for
        ),
    ),
    );

    $content_blocks_query = new WP_Query( $args );

    // The Loop
    if ( $content_blocks_query->have_posts() ) :
        while ( $content_blocks_query->have_posts() ) : $content_blocks_query->the_post(); ?>
            <div class="row">
				<div class="container d-lg-flex px-0">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 p-4">
						<div class="left-cont-inner">
							<!-- <h2 class="pt-2 fade-in-transform"><?php the_title(); ?></h2> -->
							<div class="fade-in-transform" id="contnet"><?php the_content(); ?></div>
						</div>
					</div>
				</div>
            </div>
        <?php endwhile;
    else : ?>
        <!-- <p>No content blocks found.</p> -->
    <?php endif; ?>

    <?php
    // Reset post data to avoid conflicts with other queries on the page
    wp_reset_postdata();
    ?>
</div>

<!-- Vendor OPEN Block -->
<div class="container-fluid blocks" id="vendor-open">
    <?php
    // Custom query to fetch 'content_blocks' post type
    $args = array(
        'post_type'      => 'content_blocks', // Specify the custom post type
        'posts_per_page' => 10, // Set the number of posts you want to display
        'orderby'        => 'menu_order', // Optional: order by 'menu_order'
        'order'          => 'ASC', // Optional: set the order direction
		'tax_query'      => array(
        array(
            'taxonomy' => 'post_tag', // Specify the taxonomy (in this case, tags)
            'field'    => 'name', // You can also use 'slug' instead of 'name'
            'terms'    => 'Block Party - Vendor OPEN', // The tag you want to query for
        ),
    ),
    );

	$content_blocks_query = new WP_Query( $args );

    // The Loop
    if ( $content_blocks_query->have_posts() ) :
        while ( $content_blocks_query->have_posts() ) : $content_blocks_query->the_post(); ?>
							<div class="fade-in-transform #content"><?php the_content(); ?></div>
        <?php endwhile;
    else : ?>
        <!-- <p>No content blocks found.</p> -->
    <?php endif; ?>

    <?php
    // Reset post data to avoid conflicts with other queries on the page
    wp_reset_postdata();
    ?>
</div>

<!-- Vendor CLOSED Block -->
<div class="container-fluid blocks" id="vendor-closed">
    <?php
    // Custom query to fetch 'content_blocks' post type
    $args = array(
        'post_type'      => 'content_blocks', // Specify the custom post type
        'posts_per_page' => 10, // Set the number of posts you want to display
        'orderby'        => 'menu_order', // Optional: order by 'menu_order'
        'order'          => 'ASC', // Optional: set the order direction
		'tax_query'      => array(
        array(
            'taxonomy' => 'post_tag', // Specify the taxonomy (in this case, tags)
            'field'    => 'name', // You can also use 'slug' instead of 'name'
            'terms'    => 'Block Party - Vendor CLOSED', // The tag you want to query for
        ),
    ),
    );

	$content_blocks_query = new WP_Query( $args );

    // The Loop
    if ( $content_blocks_query->have_posts() ) :
        while ( $content_blocks_query->have_posts() ) : $content_blocks_query->the_post(); ?>
							<div class="fade-in-transform" id="content"><?php the_content(); ?></div>
        <?php endwhile;
    else : ?>
        <!-- <p>No content blocks found.</p> -->
    <?php endif; ?>

    <?php
    // Reset post data to avoid conflicts with other queries on the page
    wp_reset_postdata();
    ?>
</div>


<!-- Sponsor Block -->
<div class="container-fluid blocks" id="sponsors">
    <?php
    // Custom query to fetch 'content_blocks' post type
    $args = array(
        'post_type'      => 'content_blocks', // Specify the custom post type
        'posts_per_page' => 10, // Set the number of posts you want to display
        'orderby'        => 'menu_order', // Optional: order by 'menu_order'
        'order'          => 'ASC', // Optional: set the order direction
		'tax_query'      => array(
        array(
            'taxonomy' => 'post_tag', // Specify the taxonomy (in this case, tags)
            'field'    => 'name', // You can also use 'slug' instead of 'name'
            'terms'    => 'Block Party - Sponsors', // The tag you want to query for
        ),
    ),
    );

	$content_blocks_query = new WP_Query( $args );

    // The Loop
    if ( $content_blocks_query->have_posts() ) :
        while ( $content_blocks_query->have_posts() ) : $content_blocks_query->the_post(); ?>
							<div class="fade-in-transform" id="content"><?php the_content(); ?></div>
        <?php endwhile;
    else : ?>
        <!-- <p>No content blocks found.</p> -->
    <?php endif; ?>

    <?php
    // Reset post data to avoid conflicts with other queries on the page
    wp_reset_postdata();
    ?>
</div>

<!--  -->

	<?php
}

 
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>
