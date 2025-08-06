<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
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
	<div id="post-title">
		<picture>
			<source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16105248/plan-your-experience-hero-v3.png" media="(min-width: 775px)" />
			<source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16105248/plan-your-experience-hero-v3.png"/>
			<img src="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16105248/plan-your-experience-hero-v3.png" alt="Bold text announcing Visitor Information in neon-style lettering."/>
		</picture>
	</div>
	<div class="post-thumbnail">	
		<picture>
			<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/17160517/plan-your-experience-hero-8.jpg" media="(min-width: 2100px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26145049/plan-your-experience-2100x369-1.jpg" media="(min-width: 1701px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26150623/plan-your-experience-576x192-1.jpg" media="(max-width: 576px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26150632/plan-your-experience-768x256-1.jpg" media="(max-width: 768px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26145544/plan-your-experience-1100x300-2.jpg" media="(max-width: 1100px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26145042/plan-your-experience-1700x387-1.jpg" media="(max-width: 1700px)" />

	<img src="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26145544/plan-your-experience-1100x300-2.jpg" alt="Visitor Information banner featuring a live band performing on stage with bright lights."/>
		</picture>
	</div>
	<div class="brdr"></div>
</div>

<div class="container">
	<div class="row" style="border-bottom:2px solid #e7e7e7;">
		<div class="col-xs-12 py-5 text-center">
			<h1 class="text-center nf-h1"><?php echo __('404 - Page not found', 'wp_babobski'); ?></h1>
			<p>Sorry, the page you are looking for could not be found. It might have been moved or deleted.</p> <p>Here are some useful links to help you find what you need:</p>
			<ul class="list-unstyled pb-4">
				<li><a href="/">Home</a></li>
				<li><a href="/events">Events</a></li>
				<li><a href="/guest-services">Guest Services</a></li>
				<li><a href="/plan-your-visit">Plan Your Visit</a></li>
			</ul>
			<p>If you need further assistance, feel free to contact us using the link below.</p>
			<div class="evt-bu dark pt-3 pb-3 w-100">
                <a href="//www.burtoncummingstheatre.ca/venue/burton-cummings-theatre" class="m-auto">Contact Us</a>
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
