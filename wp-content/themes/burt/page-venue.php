<?php
/**
 * Template Name: Venue Template Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/bootsrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 5.3.2
 * @autor 		Babobski
 */
$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/html-header', 
	'parts/shared/header'
]);
?>
<div id="post-header-cnt">
        <div id="post-title" class="fade-in-transform">
            <picture>
            <source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16102856/about-the-burt-hero.png" media="(min-width: 775px)" />
            <source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16102856/about-the-burt-hero.png"/>
            <img src="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16102856/about-the-burt-hero.png" alt="The Venue title outlined in a green glow similar to a neon street sign"/>
            </picture>
        </div>
	    <div class="post-thumbnail">	
            <picture>
                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16165443/about-the-burt-hero-16.jpg" media="(min-width: 2100px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26161013/about-2100x369-1.jpg" media="(min-width: 1701px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26162513/about-576x19-2.jpg" media="(max-width: 576px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26162248/about-768x256-2.jpg" media="(max-width: 768px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26161636/about-1100x300-3.jpg" media="(max-width: 1100px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26161444/about-1700x387-2.jpg" media="(max-width: 1700px)" />

                <img src="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26161636/about-1100x300-3.jpg" alt="A band on stage performing with green and purple lights behind them and a crowd in front of the stage"/>
            </picture>
	    </div>
		<div class="brdr"></div>
    </div>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 p-4 p-sm-5 pt-lg-5 left-cont">
			<div class="left-cont pe-lg-5 py-lg-2">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<h1 class="fade-in-transform">An exciting <i>new era</i> of entertainment growth in <strong>Winnipeg, Manitoba</strong>.</h1>
					<div class="fade-in-transform"><?php the_content(); ?></div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 side-img p-4 pb-5 pt-0 pt-lg-5 pb-sm-5 px-sm-5 ps-lg-0 my-lg-3 fade-in-transform">
			<div style="background-image:url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
			<?php endwhile; ?>
		</div>
	</div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="parallax d-flex justify-content-center align-items-center position-relative"
            style="background-image: url('//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/11/20124900/milky-chance-bct.jpg'); background-position: center center; background-size: cover;">
            <!-- Overlay -->
            <div class="overlay position-absolute w-100 h-100" style="background-color: rgba(0, 0, 0, 0.1);"></div>
        </div>
    </div>
</div>

<!--<div class="container-fluid">
    <div class="row">
        <div class="parallax d-flex justify-content-center align-items-center position-relative" style="background-image: url('//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/11/20124900/milky-chance-bct.jpg'); background-position: bottom center;">
--><!-- Overlay -->
            <!--<div class="overlay position-absolute w-100 h-100" style="background-color: rgba(0, 0, 0, 0);"></div>
        </div>
    </div>
</div>-->

<!--<div class="parallax-container">
	<div class="para bg" data-speed="0.1"></div>
  <div class="para backrow" data-speed="0.2"></div>
  <div class="para frontrow" data-speed="0.3"></div>
	<div class="para crowd" data-speed="0.4"></div>
</div>-->

<div class="container-fluid gallery-cont">
	<div class="row">
		<div class="col-12">

		</div>
	</div>
	<!--<div class="row" style="background-color:#060607;">
		<div class="col-12 px-4 px-sm-5 py-lg-5">
			<div class="py-3" style="max-width:1350px;margin:auto;">
				<div style="color:#ffffff;text-align:center;"><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p></div>


			</div>
			
		</div>
	</div>-->

    <!--<div class="row">
        <div class="parallax d-flex justify-content-center align-items-center position-relative" style="background-image: url('//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/12/10100606/machine-head-girl-headphones-v2.jpg'); background-position: bottom center;">
            Overlay -->
            <!--<div class="overlay position-absolute w-100 h-100" style="background-color: rgba(0, 0, 0, 0);"></div>
             Quote Content -->
            <!--<div id="quote" class="text-center position-relative p-5 p-md-5">
                <h1>It's a place where we <span class="green">celebrate music and community</span>, and it means the world to me to be part of that story.</h1>
				<p>- &nbsp; Burton Cummings</p>
            </div>-->
        <!--</div>
    </div>->

	<div class="row">
		<div class="col-12 px-4 px-sm-5 py-lg-5">
			<div class="py-3" style="max-width:1350px;margin:auto;">
				<div style="min-height:900px;"></div>
			</div>
		</div>
	</div>-->

	<div class="row" style="background-color:#060607;">
		<div class="col-12 px-4 px-sm-5 py-lg-5">
			<div class="gallery-wrapper py-5" style="max-width:1350px;margin:auto;">
				<div class="gallery">
					<a href="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19120520/exterior-burt-block-party.jpg" data-lightbox="gallery" data-title="The Burton Cummings Theatre at night, beautifully reflected in a puddle, showcasing its iconic neon sign and marquee lights."><img class="fade-in-transform" src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19120513/exterior-burt-block-party-232h.jpg" alt="Exterior night view of the Burton Cummings Theatre with its neon sign reflecting in a puddle on the street. The marquee lights and string lights add warmth to the scene, while the event signage advertises upcoming performances." loading="lazy"></a>
					<a href="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19111727/kip-moore-800h.jpg" data-lightbox="gallery" data-title="Live concert at the historic Burton Cummings Theatre, offering a stunning view from the balcony, Kip Moore concert."><img class="fade-in-transform" src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19114054/kip-moore-232h.jpg" alt="View from the upper seats at the Burton Cummings Theatre, looking down at a concert stage with warm, glowing lights. The audience is seated, watching the band perform, while the theatre's elegant, curved balconies frame the scene." loading="lazy"></a>
					<a href="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19114653/royal-blood-crowd-jpg.jpg" data-lightbox="gallery" data-title="Royal Blood concert"><img class="fade-in-transform" src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19114648/royal-blood-crowd-232h.jpg" alt="Audience seated at the Burton Cummings Theatre, watching a live performance with warm, atmospheric lighting illuminating the stage and the theatre’s iconic arched ceiling and balconies. The artist performs to a captivated crowd in the historic venue." loading="lazy"></a>
					<a href="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19112723/trivium-800h.jpg" data-lightbox="gallery" data-title="Trivium"><img class="fade-in-transform" src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19113519/trivium-232h.jpg" alt="Excited crowd at the Burton Cummings Theatre watching a live performance, with blue stage lights illuminating both the band and the ornate architecture of the venue. Audience members are raising their hands and capturing the moment on their phones." loading="lazy"></a>
					<a href="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19115411/burt-block-party-crowd.jpg" data-lightbox="gallery" data-title="Burt Block Party concert inside the Burton Cummings Theatre"><img class="fade-in-transform" src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19115405/burt-block-party-crowd-232h.jpg" alt="Overhead view of a crowd gathered at the Burton Cummings Theatre for a live concert, with the band performing on a stage illuminated by blue and white spotlights. The theatre’s detailed balconies frame the scene, adding to the intimate concert atmosphere." loading="lazy"></a>
					<a href="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19115919/our-lady-peace-668h.jpg" data-lightbox="gallery" data-title="Our Lady Peace concert"><img class="fade-in-transform" src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19115917/our-lady-peace-232h.jpg" alt="Live performance at the Burton Cummings Theatre, with the stage bathed in vibrant red lighting and vertical light bars creating a dramatic backdrop. The silhouettes of the band are visible as they perform to a packed crowd, with the theatre's ornate architecture surrounding the scene." loading="lazy"></a>
					<a href="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19121231/july-talk-800h.jpg" data-lightbox="gallery" data-title="July Talk conert"><img class="fade-in-transform" src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19121224/july-talk-232h.jpg" alt="Black-and-white view from behind a drum kit on stage at the Burton Cummings Theatre, showing a performer under bright stage lights with the audience filling the balcony and floor seats. The grand architecture of the venue is subtly visible in the background." loading="lazy"></a>
					<a href="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19121933/royal-blood-800h.jpg" data-lightbox="gallery" data-title="Royal Blood concert"><img class="fade-in-transform" src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19121926/royal-blood-232h.jpg" alt="Packed audience at the Burton Cummings Theatre, with fans in both the balcony and main floor sections cheering and raising their hands during a live concert. The venue's grand architecture is illuminated by soft lighting, highlighting the arched ceiling and intricate balcony details, creating an electric atmosphere." loading="lazy"></a>
					<a href="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19123215/shakey-graves-800h.jpg" data-lightbox="gallery" data-title="Shakey Graves concert"><img class="fade-in-transform" src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19123208/shakey-graves-232h.jpg" alt="Wide-angle view of the interior of the historic Burton Cummings Theatre, filled with a seated audience watching a live performance. The ornate architecture, with its arched ceiling and detailed balconies, frames the stage, where beams of light cut through the atmosphere, creating a dramatic scene." loading="lazy"></a>
					<a href="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19123946/milky-chance-800h.jpg" data-lightbox="gallery" data-title="Milky Chance concert"><img class="fade-in-transform" src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/19123939/milky-chance-232h.jpg" alt="Concert stage with a band performing in front of a packed crowd, illuminated by green and white horizontal lights in the background, creating a vibrant atmosphere. The audience raises their hands, enjoying the live music in a dark, atmospheric venue." loading="lazy"></a>
       			</div>
			</div>
			
		</div>
	</div>
</div>
<?php 
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>
