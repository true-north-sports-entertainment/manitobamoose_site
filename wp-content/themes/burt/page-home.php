<?php
/*
Template Name: Home Page
 *
 * Please see /external/bootsrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 5.3.2
 * @autor 		Babobski
 */
$BsWp = new BsWp;

// Function to process an event and return the values as an associative array
function process_event($event) {
    $event_id = $event->ID;
    $event_title = esc_html($event->post_title);
    $event_content = wpautop($event->post_content);
    $event_date = tribe_get_start_date($event_id, false, 'D, M j, Y');
    $event_featured_image_url = get_the_post_thumbnail_url($event_id, 'large');
    $event_featured_image_url = str_replace('http://', 'https://', $event_featured_image_url);
    $event_featured_image = '<img src="' . esc_url($event_featured_image_url) . '" alt="">';
    $event_square_featured_image_id = get_post_meta($event_id, '_second_featured_image', true);
    /*$event_square_featured_image = wp_get_attachment_image_url($event_square_featured_image_id, 'square-large');*/
    $event_square_featured_image_srcset = wp_get_attachment_image_srcset($event_square_featured_image_id, 'square-large');
    $event_square_featured_image_srcset = str_replace('http://', 'https://', $event_square_featured_image_srcset);
    $event_permalink = get_permalink($event_id);
    $event_subtitle = get_post_meta($event_id, 'subtitle', true);
    $event_links = get_event_links($event_id);
    
    // Return the processed values as an associative array
    return array(
        'event_id' => $event_id,
        'event_title' => $event_title,
        'event_content' => $event_content,
        'event_date' => $event_date,
        'event_featured_image' => $event_featured_image,
        /*'event_square_featured_image' => $event_square_featured_image,*/
        'event_square_featured_image_srcset' => $event_square_featured_image_srcset,
        'event_permalink' => $event_permalink,
        'event_subtitle' => $event_subtitle,
        'event_links' => $event_links,
    );
}

// Retrieve the fully processed Event posts from the cache if it's available; else generate 
// and cache that data right now.
$str_cache_key = 'home-page-events-featured';
if ( false === ( $arr_events_processed = get_transient($str_cache_key) ) ) {
    $arr_events_processed = [];
    foreach ( ['primary', 'secondary', 'tertiary'] as $str_tag ) {
        $args = array(
            'eventDisplay' => 'custom',
            'featured' => true,  // Filter by featured events
            'tag' => $str_tag,
            'posts_per_page' => 1, // Limit to 1 post
            'start_date' => date('Y-m-d') // Only events starting from today (future events)
        );
        $arr_post_events = tribe_get_events($args);

        foreach ( $arr_post_events as $obj_post_event ) {
            $arr_events_processed[$str_tag] = process_event($obj_post_event);
        }
    }

    // Cache the processed Events for the rest of the current day (so we roll over at midnight).
    set_transient( $str_cache_key, $arr_events_processed, get_seconds_left_in_current_day() );
}

// Retrieve Content Blocks posts from the cache if it's available; else generate and cache 
// that data right now.
$str_cache_key = 'home-page-content-blocks';
if ( false === ( $content_blocks_query = get_transient($str_cache_key) ) ) {
    $args = array(
        'post_type'      => 'content_blocks', // Specify the custom post type
        'posts_per_page' => 1, // Set the number of posts you want to display
        'order'          => 'ASC', // Optional: set the order direction
        'tax_query'      => array(
            array(
                'taxonomy' => 'post_tag', // Specify the taxonomy (in this case, tags)
                'field'    => 'name', // You can also use 'slug' instead of 'name'
                'terms'    => 'Home', // The tag you want to query for
            ),
        ),
    );
    $content_blocks_query = new WP_Query( $args );

    // Cache the Content Blocks query for the rest of the current day (so we roll over at midnight).
    set_transient( $str_cache_key, $content_blocks_query, get_seconds_left_in_current_day() );
}

