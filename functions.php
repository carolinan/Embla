<?php
/**
 * Embla functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Embla
 */

if ( ! function_exists( 'embla_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function embla_setup() {
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		add_image_size( 'embla-recent-post', 80, 80 );

		add_theme_support( 'custom-logo', array(
			'height'      => 60,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		register_nav_menus( array(
			'main' => esc_html( 'Main Menu (Header)','embla' ),
			'social' => esc_html__( 'Social Menu (Footer)', 'embla' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-header', apply_filters( 'embla_custom_header_args', array(
			'default-image'          => false,
			'default-text-color'     => '#111',
			'uploads'                => true,
			'width'                  => '1280',
			'height'                 => '600',
			'flex-height'            => true,
			'flex-width'             => true,
			'video'                  => true,
			)
		) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'jetpack-responsive-videos' );

		add_theme_support( 'woocommerce' );

		add_theme_support( 'starter-content', array(

			'nav_menus' => array(
				'main' => array(
					'name' => __( 'Main Menu (Header)', 'embla' ),
					'items' => array(
						'page_about',
						'page_contact',
					),
				),
				'social' => array(
					'name' => __( 'Social Menu (Footer)', 'embla' ),
					'items' => array(
						'link_facebook',
						'link_twitter',
						'link_instagram',
					),
				),
			),
			'posts' => array(
				'about',
				'contact',
				'blog',
				'news',
			),

		) );

	}
}  // End if().

add_action( 'after_setup_theme', 'embla_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function embla_content_width() {
	// We are setting this to 700, which will match the Gutenberg editor.
	$GLOBALS['content_width'] = apply_filters( 'embla_content_width', 700 );
}
add_action( 'after_setup_theme', 'embla_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function embla_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'embla' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Widgets in this section will be shown in the footer. ','embla' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Copyright', 'embla' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Please place a single text widget with your copyright information here. It will then be shown in the footer.','embla' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Widgets', 'embla' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Widgets in this section will be shown below your shop.','embla' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'embla_widgets_init' );

/**
 * Register custom fonts.
 * Credits:
 * Twenty Seventeen WordPress Theme, Copyright 2016 WordPress.org
 * Twenty Seventeen is distributed under the terms of the GNU GPL
 */
function embla_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Ledger, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$noto = _x( 'on', 'Noto Serif font: on or off', 'embla' );

		if ( 'off' !== $noto )
			$font_families[] = 'Noto Serif';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function embla_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'embla-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'embla_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function embla_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'embla-fonts', embla_fonts_url(), array(), null );
	wp_enqueue_style( 'embla-style', get_stylesheet_uri() );

	// Add styles for Gutenberg blocks. -This will load even if Gutenerg is not active, in case there is content that has been edited in Gutenberg before.
	wp_enqueue_style( 'embla-blocks-style', get_template_directory_uri() . '/css/blocks.css' );

	wp_enqueue_script( 'embla-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20170910', true );
	wp_enqueue_script( 'embla-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20170910', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'embla_scripts' );

/*
Embla uses different excerpt lengths depending on where it is displayed.
*/
function embla_excerpt_length( $length ) {
	if ( ! is_admin() ) {
		global $wp_query;
		if ( $wp_query->current_post === 0 && ! is_paged() && ! is_archive() ) {
			return 150;
		} else {
			return 40;
		}
	}
}
add_filter( 'excerpt_length', 'embla_excerpt_length', 999 );

function embla_excerpt_more( $more ) {
	global $post;
	global $wp_query;
	if ( $wp_query->current_post === 0 && ! is_paged() ) {
		return '&hellip; <br><br><a class="more-link" href="' . esc_url( get_permalink( $post->ID ) ) . '">' .
		sprintf( esc_html__( 'Continue Reading %s', 'embla' ), get_the_title( $post->ID ) ) . '</a>';
	} else {
		return '&hellip; ';
	}
}
add_filter( 'excerpt_more', 'embla_excerpt_more' );

function embla_comment_excerpt_length( $length ) {
	if ( ! is_admin() ) {
		return 10;
	}
}
add_filter( 'comment_excerpt_length', 'embla_comment_excerpt_length', 999 );

if ( ! function_exists( 'embla_comments_pagination' ) ) {
	/**
	 * Because get_the_comments_pagination() only accepts one type (plain) I had to alter the function slightly to add the list type,
	 * so that the comment pagination could be styled in the same way as the post pagination.
	 * https://developer.wordpress.org/reference/functions/get_the_comments_pagination/
	 * Related ticket: https://core.trac.wordpress.org/ticket/39792
	 **/
	function embla_comments_pagination( $args = array() ) {
		$navigation = '';
		$args       = wp_parse_args( $args, array(
			'screen_reader_text' => __( 'Comments navigation', 'embla' ),
			'prev_text'	=> _x( 'Previous Comments', 'previous set of comments', 'embla' ),
			'next_text'	=> _x( 'Next Comments', 'next set of comments', 'embla' ),
			'type' => 'list',
		) );
		$links = paginate_comments_links( $args );
		if ( $links ) {
			$navigation = _navigation_markup( $links, 'comments-pagination', $args['screen_reader_text'] );
		}
	}
}

/**
 * Remove the Jetpack likes and sharing_display filter so that we can resposition them to our post footer.
 * Otherwise, they are displayed below the content, but above the page links ( wp_link_pages() ) if a post has multiple pages.
 */
function embla_move_share() {
	remove_filter( 'the_content', 'sharing_display',19 );
	remove_filter( 'the_excerpt', 'sharing_display',19 );

	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}
}
add_action( 'loop_start', 'embla_move_share' );

