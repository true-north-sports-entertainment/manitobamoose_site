<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Burt

 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div id="post-header-cnt">
        <div id="post-title">
            <picture>
            <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/18124648/venue-header-title-v3.png" media="(min-width: 775px)" />
            <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/18124648/venue-header-title-v3.png"/>
            <img src="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/18124648/venue-header-title-v3.png" />
            </picture>
        </div>
	    <div class="post-thumbnail">	
            <picture>
                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/18092936/venue-header-v3.jpg" media="(min-width: 2100px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23123926/the-venue-hdr-2100-v2.jpg" media="(min-width: 1701px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23134001/the-venue-hdr-576.jpg" media="(max-width: 576px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23133828/the-venue-hdr-768.jpg" media="(max-width: 768px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23130147/the-venue-hdr-1100-v3.jpg" media="(max-width: 1100px)" />

                <source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23130514/the-venue-hdr-1700-v2.jpg" media="(max-width: 1700px)" />

                <img src="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/07/23130147/the-venue-hdr-1100-v3.jpg" />
            </picture>
	    </div>
    </div>

	<div class="entry-content" style="border:1px solid red">
		<div id="content-txt">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'burt' ),
				'after'  => '</div>',
			)
		);
		?>
		</div>
		<div id="content-imgs">
			<img src="http://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2024/03/18135748/the-burton-cummings-theatre-exchange-district-winnipeg-manitoba-canada-2CB8HXJ-v2.jpg" alt="" style="width:100%;"/>
			<p>The Burton Cummings Theatre is located on Treaty One lands, the original territories of the Anishinaabe, Cree, Oji-Cree, Dakota, Lakota, Dene peoples, and the homeland of the Red River Métis.</p><p>True North Sports + Entertainment proudly acknowledges our role in the many relationships that make up our home and commit to a spirit of reconciliation for the future.</p>
		</div>
	</div><!-- .entry-content -->
	
</article><!-- #post-<?php the_ID(); ?> -->