function enqueue_parallax_script() {
    if (is_page('the-venue')) {
        wp_enqueue_script(
            'parallax-effect',
            '/js/parallax.js',
            array(),
            null,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_parallax_script');