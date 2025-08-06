<?php
/* 
Template Name: Venue Template Page
*/
get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content-venue', 'page' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
        
    <div class="parallax-container">
        <div class="para bg" data-speed="0.1"></div>
        <div class="para backrow" data-speed="0.15"></div>
        <div class="para frontrow" data-speed="0.22"></div>
        <div class="para crowd" data-speed="0.38"></div>
    </div>
    <div id="quote">
        <p class="para" data-speed="0.55">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.<br /><span>- Milky Chance 2022</span></p>
    </div>
    <div id="attractions">
        <div class="attraction">
            <img src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/03/19133341/ministry-280x400-1.jpg" alt="" />
        </div>
        <div class="attraction">
            <img src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/03/19133341/ministry-280x400-1.jpg" alt="" />
        </div>
        <div class="attraction">
            <img src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/03/19133341/ministry-280x400-1.jpg" alt="" />
        </div>
      
    </div>

   
<?php
get_footer();
