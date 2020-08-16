<?php
/**
 * Template part for displaying posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Embla
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( 'jetpack-testimonial' == get_post_type() ) {
		?>
		<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'embla' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);
		?>
		</div><!-- .entry-content -->
		<?php
		the_title( '<h2 class="entry-title">-', '</h2>' );
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'thumbnail' );
		}
	} elseif ( is_single() || is_page() ) {

		if ( has_post_thumbnail() && ! embla_get_meta( 'embla_featured_image_header' ) ) {
			the_post_thumbnail();
		}
		?>
		<header class="entry-header">
		<?php
		if ( is_front_page() ) {
			the_title( '<h2 class="entry-title">', '</h2>' );
		} else {
			the_title( '<h1 class="entry-title">', '</h1>' );
		}
		?>
		</header><!-- .entry-header -->
		<?php if ( function_exists( 'jetpack_breadcrumbs' ) ) { ?>
			<div class="breadcrumb-area">
			<span class="screen-reader-text"><?php esc_html_e( 'Breadcrumb Navigation', 'embla' ); ?></span>
			<?php jetpack_breadcrumbs(); ?>
			</div><!-- .breadcrumb-area -->
		<?php } ?>

		<?php embla_posted_on(); ?>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before'      => '<div class="page-links">' . __( 'Pages:', 'embla' ),
					'after'       => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				)
			);

			?>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
		<?php embla_entry_footer(); ?>
		</footer><!-- .entry-footer -->

		<?php
	} else {
		if ( has_post_thumbnail() ) {
			echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
			the_post_thumbnail();
			echo '</a>';
		}
		?>
		<header class="entry-header">
		<?php
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		?>
		</header><!-- .entry-header -->
		<?php
		if ( get_theme_mod( 'embla_show_meta' ) ) {
			embla_posted_on();
		}
		?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
		<?php
	}
	?>

</article><!-- #post-## -->
