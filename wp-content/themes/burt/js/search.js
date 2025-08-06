jQuery(document).ready(function ($) {
    // Add event listener for the search icon to trigger the modal
    $('#searchIcon').on('click', function () {
        $('#searchModal').modal('show');
        $('.close-button').show(); // Show the close button when the modal is shown
    });

    $('#searchModal').on('shown.bs.modal', function () {
        $('.close-button').css('z-index', '1051').show(); // Ensure it is above the modal backdrop
    });

    $('#searchModal').on('hidden.bs.modal', function () {
        $('.close-button').hide();
    });

    $('.close-button').on('click', function () {
        $('#searchModal').modal('hide');
    });
});