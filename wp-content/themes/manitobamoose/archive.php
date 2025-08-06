<?php
/**
 * The template for displaying Archive pages.
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

		<?php if ( is_day() ) : ?>
			<h1><?php _e('Archive:', 'manitobamoose'); ?> <?php echo get_the_date( 'F j, Y' ); ?></h1>
		<?php elseif ( is_month() ) : ?>
			<h1><?php _e('Archive:', 'manitobamoose'); ?> <?php echo get_the_date( 'F Y' ); ?></h1>
		<?php elseif ( is_year() ) : ?>
			<h1><?php _e('Archive:', 'manitobamoose'); ?> <?php echo get_the_date( 'Y' ); ?></h1>
		<?php else : ?>
			<h1><?php _e('Archive', 'manitobamoose'); ?></h1>
		<?php endif; ?>

		<ul class="list-unstyled">
			<?php while ( have_posts() ) : the_post(); ?>
				<li class="mb-4">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<time datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'F j, Y g:i a' ); ?></time>
					<?php the_excerpt(); ?>
				</li>
			<?php endwhile; ?>
		</ul>

	<?php else: ?>
		<h2><?php _e('No posts to display', 'manitobamoose'); ?></h2>
	<?php endif; ?>
</div>

<?php 
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>