/**
 * Remove the Jetpack related posts filter so that we can resposition them to our post footer.
 */
function embla_move_related_posts() {
	if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
	$jprp = Jetpack_RelatedPosts::init();
	$callback = array( $jprp, 'filter_add_target_to_dom' );
		remove_filter( 'the_content', $callback, 40 );
	}
}
add_filter( 'wp', 'embla_move_related_posts', 20 );

/**
 * Credit: Twenty Seventeen and Weston Ruter https://github.com/WordPress/gutenberg/issues/2235
 */
function embla_body_classes( $body_classes ) {
	if ( is_singular() && false !== strpos( get_queried_object()->post_content, '<!-- wp:' ) ) {
		$body_classes[] = 'gutenberg';
	}

	if ( has_header_image() || has_header_video() ) {
		$body_classes[] = 'has-header-media';
	}

	return $body_classes;
}
add_filter( 'body_class', 'embla_body_classes' );


function embla_customize_css() {
	echo '<style type="text/css">';
	echo '.site-title, .site-title a, .site-description {color: #' . esc_attr( get_theme_mod( 'header_textcolor', '111' ) ) . ';} 
		.site-description .icon {fill: #' . esc_attr( get_theme_mod( 'header_textcolor', '111' ) ) . ';}
		.embla-icon .icon {fill: ' . esc_attr( get_theme_mod( 'embla_icon_color', '#000' ) ) . ';}';

	if ( get_theme_mod( 'embla_accent_color' ) !== '#0073AA' ) {
		echo 'a:hover, a:focus, a:active { color: ' . esc_attr( get_theme_mod( 'embla_accent_color' ) ) . ';} ';

		if ( class_exists( 'WooCommerce' ) ) {
			echo '.woocommerce .woocommerce-breadcrumb a:hover, .woocommerce .woocommerce-breadcrumb a:focus { color: ' . esc_attr( get_theme_mod( 'embla_accent_color' ) ) . ';} ';
			echo  '.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, 
			.woocommerce #respond input#submit.alt:focus, .woocommerce a.button.alt:focus, .woocommerce button.button.alt:focus, .woocommerce input.button.alt:focus {
				background: ' . esc_attr( get_theme_mod( 'embla_accent_color' ) ) . ';} ';
		}
	}

	echo '</style>';
}
add_action( 'wp_head', 'embla_customize_css' );

/* Support for WooCommerce */
if ( class_exists( 'WooCommerce' ) ) {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

	add_action( 'woocommerce_before_main_content', 'embla_wrapper_start', 10 );
	add_action( 'woocommerce_after_main_content', 'embla_wrapper_end', 10 );

	function embla_wrapper_start() {
		echo '<main id="main" class="site-main">';
	}
	function embla_wrapper_end() {
		echo '</main>';
	}
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-icons.php';

/**
 * SVG icons
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Load custom widget files.
 */
require get_template_directory() . '/inc/recent-posts-widget.php';
require get_template_directory() . '/inc/recent-comments-widget.php';
