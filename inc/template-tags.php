<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Embla
 */

if ( ! function_exists( 'embla_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function embla_posted_on() {
		$time_string = '<time datetime="%1$s">%2$s</time>';
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		$byline = '<span class="author vcard byline">
		<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span> ';

		$published = '<span class="published">' . __( 'Published: ', 'embla' ) . $time_string . '</span>';

		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta">' . $byline . ' ' . $published; // WPCS: XSS OK.
			$categories_list = get_the_category_list( ' &#183; ' );
			if ( $categories_list ) {
				echo ' <span class="categories">' . esc_html__( 'Categories: ', 'embla' ) . $categories_list . '</span>'; // WPCS: XSS OK.
			}
			if ( is_single() ) {
				$tags_list = get_the_tag_list( '', ' &#183; ' );
				if ( $tags_list ) {
					echo ' <span class="tags">' . esc_html__( 'Tags: ', 'embla' ) . $tags_list . '</span>'; // WPCS: XSS OK.
				}
			}
			echo '	</div><!-- .entry-meta -->';
		}
	}
}

if ( ! function_exists( 'embla_entry_footer' ) ) {
	/**
	 * Prints the jetpack sharing and like.
	 */
	function embla_entry_footer() {

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'embla' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);

		/* Display jetpack's share if it's active. */
		if ( function_exists( 'sharing_display' ) ) {
			echo sharing_display();
		}

		/* Display jetpack's like if it's active. */
		if ( class_exists( 'Jetpack_Likes' ) ) {
			$embla_custom_likes = new Jetpack_Likes;
			echo $embla_custom_likes->post_likes( '' );
		}

		/* Display Jetpack's related posts if it's active. */
		if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
			echo do_shortcode( '[jetpack-related-posts]' );
		}
	}
}

if ( ! function_exists( 'embla_post_title' ) ) {
	/**
	 * Add a title to posts that are missing titles.
	 */
	function embla_post_title( $title ) {
		if ( '' === $title ) {
			return esc_html__( '(Untitled)', 'embla' );
		} else {
			return $title;
		}
	}
	add_filter( 'the_title', 'embla_post_title' );
}


if ( ! function_exists( 'embla_header_nav' ) ) {
	/**
	 * Markup for the header navigation.
	 */
	function embla_header_nav() {
	?>
	<div class="menu-wrap">
		<nav id="site-navigation" role="navigation" aria-label="<?php esc_html_e( 'Header menu', 'embla' ); ?>" class="main-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
			<button id="mobile-menu-toggle" aria-controls="main-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'embla' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'main',
					'menu_id' => 'main-menu',
					'depth' => 3,
					'container' => false,
				)
			);
			?>
		</nav>
	</div>
<?php
	}
}
