document.addEventListener("DOMContentLoaded", function () {
    const fadeInElements = document.querySelectorAll(".fade-in, .fade-in-transform");

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;

                // Lazy load images or iframes
                if (target.dataset.src) {
                    target.src = target.dataset.src;
                    target.addEventListener("load", () => {
                        target.classList.add("visible"); // Fade-in after load
                    });
                    target.removeAttribute("data-src");
                } else if (target.dataset.content) {
                    // Lazy load text or other content
                    target.textContent = target.dataset.content;
                    target.classList.add("visible");
                    target.removeAttribute("data-content");
                } else {
                    // No lazy-load, just fade in
                    target.classList.add("visible");
                }

                // Stop observing the element
                observer.unobserve(target);
            }
        });
    }, {
        threshold: 0.1
    });

    fadeInElements.forEach(element => observer.observe(element));
});