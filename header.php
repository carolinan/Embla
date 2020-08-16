<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Embla
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/111">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="https://schema.org/WebPage">
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} else {
	do_action( 'wp_body_open' );
}
?>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'embla' ); ?></a>
<header id="masthead" class="site-header" role="banner">
	<div class="header-wrap">
		<div class="site-branding">
		<?php
		if ( has_custom_logo() ) {
			the_custom_logo();
			if ( is_front_page() && ! is_paged() ) {
				echo '<h1 class="screen-reader-text">' . get_bloginfo( 'name' ) . '</h1>';
			}
		} else {

			if ( display_header_text() ) {
				if ( is_front_page() && ! is_paged() ) {
				?>
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
					<?php
				} elseif ( is_front_page() && is_paged() ) {
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				} else {
					?>
					<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></span>
					<?php
				}
			}

			if ( display_header_text() && get_bloginfo( 'description' ) ) {
				?>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				<?php
			}
		}
		echo '</div>';

		embla_header_nav();

	?>
	</div><!-- #header-wrap -->
	<?php

	if ( get_theme_mod( 'embla_show_header_icon' ) ) {
		echo '<div class="embla-icon">' . embla_get_svg( array( 'icon' => get_theme_mod( 'embla_header_icon', 'wordpress' ) ) ) . '</div>';
	}
	?>
</header><!-- #masthead -->

<?php
if ( is_home() ) {
	$postid = get_option( 'page_for_posts' );
} else {
	$postid = get_the_ID();
}

$embla_featured_header = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'embla-featured-image-header' );

if ( is_singular() && embla_get_meta( 'embla_featured_image_header' ) && $embla_featured_header ) {
	echo '<div id="wp-custom-header" class="wp-custom-header">';
	echo '<img src="' . esc_url( $embla_featured_header[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
	echo '</div>';
} else {

	if ( has_header_video() || has_header_image() ) {
		the_custom_header_markup();
	}
}
