document.addEventListener('DOMContentLoaded', function () {
    if (document.body.classList.contains('wp-dark-mode-active')) {
        let editorIframe = document.querySelector('iframe#content_ifr'); // Adjust if necessary for your editor ID
        if (editorIframe) {
            let editorDoc = editorIframe.contentDocument || editorIframe.contentWindow.document;
            let styleElement = editorDoc.createElement('style');
            styleElement.textContent = `
                body {
                    background-color: #181a1b !important;
                    color: #e0e0e0 !important;
                }
                .mce-content-body {
                    background-color: #181a1b !important;
                    color: #e0e0e0 !important;
                }
            `;
            editorDoc.head.appendChild(styleElement);
        }
    }
});
