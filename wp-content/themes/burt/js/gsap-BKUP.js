document.addEventListener('DOMContentLoaded', function () {
    initSideImgScroll();
});

// Function to handle .side-img scroll behavior
function initSideImgScroll() {
    const sideImg = document.querySelector('.left-cont div');
    const contentColumn = document.querySelector('.left-cont');
    let startTop = sideImg.getBoundingClientRect().top + window.scrollY;

    function getContentColumnWidth() {
        const parentComputedStyle = getComputedStyle(contentColumn);
        const parentPaddingLeft = parseFloat(parentComputedStyle.paddingLeft);
        const parentPaddingRight = parseFloat(parentComputedStyle.paddingRight);
        return contentColumn.offsetWidth - parentPaddingLeft - parentPaddingRight;
    }

    let sideImgWidth = getContentColumnWidth(); // Get the initial width of the parent column minus padding

    function updatePositions() {
        const scrollY = window.scrollY;
        const contentRect = contentColumn.getBoundingClientRect();
        const contentBottom = contentRect.bottom + window.scrollY;
        const buffer = 10; // Small buffer to prevent flickering

        if (scrollY >= startTop && scrollY < contentBottom - sideImg.offsetHeight - buffer) {
            sideImg.style.position = 'fixed';
            sideImg.style.top = '0';
            sideImg.style.width = `${sideImgWidth}px`; // Ensure the width stays within the parent
            // sideImg.style.left = `${contentRect.left}px`; // Align with parent column
        } else if (scrollY >= contentBottom - sideImg.offsetHeight - buffer) {
             sideImg.style.position = 'absolute';
            sideImg.style.top = (contentBottom - sideImg.offsetHeight - startTop) + 'px';
            sideImg.style.width = ''; // Reset width
            sideImg.style.left = ''; // Reset left
        } else {
            sideImg.style.position = '';
            sideImg.style.top = '';
            sideImg.style.width = ''; // Reset width
            sideImg.style.left = ''; // Reset left
        }
    }

    function handleResize() {
        // Recalculate the startTop position and width of the parent column
        startTop = sideImg.getBoundingClientRect().top + window.scrollY;
        sideImgWidth = getContentColumnWidth(); // Update the width on resize
        updatePositions();
    }

    // Add event listeners
    window.addEventListener('scroll', updatePositions);
    window.addEventListener('resize', handleResize);

    // Initial call to set positions correctly
    updatePositions();

    const messages = [
        "<h1>An exciting <i>new era</i> of entertainment growth in <strong>Winnipeg, Manitoba</strong>.</h1><p>True North Sports + Entertainment proudly acknowledge our role in the many relationships that make up our home and commit to a spirit of reconciliation for the future.</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>",
        "<h1>It was popularised in the 1960s with the release of <i>Letraset sheets</i> containing Lorem Ipsum passages, and more recently with desktop publishing.</h1><p>Originally known as the Walker Theatre, the Burton Cummings Theatre (‘The Burt’) was constructed in 1906. The Theatre was built for a new style of professional-level entertainment and brought ballets, operas, and Broadway-style shows to Winnipeg. It was then converted into the Odeon Cinema in 1945 and served as the city’s most popular single-screen movie theatre for almost 50 years. Original Odeon logos and artwork are still visible on the outside of the building.</p>",
        "<h1>It has survived not only <i>five centuries</i>, but also the leap into electronic typesetting, remaining essentially unchanged.</h1><p>In 1990, the theatre was purchased by the not-for-profit Walker Theatre Performing Arts Group (WTPAG) and designated a National Historic Site of Canada as well as a Provincial Heritage Site. The building’s original architectural features were restored and it reopened as a venue for live performance in March 1991. In 2002, it was renamed after Winnipeg-born musician Burton Cummings, former lead singer of the Guess Who.</p>",
        "<h1>Lorem Ipsum is simply dummy text of the printing and <i>typesetting</i> industry.</h1><p>In 2014, under a lease arrangement from the WPTAG, True North Sports + Entertainment assumed management of the Burton Cummings Theatre, providing programming services and entertainment expertise to the 1579-seat former vaudeville theatre. Investing significant time and resources, True North set forth on a long-term project to refurbish and rejuvenate the theatre, acquiring full ownership of the building from the WPTAG in 2016.</p>"
    ];

    const sideImages = document.querySelectorAll('.side-img > div');
    const contentParagraph = document.querySelector('.left-cont div');

    // Intersection Observer setup
    const observerOptions = {
        threshold: Array.from({ length: 101 }, (_, i) => i / 100), // Creates thresholds from 0 to 1 with steps of 0.01
    };

    let currentVisibleDiv = null;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            const div = entry.target;
            const visibility = entry.intersectionRatio; // The percentage of the div that is visible

            if (visibility > 0.6) {
                if (currentVisibleDiv && currentVisibleDiv !== div) {
                    currentVisibleDiv.style.opacity = 0.2; // Reset the previously visible div's opacity
                }
                div.style.opacity = 1;
                currentVisibleDiv = div; // Update the currently visible div
                const index = Array.from(sideImages).indexOf(div);
                contentParagraph.innerHTML = messages[index]; // Update message based on the visible div
            } else if (currentVisibleDiv === div && visibility <= 0.6) {
                div.style.opacity = 0.2; // Fade out the current div when it goes below 60% visibility
                currentVisibleDiv = null; // Reset the current visible div
            }
        });
    }, observerOptions);

    sideImages.forEach((div) => {
        observer.observe(div); // Observe each div
    });
    
}

