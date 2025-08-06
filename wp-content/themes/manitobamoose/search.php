<?php
/**
 * Search results page
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 5.3.2
 */
$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/html-header', 
	'parts/shared/header'
]);
?>

<div class="container wrapper px-4 px-md-5 px-xxl-4">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 px-4 px-sm-5 px-md-4 px-lg-4">
			<div class="search-form col-12 mb-5 pt-3 pt-md-2">
				<?php get_search_form(); ?>
			</div>
			<?php if ( have_posts() ): ?>
				<div class="content">
					<h1 class="sr-h1"><?php echo __('Search Results for', 'manitobamoose'); ?> '<?php echo get_search_query(); ?>'</h1>
					<ul class="list-unstyled">
						<?php while ( have_posts() ) : the_post(); ?>
						<li class="media">
							<div class="media-body">
								<h2>
								<a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
								</h2>
								<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
									<?php the_date(); ?> <?php the_time(); ?>
								</time>
							
								<?php the_content(); ?>
							</div>
						</li>
						<?php endwhile; ?>
					</ul>
				</div>
			<?php else: ?>
			<h1>
				<?php echo __('No results found for', 'manitobamoose'); ?> '<?php echo get_search_query(); ?>'
			</h1>
			<?php endif; ?>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 ps-lg-4 pe-lg-4 px-4 px-sm-5 px-md-4 px-lg-4 pb-0 pb-lg-4 pt-3 pt-lg-0 upc-custom">
			
		</div>
	</div>
</div>

<?php 
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>