<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>
        <?php wp_title( '|', true, 'right' ); ?> <?php bloginfo( 'name' ); ?>
    </title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico"/>
		<?php wp_head(); ?>
       <!-- ADOBE FONTS -->
       <link rel="stylesheet" href="https://use.typekit.net/dna3kvk.css">
    <!-- Font Awesome -->
    <!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PP5FWSR');</script>
    <!-- End Google Tag Manager -->
  </head>
<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PP5FWSR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php if (is_front_page()) : ?>
    <style>
        .upcoming{
          background-color:#ffffff !important
        }

        @media only screen and (min-width:768px){
          .tribe-events-c-events-bar__search-button, .tribe-common-c-btn__clear, .tribe-common--breakpoint-medium.tribe-events .tribe-events-c-view-selector--labels .tribe-events-c-view-selector__list-item-icon, .tribe-common--breakpoint-medium.tribe-events .tribe-events-c-view-selector--tabs .tribe-events-c-view-selector__button, .tribe-events .tribe-events-c-events-bar__filter-button-icon{
            display:none !important;
            visibility:hidden !important
          }
        }

        @media only screen and (min-width: 992px) {
            .tribe-events-pro-photo .tribe-common-g-col {
                flex: 1 1 33.333%; /* Forces a 3-column layout */
                max-width: 33.333%; /* Ensures columns stay in place before main CSS loads */
            }

            .tribe-events-pro-photo .tribe-common .tribe-common-l-container {
                --tec-grid-width: 1446px;
                --tec-grid-gutter-page: 48px;
                padding-left: 3rem !important;
                padding-right: 3rem !important;
            }
        }

        @media only screen and (min-width:768px) and (max-width: 991px) {
            .tribe-events-pro-photo .tribe-common-g-col {
              flex: 1 1 50%; /* Forces a 3-column layout */
              max-width: 50%; /* Ensures columns stay in place before main CSS loads */
            }

            .tribe-events-pro-photo .tribe-common .tribe-common-l-container{
              padding-left: 3rem !important;
              padding-right: 3rem !important
            }
        }

        #primary-evt .evt-date, #primary-evt .evt-subtitle {
          font-size: 22px !important
        }

        #secondary-evts .evt-date {
          font-size: 20px !important
        }

        @media only screen and (max-width:767px) {
          .tribe-events-pro-photo .tribe-common .tribe-common-l-container{
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important
          }

          #secondary-evts .evt-date {
            font-size: 22px !important
          }
        }

    </style>
<?php endif; ?>
<?php if (is_page('visitor-information')) : ?>
   <!-- Preload for current viewport only -->
    <link rel="preload" href="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/26173939/plan-your-visit-hdr-2560x400-1.jpg" as="image" media="(min-width: 2100px)">
    <link rel="preload" href="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23141657/visitor-info-hdr-2100.jpg" as="image" media="(min-width: 1701px)">
    <link rel="preload" href="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23143300/visitor-info-hdr-576-v2.jpg" as="image" media="(max-width: 576px)">
    <link rel="preload" href="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23142851/visitor-info-hdr-768-v2.jpg" as="image" media="(max-width: 768px)">
    <link rel="preload" href="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23143041/visitor-info-hdr-1100-v3.jpg" as="image" media="(max-width: 1100px)">
    <link rel="preload" href="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23142422/visitor-info-hdr-1700-v3.jpg" as="image" media="(max-width: 1700px)">
  <?php endif; ?>

