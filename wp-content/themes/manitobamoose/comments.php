<?php
/**
 * Template for displaying comments and the comment form.
 *
 * @package Manitoba Moose
 */

?>

<div id="comments" class="container py-5">

<?php if ( post_password_required() ) : ?>
	<p><?php _e('This post is password protected. Enter the password to view comments.', 'manitobamoose'); ?></p>
</div>
<?php return; endif; ?>

<?php if ( have_comments() ) : ?>
	<h2><?php comments_number(); ?></h2>

	<ul class="list-unstyled">
		<?php wp_list_comments( array( 'callback' => 'bootstrap_comment' ) ); ?>
	</ul>

<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<p><?php _e('Comments are closed.', 'manitobamoose'); ?></p>
<?php endif; ?>

<?php
// Setup Bootstrap-compatible comment form
$commenter = wp_get_current_commenter();
$req = true;
$aria_req = ( $req ? " aria-required='true'" : '' );

$comments_args = array(
	'fields' => array(
		'author' => '<div class="mb-3"><label for="author">' . __( 'Name', 'manitobamoose' ) . '</label><span>*</span>' .
			'<input id="author" name="author" class="form-control" type="text" value="" size="30"' . $aria_req . ' />' .
			'<p id="d1" class="text-danger"></p></div>',
		'email' => '<div class="mb-3"><label for="email">' . __( 'Email', 'manitobamoose' ) . '</label><span>*</span>' .
			'<input id="email" name="email" class="form-control" type="email" value="" size="30"' . $aria_req . ' />' .
			'<p id="d2" class="text-danger"></p></div>',
	),
	'comment_field' => '<div class="mb-3"><label for="comment">' . __( 'Comment', 'manitobamoose' ) . '</label><span>*</span>' .
		'<textarea id="comment" name="comment" class="form-control" rows="3" aria-required="true"></textarea>' .
		'<p id="d3" class="text-danger"></p></div>',
	'class_submit' => 'btn btn-primary',
	'comment_notes_after' => '',
);

ob_start();
comment_form( $comments_args );
echo str_replace(
	'class="comment-form"',
	'class="comment-form" name="commentForm" onsubmit="return validateForm();"',
	ob_get_clean()
);
?>

<script>
function validateForm() {
	const form = document.forms.commentForm;
	const x = form.author.value.trim();
	const y = form.email.value.trim();
	const z = form.comment.value.trim();
	let valid = true;

	document.getElementById("d1").innerText = x ? '' : "<?php echo __('Name is required', 'manitobamoose'); ?>";
	document.getElementById("d2").innerText = y ? '' : "<?php echo __('Email is required', 'manitobamoose'); ?>";
	document.getElementById("d3").innerText = z ? '' : "<?php echo __('Comment is required', 'manitobamoose'); ?>";

	if (!x || !y || !z) valid = false;

	return valid;
}
</script>

</div>