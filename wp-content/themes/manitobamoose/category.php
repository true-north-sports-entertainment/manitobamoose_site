<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package Manitoba Moose
 */

$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/html-header',
	'parts/shared/header'
]);
?>

<div class="container py-5">
	<?php if ( have_posts() ): ?>
		<h1 class="mb-4">
			<?php _e('Category:', 'manitobamoose'); ?> <?php echo single_cat_title( '', false ); ?>
		</h1>

		<ul class="list-unstyled">
			<?php while ( have_posts() ) : the_post(); ?>
			<li class="mb-4">
				<h2>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<time datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'F j, Y g:i a' ); ?></time>
				<?php the_excerpt(); ?>
			</li>
			<?php endwhile; ?>
		</ul>

	<?php else: ?>
		<h2><?php _e('No posts to display in', 'manitobamoose'); ?> <?php echo single_cat_title( '', false ); ?></h2>
	<?php endif; ?>
</div>

<?php 
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>