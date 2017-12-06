<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Embla
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
	if ( have_comments() || comments_open() ) {
		?>
		<h2 class="entry-title">
			<?php
			$comments_number = get_comments_number();

			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'embla' ), get_the_title() );
			} elseif ( '0' !== $comments_number ) {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'embla'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h2>
		<?php embla_comments_pagination(); ?>
		
		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style' => 'ol',
				'avatar_size' => '40',
			) );
			?>
		</ol><!-- .comment-list -->

		<?php
		embla_comments_pagination();

	} // End if().

	comment_form();
	?>

</div><!-- #comments -->
