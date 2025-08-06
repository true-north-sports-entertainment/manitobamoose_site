<?php
/**
 * The Template for displaying all single posts
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
		<div class="col-12 col-lg-8">
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="content">
					
					<h2><?php the_title(); ?></h2>
					
					<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
						<?php the_date(); ?> <?php the_time(); ?>
					</time>

					<?php the_content(); ?>

					<?php if ( get_the_author_meta( 'description' ) ) : ?>
						<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
						<h3><?php _e( 'About', 'manitobamoose' ); ?> <?php the_author(); ?></h3>
						<?php the_author_meta( 'description' ); ?>
					<?php endif; ?>
				
				</div>
			<?php endwhile; endif; ?>

		</div>
	</div>
</div>

<?php 
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>
