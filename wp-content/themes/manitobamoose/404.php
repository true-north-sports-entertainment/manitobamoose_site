<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Manitoba Moose
 */

$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/html-header',
	'parts/shared/header'
]);
?>

<div class="container py-5 text-center">
	<h1 class="display-4">404 - Page Not Found</h1>
	<p class="lead">Sorry, the page you’re looking for doesn’t exist.</p>
	<p>Here are some helpful links instead:</p>
	<ul class="list-unstyled mb-4">
		<li><a href="/">Home</a></li>
		<li><a href="/schedule">Game Schedule</a></li>
		<li><a href="/tickets">Tickets</a></li>
		<li><a href="/contact">Contact</a></li>
	</ul>
	<a class="btn btn-primary" href="/">Return to Homepage</a>
</div>

<?php
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>