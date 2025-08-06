document.addEventListener("DOMContentLoaded", function() {
    const postThumbnail = document.querySelector(".post-thumbnail img");
    const postTitle = document.querySelector("#post-title img");

    // Only load the post-title image after the post-thumbnail has loaded
    if (postThumbnail && postTitle) {
        postThumbnail.onload = function() {
            postTitle.src = postTitle.dataset.src;
        };

        // If post-thumbnail fails to load for any reason, still load post-title image
        //postThumbnail.onerror = function() {
            //postTitle.src = postTitle.dataset.src;
        //};
    }
});
