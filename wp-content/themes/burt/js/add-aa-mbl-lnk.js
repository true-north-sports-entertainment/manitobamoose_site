document.addEventListener("DOMContentLoaded", function () {
    function addTopLevelLink() {
        if (window.innerWidth > 991) return; // Apply only if below 991px

        let menu = document.querySelector("#menu-top-menu");
        if (!menu) return;

        // Avoid duplicate links
        if (!menu.querySelector(".custom-top-menu-item")) {
            let newItem = document.createElement("li");
            newItem.className = "menu-item custom-top-menu-item nav-item";

            let newLink = document.createElement("a");
            newLink.className = "nav-link";
            newLink.href = "https://www.canadalifecentre.ca/join-all-access/"; // Change to the desired link
            newLink.target = "_blank";
            newLink.textContent = "Join All Access"; // Change to the desired text

            newItem.appendChild(newLink);
            menu.appendChild(newItem); // Append as the last item
        }
    }

    addTopLevelLink(); // Run on page load

    // Listen for window resize and only run when crossing the 991px threshold
    let resized = false;
    window.addEventListener("resize", function () {
        if (!resized) {
            resized = true;
            setTimeout(function () {
                addTopLevelLink();
                resized = false;
            }, 200); // Debounce to prevent excessive execution
        }
    });
});