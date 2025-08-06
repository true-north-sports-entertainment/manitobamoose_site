<?php
/**
 * Main template file
 *
 * Used when no specific template matches a query.
 * Typically renders the blog or homepage fallback.
 *
 * See /external/bootstrap-utilities.php for details on BsWp::get_template_parts().
 *
 * @package     WordPress
 * @subpackage  Bootstrap 5.3.2
 * @author      True North Sports + Entertainment
 */

$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/html-header',
	'parts/shared/header'
]);
?>

<?php if ( have_posts() ): ?>

	<h1><?php echo __('Latest Posts', 'manitobamoose'); ?></h1>

	<ul class="list-unstyled">
		<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<h2>
					<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h2>
				<time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>" pubdate>
					<?php the_date(); ?> <?php the_time(); ?>
				</time>
				<?php comments_popup_link(__('Leave a Comment', 'manitobamoose'), __('1 Comment', 'manitobamoose'), __('% Comments', 'manitobamoose')); ?>
				<?php the_content(); ?>
			</li>
		<?php endwhile; ?>
	</ul>

<?php else: ?>

	<h1><?php echo __('Nothing to show yet.', 'manitobamoose'); ?></h1>

<?php endif; ?>

<?php 
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>