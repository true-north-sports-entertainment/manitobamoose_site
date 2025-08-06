<?php
/**
 * Template for displaying Author Archive pages
 */
$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/html-header',
	'parts/shared/header'
]);
?>

<div class="container py-5">
	<?php if ( have_posts() ): the_post(); ?>

		<h1><?php _e('Author Archives:', 'manitobamoose'); ?> <?php the_author(); ?></h1>

		<?php if ( get_the_author_meta( 'description' ) ) : ?>
			<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
			<h2><?php _e('About', 'manitobamoose'); ?> <?php the_author(); ?></h2>
			<p><?php the_author_meta( 'description' ); ?></p>
		<?php endif; ?>

		<ul class="list-unstyled">
			<?php rewind_posts(); while ( have_posts() ) : the_post(); ?>
			<li class="media mb-4">
				<div class="media-body">
					<h2 class="h5">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time(); ?></time>
					<?php the_excerpt(); ?>
				</div>
			</li>
			<?php endwhile; ?>
		</ul>

	<?php else: ?>
		<h1><?php _e('No posts to display for', 'manitobamoose'); ?> <?php the_author(); ?></h1>
	<?php endif; ?>
</div>

<?php 
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>