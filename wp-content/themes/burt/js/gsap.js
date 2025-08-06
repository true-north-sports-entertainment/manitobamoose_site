document.addEventListener('DOMContentLoaded', function () {
    initSideImgScroll();
});

function initSideImgScroll() {
    const sideImg = document.querySelector('.left-cont div');
    const contentColumn = document.querySelector('.left-cont');
    let startTop = getOffsetTop(sideImg);
    let sideImgWidth = getContentColumnWidth();

    function getOffsetTop(element) {
        return element.getBoundingClientRect().top + window.scrollY;
    }

    function getContentColumnWidth() {
        const computedStyle = window.getComputedStyle(contentColumn);
        return contentColumn.clientWidth - parseFloat(computedStyle.paddingLeft) - parseFloat(computedStyle.paddingRight);
    }

    function updatePositions() {
        const scrollY = window.scrollY;
        const contentRect = contentColumn.getBoundingClientRect();
        const contentBottom = contentRect.bottom + scrollY;
        const buffer = 10;

        if (scrollY >= startTop && scrollY < contentBottom - sideImg.offsetHeight - buffer) {
            sideImg.style.position = 'fixed';
            sideImg.style.top = '0';
            sideImg.style.width = `${sideImgWidth}px`;
        } else if (scrollY >= contentBottom - sideImg.offsetHeight - buffer) {
            sideImg.style.position = 'relative';
            sideImg.style.top = `${contentBottom - sideImg.offsetHeight - startTop}px`;
            sideImg.style.width = '';
        } else {
            sideImg.style.position = '';
            sideImg.style.top = '';
            sideImg.style.width = '';
        }
    }

    function handleResize() {
        startTop = getOffsetTop(sideImg);
        sideImgWidth = getContentColumnWidth();
        updatePositions();
    }

    window.addEventListener('scroll', updatePositions, { passive: true });
    window.addEventListener('resize', handleResize);

    updatePositions();

    const messages = [
        "<h1>An exciting <i>new era</i> of entertainment growth in <strong>Winnipeg, Manitoba</strong>.</h1><p>True North Sports + Entertainment proudly acknowledge our role in the many relationships that make up our home and commit to a spirit of reconciliation for the future.</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>",
        "<h1>It was popularised in the 1960s with the release of <i>Letraset sheets</i> containing Lorem Ipsum passages, and more recently with desktop publishing.</h1><p>Originally known as the Walker Theatre, the Burton Cummings Theatre ('The Burt') was constructed in 1906. The Theatre was built for a new style of professional-level entertainment and brought ballets, operas, and Broadway-style shows to Winnipeg. It was then converted into the Odeon Cinema in 1945 and served as the city's most popular single-screen movie theatre for almost 50 years. Original Odeon logos and artwork are still visible on the outside of the building.</p>",
        "<h1>It has survived not only <i>five centuries</i>, but also the leap into electronic typesetting, remaining essentially unchanged.</h1><p>In 1990, the theatre was purchased by the not-for-profit Walker Theatre Performing Arts Group (WTPAG) and designated a National Historic Site of Canada as well as a Provincial Heritage Site. The building's original architectural features were restored and it reopened as a venue for live performance in March 1991. In 2002, it was renamed after Winnipeg-born musician Burton Cummings, former lead singer of the Guess Who.</p>",
        "<h1>Lorem Ipsum is simply dummy text of the printing and <i>typesetting</i> industry.</h1><p>In 2014, under a lease arrangement from the WPTAG, True North Sports + Entertainment assumed management of the Burton Cummings Theatre, providing programming services and entertainment expertise to the 1579-seat former vaudeville theatre. Investing significant time and resources, True North set forth on a long-term project to refurbish and rejuvenate the theatre, acquiring full ownership of the building from the WPTAG in 2016.</p>"
    ];

    const sideImages = document.querySelectorAll('.side-img > div');
    const contentParagraph = document.querySelector('.left-cont div');

    const observerOptions = {
        threshold: 0.7 // Trigger when 70% of the div is in view
    };

    let currentVisibleDiv = null;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            const div = entry.target;

            if (entry.isIntersecting) {
                // Set opacity to 1 for the currently visible div
                if (currentVisibleDiv) {
                    currentVisibleDiv.style.opacity = '0.2'; // Set the previous div's opacity to 0.2
                }
                div.style.opacity = '1';
                currentVisibleDiv = div;

                const index = Array.from(sideImages).indexOf(div);
                contentParagraph.innerHTML = messages[index];
            }
        });
    }, observerOptions);

    // Set initial opacity for all divs to 0.2
    sideImages.forEach((div) => {
        div.style.opacity = '0.2';
        observer.observe(div);
    });
}
