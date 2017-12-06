<?php
/**
 * Template Name: Experimental: Wide images
 * Template Post Type: post, page
 * Description: A template better suited for using wide or full width images.
 *
 * @package Embla
 */

get_header(); ?>
<main id="main" class="site-main">
	<?php
	while ( have_posts() ) : the_post();
		get_template_part( 'content' );
		if ( is_single() ) {
			if ( ! get_theme_mod( 'embla_postnav' ) && ! is_attachment() ) {
				the_post_navigation( array(
					'prev_text' => __( 'Previous post', 'embla' ),
					'next_text' => __( 'Next post', 'embla' ),
				) );
			}
		}

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

	endwhile; // End of the loop.
	?>
</main><!-- #main -->
<?php
get_footer();