$BsWp->get_template_parts([
    'parts/shared/html-header', 
    'parts/shared/header'
]);
?>
    <div class="container-fluid featured p-0 pt-4 pt-sm-4 pt-md-4 pt-lg-5 px-sm-4 pb-2 pb-lg-5">
        <div class="container wrapper">
            <div class="row mb-lg-">
                <?php
                // Check if 'primary' exists in $arr_events_processed and assign it to $processed_event
                $processed_event = $arr_events_processed['primary'] ?? null;

                if ($processed_event) : // Proceed only if $processed_event is not null
                ?>
                    <div id="primary-evt" class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                        <div class="row">
                            <div class="col-xs-12 fade-in-transform">
                                <a href="<?php echo $processed_event['event_permalink'] ?? '#'; ?>">
                                    <picture>
                                        <source srcset="<?php echo $processed_event['event_square_featured_image_srcset'] ?? ''; ?>" media="(max-width: 767px)">
                                        <?php echo $processed_event['event_featured_image'] ?? ''; ?>
                                    </picture>
                                </a>
                            </div>
                        </div>
                        <div class="row px-md-4 mt-4 info">    
                            <div class="evt-cont fade-in-transform col-xs-12 col-sm-12 col-md-8 col-lg-12 col-xl-8">
                                <div class="evt-date">
                                    <div class="featured-badge">
                                        <em class="tribe-events-pro-photo__event-datetime-featured-icon" title="Featured">
                                            <svg class="tribe-common-c-svgicon tribe-common-c-svgicon--featured tribe-events-pro-photo__event-datetime-featured-icon-svg" viewBox="0 0 8 10" xmlns="http://www.w3.org/2000/svg">
                                                <path fill="#00A562" fill-rule="evenodd" clip-rule="evenodd" d="M0 0h8v10L4.049 7.439 0 10V0z"></path>
                                            </svg>
                                        </em>
                                    </div>
                                    <?php echo $processed_event['event_date'] ?? ''; ?>
                                </div>
                                <div class="evt-title"><a href="<?php echo $processed_event['event_permalink'] ?? '#'; ?>"><?php echo $processed_event['event_title'] ?? ''; ?></a></div>
                                <div class="evt-subtitle">
                                    <?php 
                                        // Provide a default value if no subtitle exists
                                        echo esc_html($processed_event['event_subtitle'] ?? 'Tickets On Sale Now!');
                                    ?>
                                </div>
                                <?php if (!empty($processed_event['event_links'])) : ?>
                                    <div class="evt-links">
                                        <?php echo $processed_event['event_links']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="evt-bu fade-in-transform d-flex justify-content-start col-12 col-md-4 col-lg-12 col-xl-4">
                                <a href="<?php echo $processed_event['event_permalink'] ?? '#'; ?>">FIND TICKETS</a>
                            </div>  
                        </div>
                    </div>
                <?php endif; ?>


                <div id="secondary-evts" class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                    <div class="row">
                        <?php
                        // Check if 'secondary' exists in $arr_events_processed and assign it to $processed_event
                        $processed_event = $arr_events_processed['secondary'] ?? null;

                        if ($processed_event) : // Proceed only if $processed_event is not null
                        ?>
                            <div class="secondary col-xs-12 col-sm-12 col-md-6 col-lg-12">
                                <div class="row fade-in-transform">
                                    <a href="<?php echo $processed_event['event_permalink'] ?? '#'; // Default to '#' if URL is missing ?>">
                                        <picture>
                                            <source srcset="<?php echo $processed_event['event_square_featured_image_srcset'] ?? ''; ?>" media="(max-width: 991px)">
                                            <?php echo $processed_event['event_featured_image'] ?? ''; ?>
                                        </picture>
                                    </a>
                                </div>
                                <div class="row mt-4 mb-5 px-md-4 info">    
                                    <div class="evt-cont fade-in-transform col-xs-12 col-sm-12 col-lg-8 pe-lg-4 pe-xl-0">
                                        <div class="evt-date">
                                            <div class="featured-badge">
                                                <em class="tribe-events-pro-photo__event-datetime-featured-icon" title="Featured">
                                                    <svg class="tribe-common-c-svgicon tribe-common-c-svgicon--featured tribe-events-pro-photo__event-datetime-featured-icon-svg" viewBox="0 0 8 10" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill="#00A562" fill-rule="evenodd" clip-rule="evenodd" d="M0 0h8v10L4.049 7.439 0 10V0z"></path>
                                                    </svg>
                                                </em>
                                            </div>    
                                            <?php echo $processed_event['event_date'] ?? ''; ?>
                                        </div>
                                        <div class="evt-title"><a href="<?php echo $processed_event['event_permalink'] ?? '#'; ?>"><?php echo $processed_event['event_title'] ?? ''; ?></a></div>
                                        <div class="evt-subtitle">
                                            <?php 
                                            // Provide a default value if no subtitle exists
                                            echo esc_html($processed_event['event_subtitle'] ?? 'Tickets On Sale Now!');
                                            ?>
                                        </div>
                                        <?php if (!empty($processed_event['event_links'])) : ?>
                                            <div class="evt-links">
                                                <?php echo $processed_event['event_links']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="evt-bu fade-in-transform d-flex col-xs-12 col-sm-12 col-lg-4">
                                        <a class="mt-2 mt-md-0" href="<?php echo $processed_event['event_permalink'] ?? '#'; ?>"></a>
                                    </div>   
                                </div>
                            </div>
                        <?php endif; ?>


                        <?php
                    // Check if 'tertiary' exists in $arr_events_processed and assign it to $processed_event
                    $processed_event = $arr_events_processed['tertiary'] ?? null;

                    if ($processed_event) : // Proceed only if $processed_event is not null
                    ?>
                        <div class="tertiary col-xs-12 col-sm-12 col-md-6 col-lg-12">
                            <div class="row fade-in-transform">
                                <a href="<?php echo $processed_event['event_permalink'] ?? '#'; ?>">
                                    <picture>
                                        <source srcset="<?php echo $processed_event['event_square_featured_image_srcset'] ?? ''; ?>" media="(max-width: 991px)">
                                        <?php echo $processed_event['event_featured_image'] ?? ''; ?>
                                    </picture>
                                </a>
                            </div>
                            <div class="row mt-4 px-md-4 info">
                                <div class="evt-cont fade-in-transform tertiary col-xs-12 col-sm-12 col-lg-8 pe-lg-4 pe-xl-0">
                                    <div class="evt-date">
                                        <div class="featured-badge">
                                            <em class="tribe-events-pro-photo__event-datetime-featured-icon" title="Featured">
                                                <svg class="tribe-common-c-svgicon tribe-common-c-svgicon--featured tribe-events-pro-photo__event-datetime-featured-icon-svg" viewBox="0 0 8 10" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill="#00A562" fill-rule="evenodd" clip-rule="evenodd" d="M0 0h8v10L4.049 7.439 0 10V0z"></path>
                                                </svg>
                                            </em>
                                        </div>
                                        <?php echo $processed_event['event_date'] ?? ''; ?>
                                    </div>
                                    <div class="evt-title"><a href="<?php echo $processed_event['event_permalink'] ?? '#'; ?>"><?php echo $processed_event['event_title'] ?? ''; ?></a></div>
                                    <div class="evt-subtitle">
                                        <?php 
                                            // Provide a default value if no subtitle exists
                                            echo $processed_event['event_subtitle'] ?? 'Tickets On Sale Now!';
                                        ?>
                                    </div>
                                    <?php if (!empty($processed_event['event_links'])) : ?>
                                        <div class="evt-links">
                                            <?php echo $processed_event['event_links']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="evt-bu fade-in-transform d-flex col-xs-12 col-sm-12 col-lg-4">
                                    <a class="mt-2 mt-md-0" href="<?php echo $processed_event['event_permalink'] ?? '#'; ?>"></a>
                                </div>   
                            </div>
                        </div>
                    <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- Closing div tag for landing-wrapper --> 
