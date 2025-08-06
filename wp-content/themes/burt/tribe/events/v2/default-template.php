<?php
/**
 * View: Default Template for Events
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/default-template.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.0
 */

use Tribe\Events\Views\V2\Template_Bootstrap;

get_header();
?>
<div id="post-header-cnt" class="mb-3 mb-md-5">
	<div id="post-title">
	<picture>
	<source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16102105/whats-on-at-the-burt-hero.png" media="(min-width: 775px)" />
	<source srcset="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16102105/whats-on-at-the-burt-hero.png"/>
	<img data-src="https://tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/16102105/whats-on-at-the-burt-hero.png" loading="lazy"/>
	</picture>
	</div>
	<div class="post-thumbnail">		
	<picture>
	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/17124752/whats-on-hero-6.jpg" media="(min-width: 2100px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26170708/whats-on-2100x369-1.jpg" media="(min-width: 1701px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26174847/whats-on-576-192-v12.jpg" media="(max-width: 576px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26174847/whats-on-768x256-v12.jpg" media="(max-width: 768px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26172224/whats-on-1100x300-1.jpg" media="(max-width: 1100px)" />

	<source srcset="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26171634/whats-on-1700x387-2.jpg" media="(max-width: 1700px)" />

	<img src="//tnse-website-uploads.s3.ca-central-1.amazonaws.com/burtoncummingstheatre/wp-content/uploads/2025/01/26174847/whats-on-576-192-v12.jpg" />
	</picture>
	</div>
	<div class="brdr"></div>
</div>

<?php
echo tribe( Template_Bootstrap::class )->get_view_html();

get_footer();
