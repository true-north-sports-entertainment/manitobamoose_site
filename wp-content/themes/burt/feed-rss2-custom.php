<?php
// Set correct content type for RSS feed
header('Content-Type: application/rss+xml; charset=' . get_option('blog_charset'));
echo '<?xml version="1.0" encoding="' . get_option('blog_charset') . '"?>';
?>
<rss version="2.0"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:wfw="http://wellformedweb.org/CommentAPI/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
>
<channel>
    <title><?php wp_title_rss(); ?></title>
    <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
    <link><?php bloginfo_rss('url'); ?></link>
    <description><?php bloginfo_rss('description'); ?></description>
    <lastBuildDate><?php echo get_feed_build_date('r'); ?></lastBuildDate>
    <language><?php bloginfo_rss('language'); ?></language>
    <sy:updatePeriod>hourly</sy:updatePeriod>
    <sy:updateFrequency>1</sy:updateFrequency>

    <?php
    // Custom query for events
    $query_args = [
        'post_type'      => 'tribe_events',
        'meta_key'       => '_EventStartDate',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_query'     => [
            [
                'key'     => '_EventStartDate',
                'value'   => current_time('Y-m-d H:i:s'),
                'compare' => '>=',
                'type'    => 'DATETIME',
            ],
        ],
        'posts_per_page' => 50, // Change as needed
    ];

    $events_query = new WP_Query($query_args);

    if ($events_query->have_posts()) :
        while ($events_query->have_posts()) :
            $events_query->the_post();

            // Get event start date
            $event_date = function_exists('tribe_get_start_date') ? tribe_get_start_date(null, true, 'D, d M Y H:i:s') : null;

            // Get featured image URL
            $featured_image = get_the_post_thumbnail_url(null, 'medium');
    ?>
    <item>
        <title><?php the_title_rss(); ?></title>
        <link><?php the_permalink_rss(); ?></link>
        <dc:creator><![CDATA[<?php the_author(); ?>]]></dc:creator>
        <pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
        <guid isPermaLink="false"><?php the_guid(); ?></guid>

        <?php if ($event_date) : ?>
        <eventDate><?php echo esc_html($event_date); ?></eventDate>
        <?php endif; ?>

        <description><![CDATA[
            <?php if ($featured_image) : ?>
                <div style="width:100%;"><img src="<?php echo esc_url($featured_image); ?>" width="300" height="300" /><br/></div>
            <?php endif; ?>
            <?php the_excerpt_rss(); ?>
        ]]></description>

        <content:encoded><![CDATA[
            <?php if ($featured_image) : ?>
                <div style="width:100%;"><img src="<?php echo esc_url($featured_image); ?>" width="300" height="300" /><br/></div>
            <?php endif; ?>
            <?php the_content(); ?>
        ]]></content:encoded>

        <?php if ($featured_image) : ?>
        <enclosure url="<?php echo esc_url($featured_image); ?>" length="12345" type="image/jpg" />
        <?php endif; ?>

        <?php do_action('rss2_item'); ?>
    </item>
    <?php
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
</channel>
</rss>