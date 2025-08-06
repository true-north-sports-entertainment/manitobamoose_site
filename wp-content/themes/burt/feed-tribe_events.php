<?php
header('Content-Type: application/rss+xml; charset=' . get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="' . get_option('blog_charset') . '"?' . '>';
?>
<rss version="2.0">
    <channel>
        <title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
        <link><?php bloginfo_rss('url') ?></link>
        <description><?php bloginfo_rss("description") ?></description>
        <language><?php bloginfo_rss('language'); ?></language>

        <?php
        $events = tribe_get_events([
            'posts_per_page' => 10,  // Adjust as needed
            'start_date' => date('Y-m-d H:i:s')
        ]);

        foreach ($events as $event): setup_postdata($event);
        ?>
            <item>
                <title><?php echo esc_html($event->post_title); ?></title>
                <link><?php echo esc_url(get_permalink($event->ID)); ?></link>
                <description><![CDATA[<?php echo wp_trim_words($event->post_content, 30); ?>]]></description>
                <content:encoded><![CDATA[<?php echo apply_filters('the_content', $event->post_content); ?>]]></content:encoded>
                <pubDate><?php echo mysql2date('r', $event->post_date); ?></pubDate>
                <guid><?php echo esc_url(get_permalink($event->ID)); ?></guid>
            </item>
        <?php endforeach; wp_reset_postdata(); ?>
    </channel>
</rss>