<!--<div class="container-fluid upc">
    <div class="container wrapper">-->
        <div class="row upcoming mt-0 p-0 pt-md-5" style="background-color:#ffffff;">
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>

        <div class="container-fluid">
    <div class="row">
        <div class="parallax d-flex justify-content-center align-items-center position-relative" style="background-image: url('//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/11/20115219/bct-exterior-edit-v2.jpg'); background-position: bottom center;">
            <!-- Overlay -->
            <div class="overlay position-absolute w-100 h-100" style="background-color: rgba(0, 0, 0, 0.3);"></div>
            <!-- Quote Content -->
            <!--<div id="quote" class="text-center position-relative p-5 p-md-5">
                <h1>It’s part of <span class="green">Winnipeg’s heritage</span>, and I’m glad to be connected to it in such a lasting way.</h1>
				<p>- &nbsp; Burton Cummings</p>
            </div>-->
        </div>
    </div>
</div>

 <!--   </div>
</div>-->
<!--<div class="container-fluid">
    <div class="row">
        <div class="parallax d-flex justify-content-center align-items-center position-relative" style="background-image: url('//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2023/11/21163234/experience-v3.jpg');background-position:bottom center;">
            <div class="overlay position-absolute w-100 h-100" style="background-color: rgba(0, 0, 0, .5);"></div>
            <div id="parallax-h1" class="text-center position-relative">
                <h1>Experience the magic of the<br /><span>Burton Cummings Theatre.</span></h1>
            </div>-->
        <!--</div>
    </div>
                                    </div>-->




<div class="container-fluid">
    <?php
    // The Loop
    if ( $content_blocks_query->have_posts() ) :
        while ( $content_blocks_query->have_posts() ) : $content_blocks_query->the_post(); ?>
            <div class="container wrapper" style="background-color:#ffffff;">
                <div class="row">
                    <div class="col-12 col-xl-6 py-4 py-sm-5 px-0 px-sm-4 pb-0 pb-sm-0 pb-xl-5">
                        <h1 class="pt-0 pt-lg-3 fade-in-transform">Experience the <i>magic</i> of the <b>Burton Cummings Theatre!</b></h1>
						<div class="fade-in-transform"><?php the_content(); ?></div>
					</div>
                    <div class="col-12 col-xl-6 py-4 py-lg-5 p-4 py-sm-5 ps-0 ps-sm-4 ps-xl-5 ps-xl-5 pe-0 pe-sm-4 pe-xl-4 my-lg-4">
                        <img 
                            src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" 
                            alt="Neon-lit Burton Cummings Theatre sign glowing at dusk, with string lights hanging across the street, creating a vibrant atmosphere in downtown Winnipeg." 
                            style="width:100%;" loading="lazy" decoding="async" class="fade-in-transform"
                        />
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
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>