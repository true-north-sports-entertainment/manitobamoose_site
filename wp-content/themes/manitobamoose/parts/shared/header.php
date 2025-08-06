<div class="container-fluid newsbar py-2">    
    <div class="container wrapper">
        <div class="row">
            <div id="clc-link" class="col-xs-12 col-sm-12 col-md-4 col-lg-3 px-4">
                <a href="https://www.canadalifecentre.ca" target="_blank" class="d-flex"><img src="/wp-content/themes/manitobamoose/images/clc-hdr.svg" alt="Logo wordmark" style="height:22px !important;"></a>
            </div>
            <div class="news-txt col-xs-12 col-sm-12 col-md-12 col-lg-6 px-0">
                <?php
                    if (function_exists('display_newsbar')) {
                        display_newsbar();
                    }
                ?>
            </div>
            <div class="social d-flex col-xs-12 col-sm-12 col-md-12 col-lg-3 justify-content-end px-4 gap-3">
                <a href="https://facebook.com/TheBurtWPG" class="d-flex" target="_blank"><img src="/wp-content/themes/manitobamoose/images/fb_logo.svg" alt="Facebook logo" style="height:22px !important;margin-top:0.75px;"></a>
                <a href="https://x.com/theburtwpg" class="d-flex" target="_blank"><img src="/wp-content/themes/manitobamoose/images/x_logo.svg" alt="X formerly known as Twitter logo " style="height:21px !important;margin-top:1.5px;"></a>
                <a href="https://instagram.com/theburtwpg" class="d-flex" target="_blank"><img src="/wp-content/themes/manitobamoose/images/insta_logo.svg" alt="Instagram logo" style="height:22px !important;margin-top:1.25px;"></a>
                <!--<a href="#" class="d-flex" target="_blank"><img src="/wp-content/themes/manitobamoose/images/youtube_logo.svg" alt="Youtube" style="height:22px !important;"></a>-->
                <a href="https://canadalifecentre.ca/join-all-access" class="d-flex" target="_blank"><img src="/wp-content/themes/manitobamoose/images/mail_icon.svg" alt="Envelope icon for Email Us" style="height:22px !important;margin-top:1px;"></a>
            </div>
        </div>
    </div>
</div>
<?php if (is_front_page()) { echo '<div class="landing-wrapper">'; } ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light position-relative py-3 py-sm-3 px-4 px-sm-5">
        <div class="container-fluid p-0">
                <a class="navbar-brand d-none d-lg-inline-flex" href="<?php echo get_site_url(); ?>/">
                    <picture>
                        <source srcset="<?php bloginfo('url');?>/wp-content/themes/manitobamoose/images/bct-hz-logo.svg" media="(min-width: 1500px)" />
                        <source srcset="<?php bloginfo('url');?>/wp-content/themes/manitobamoose/images/bct-frame-logo.svg" media="(min-width: 992px)" />
                        <source srcset="<?php bloginfo('url');?>/wp-content/themes/manitobamoose/images/bct-hz-logo.svg" media="(min-width: 750px)" />
                        <source srcset="<?php bloginfo('url');?>/wp-content/themes/manitobamoose/images/bct-frame-logo.svg"/>
                        <img src="<?php bloginfo('url');?>/wp-content/themes/manitobamoose/images/bct-frame-logo.svg" alt="Logo of the Burton Cummings Theatre featuring bold blue text on a white background, with a greem decorative design above the name."/>
                    </picture>   
                    <div id="snce"><img src="<?php bloginfo('url');?>/wp-content/themes/manitobamoose/images/laurel-comm.svg" alt=""/></div>            
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="primaryNav">
                    <?php
                    wp_nav_menu( [
                        'menu'              => 'Top Menu',
                        'theme_location'    => 'primary',
                        'depth'             => 2,
                        'container'         => false,
                        'menu_class'        => 'navbar-nav mt-4 mt-lg-0 mx-auto',
                        'fallback_cb'       => '__return_false',
                        'walker'            => new bootstrap_5_wp_nav_menu_walker()
                    ] );
                    ?>
                </div>
                <div class="d-none d-lg-block">
                    <?php get_search_form(); ?>
                </div>
                <div id="options-rgt">
                    <div id="search-box">
                        <!-- Search Button -->
                        <img id="searchIcon" src="<?php bloginfo('url'); ?>/wp-content/themes/manitobamoose/images/search-icon.svg" alt="Magnifying glass icon for Search">

                        <!-- Close Button -->
                        <button type="button" class="close-button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header pt-0 pb-0"> 
                                    <h1 class="mb-0"><span>Website</span>Name.ca</h1>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                                    <div class="form-group d-md-flex">
                                        <input type="text" class="form-control mb-4 mb-md-0" name="s" id="searchInput" placeholder="Search...">
                                        <button type="submit" class="btn btn-primary ml-2">Search</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="calendar-bu" class="ms-1 ps-1">
                        <a href="/events/month"><img src="<?php bloginfo('url')?>/wp-content/themes/manitobamoose/images/cal-icon.svg" alt="Calendar icon for Upcoming Events in Month view"></a>
                    </div>
                    <div id="join-bu" class="ms-4 brn-bu">
                        <a href="https://www.canadalifecentre.ca/join-all-access/" target="_blank">JOIN ALL ACCESS</a>
                    </div>
                </div>
        </div>
    </nav>