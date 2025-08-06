document.addEventListener('DOMContentLoaded', function () {
  console.log("DOM fully loaded and parsed"); // Confirm script is running

  // Lightbox custom event dispatch
  lightbox.option({
    'onOpen': function () {
      console.log("Lightbox opened"); // Debugging message
      document.body.classList.add('body-no-scroll');

      // Trigger custom event for debugging
      let event = new Event('lightbox_open');
      document.dispatchEvent(event);
    },
    'onClose': function () {
      console.log("Lightbox closed"); // Debugging message
      document.body.classList.remove('body-no-scroll');

      // Trigger custom event for debugging
      let event = new Event('lightbox_close');
      document.dispatchEvent(event);
    }
  });
});
