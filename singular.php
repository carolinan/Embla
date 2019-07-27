<?php
/**
 * The template for displaying all single post or pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Embla
 */

get_header(); ?>
<main id="main" class="site-main" role="main">
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'content' );

		if ( is_front_page() ) {
			if ( get_theme_mod( 'embla_section1' ) || get_theme_mod( 'embla_section2' ) || get_theme_mod( 'embla_section3' ) ) {
				$args = array(
					'post_type' => 'page',
					'orderby'   => 'post__in',
					'post__in'  => array(
						get_theme_mod( 'embla_section1' ),
						get_theme_mod( 'embla_section2' ),
						get_theme_mod( 'embla_section3' ),
					),
				);

				$top_section_query = new WP_Query( $args );

				if ( $top_section_query->have_posts() ) {
					while ( $top_section_query->have_posts() ) :
						$top_section_query->the_post();
						get_template_part( 'content' );
					endwhile;
					wp_reset_postdata();
				}
			}
		}

		if ( is_single() ) {
			if ( ! get_theme_mod( 'embla_postnav' ) && ! is_attachment() ) {
				the_post_navigation(
					array(
						'prev_text' => __( 'Previous post', 'embla' ),
						'next_text' => __( 'Next post', 'embla' ),
					)
				);
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
