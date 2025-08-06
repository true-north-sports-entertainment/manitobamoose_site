jQuery(document).ready(function ($) {
    // Additional code to hide the Organizers and Event Cost meta boxes on tribe_events pages
    if (typeof pagenow !== 'undefined' && pagenow === 'tribe_events') {
        // Hide Organizers meta box
        $('#event_tribe_organizer').hide();

        // Hide Event Cost meta box
        $('#event_cost').hide();

        // Directly target the specific table and h4 element
        $('#event_url').find('h4').each(function () {
            var $this = $(this);
            if ($this.text().includes('Event Website')) {
                $this.text($this.text().replace('Event Website', 'Ticketmaster URL'));
            }
        });
    }
});
