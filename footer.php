<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Embla
 */

?>
<footer id="colophon" role="contentinfo" class="site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<?php
	if ( get_theme_mod( 'embla_show_footer_icon' ) ) {
		echo '<div class="embla-icon"><a href="' . esc_url( home_url( '/' ) ) . '"><span class="screen-reader-text">' . esc_html__( 'Return Home', 'embla' ) . '</span>' . embla_get_svg( array( 'icon' => get_theme_mod( 'embla_header_icon', 'wordpress' ) ) ) . '</a></div>';
	}
	?>
	<h2 class="screen-reader-text"><?php esc_html_e( 'Footer Content', 'embla' ); ?></h2>
	<?php
	if ( is_active_sidebar( 'sidebar-1' ) ) {
	?>
		<aside class="widget-area" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</aside>
	<?php
	}
	if ( has_nav_menu( 'social' ) ) {
	?>
		<nav class="social-menu" role="navigation" aria-label="<?php esc_attr_e( 'Social Media Links', 'embla' ); ?>" 
		itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'social',
			'menu_class'     => 'social-links-menu',
			'depth'          => 1,
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>' . embla_get_svg( array( 'icon' => 'chain' ) ),
			'container'      => false,
		) );
		?>
		</nav><!-- #social-menu -->
	<?php
	}
	?>
	<div class="site-info">
	<?php
	if ( is_active_sidebar( 'sidebar-2' ) ) {
	?>
		<aside class="widget-area" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</aside>
	<?php
	}

	if ( ! get_theme_mod( 'embla_hide_credits' ) ) {
	?>
		<div class="credits">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'embla' ) ); ?>" class="credit"><?php printf( esc_html__( 'Proudly powered by %s', 'embla' ), 'WordPress' ); ?></a>
			&nbsp; &nbsp;
			<a href="<?php echo esc_url( 'https://theme.tips/' ); ?>" rel="nofollow" class="theme-credit"><?php printf( esc_html__( 'Theme: %1$s by Carolina', 'embla' ), 'Embla' ); ?></a>
		</div>
	<?php
	}
	?>
	</div><!-- .site-info -->

</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
