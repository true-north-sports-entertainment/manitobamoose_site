<?php
/**
 * The Template for displaying all single posts
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

<div id="post-header-cnt" class="mb-3 mb-md-5">
	<div id="post-title">
	<picture>
	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/18124652/whats-on-header-title-v3.png" media="(min-width: 775px)" />
	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/18124652/whats-on-header-title-v3.png"/>
	<img data-src="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/18124652/whats-on-header-title-v3.png" loading="lazy"/>
	</picture>
	</div>
	<div class="post-thumbnail">	
	<picture>
	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/26173944/whats-on-hdr-2560x400-1.jpg" media="(min-width: 2100px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23105059/whats-on-hdr-2100-v2.jpg" media="(min-width: 1701px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/23154622/whats-on-hdr-576w-v4.jpg" media="(max-width: 576px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/09/23153952/whats-on-hdr-768w-v15.jpg" media="(max-width: 768px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23110208/whats-on-hdr-1100-v3.jpg" media="(max-width: 1100px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23104318/whats-on-hdr-1700-v2.jpg" media="(max-width: 1700px)" />

	<img src="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23111234/whats-on-hdr-576-v2.jpg" />
	</picture>
	</div>
</div>




<div class="container wrapper px-4 px-md-5 px-xxl-4">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 <?php if (is_singular('tribe_event_series')) { echo 'col-lg-12'; } else { echo 'col-lg-8'; } ?>">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<div class="content">
		<?php 
			if (!is_singular('tribe_event_series')){
				?>
				<h2>
					<?php the_title(); ?>
				</h2>
				<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
					<?php the_date(); ?> <?php the_time(); ?>
				</time>
				<?php
			}
			else{
				
			}
		?>
		
		<?php the_content(); ?>

		<?php if ( get_the_author_meta( 'description' ) ) : ?>
			<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
			<h3>
				<?php echo __('About', 'wp_babobski'); ?> <?php echo get_the_author() ; ?>
			</h3>
			<?php the_author_meta( 'description' ); ?>
		<?php endif; ?>



	</div>

<?php endwhile; ?>
		</div>

		<?php 
			if (is_singular('tribe_event_series')){
				?>
				
				<?php
			}
			else{
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 px-4 pb-5 px-lg-5">
					<h2>Upcoming Events</h2>
					<?php
					echo do_shortcode('[tribe_events_list tribe-bar="false" limit="15"]');
					?>
				</div>
				<?php
			}
		?>

		


		
	</div>
</div>

<?php 
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>
