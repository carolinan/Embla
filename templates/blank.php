<?php
/**
 * Template Name: Experimental: Blank
 * Template Post Type: post, page
 * Description: Use this template if you only want to show your Gutenberg blocks. This template does not show the header, footer or the footer widget area.
 *
 * @package Embla
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<div id="page" class="site">
<main id="main" class="site-main">
	<?php
	while ( have_posts() ) : the_post();
		get_template_part( 'content' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

	endwhile; // End of the loop.
	?>
</main><!-- #main -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
