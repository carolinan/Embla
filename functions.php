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

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 60,
				'width'       => 200,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);

		register_nav_menus(
			array(
				'main'   => esc_html__( 'Main Menu (Header)', 'embla' ),
				'social' => esc_html__( 'Social Menu (Footer)', 'embla' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		add_theme_support(
			'custom-header',
			apply_filters(
				'embla_custom_header_args',
				array(
					'default-image'      => false,
					'default-text-color' => '#111',
					'uploads'            => true,
					'width'              => '1280',
					'height'             => '600',
					'flex-height'        => true,
					'flex-width'         => true,
					'video'              => true,
				)
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'jetpack-responsive-videos' );

		add_theme_support( 'woocommerce' );

		add_theme_support(
			'starter-content',
			array(
				'nav_menus' => array(
					'main' => array(
						'name'  => __( 'Main Menu (Header)', 'embla' ),
						'items' => array(
							'page_about',
							'page_contact',
						),
					),
					'social' => array(
						'name'  => __( 'Social Menu (Footer)', 'embla' ),
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

			)
		);

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Embla blue', 'embla' ),
					'slug'  => 'embla-blue',
					'color' => '#0073AA',
				),
			)
		);

		add_theme_support( 'align-wide' );

		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add styles for the classic editor.
		add_editor_style();

	}
}  // End if().

add_action( 'after_setup_theme', 'embla_setup' );

if ( ! function_exists( 'embla_content_width' ) ) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function embla_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'embla_content_width', 720 );
	}
	add_action( 'after_setup_theme', 'embla_content_width', 0 );
}

if ( ! function_exists( 'embla_widgets_init' ) ) {
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function embla_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Widgets', 'embla' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Widgets in this section will be shown in the footer.', 'embla' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Copyright', 'embla' ),
				'id'            => 'sidebar-2',
				'description'   => esc_html__( 'Please place a single text widget with your copyright information here. It will then be shown in the footer.', 'embla' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		if ( class_exists( 'WooCommerce' ) ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Shop Widgets', 'embla' ),
					'id'            => 'sidebar-shop',
					'description'   => esc_html__( 'Widgets in this section will be shown below your shop.', 'embla' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			);
		}
	}
	add_action( 'widgets_init', 'embla_widgets_init' );
}

if ( ! function_exists( 'embla_fonts_url' ) ) {
	/**
	 * Register custom fonts.
	 * Credits:
	 * Twenty Seventeen WordPress Theme, Copyright 2016 WordPress.org
	 * Twenty Seventeen is distributed under the terms of the GNU GPL
	 */
	function embla_fonts_url() {
		$fonts_url = '';

		$font_families   = array();
		$font_families[] = get_theme_mod( 'embla_body_font', 'Noto Serif' );
		$font_families[] = get_theme_mod( 'embla_title_font' );
		$font_families[] = get_theme_mod( 'embla_description_font' );
		$font_families[] = get_theme_mod( 'embla_post_title_font' );

		$font_families = array_unique( $font_families );

		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

		return esc_url_raw( $fonts_url );
	}
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


if ( ! function_exists( 'embla_scripts' ) ) {
	/**
	 * Enqueue scripts and styles.
	 */
	function embla_scripts() {
		// Add custom fonts, used in the main stylesheet.
		wp_enqueue_style( 'embla-fonts', embla_fonts_url(), array(), null );
		wp_enqueue_style( 'embla-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
		wp_style_add_data( 'embla-style', 'rtl', 'replace' );

		wp_enqueue_script( 'embla-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_style( 'embla-print-style', get_template_directory_uri() . '/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

		if ( class_exists( 'woocommerce' ) ) {
			wp_enqueue_style( 'embla-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', array(), wp_get_theme()->get( 'Version' ) );
		}

		if ( class_exists( 'bbPress' ) ) {
			wp_enqueue_style( 'embla-bbpress', get_template_directory_uri() . '/inc/bbpress.css', array(), wp_get_theme()->get( 'Version' ) );
		}
	}
	add_action( 'wp_enqueue_scripts', 'embla_scripts' );
}

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function embla_skip_link_focus_fix() {
	// The following is minified. The original file is in js/skip-link-focus-fix.js.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'embla_skip_link_focus_fix' );


if ( ! function_exists( 'embla_gutenberg_assets' ) ) {
	/**
	 * Add styles and fonts for the new editor.
	 */
	function embla_gutenberg_assets() {
		wp_enqueue_style( 'embla-fonts', embla_fonts_url(), array(), null );
		wp_enqueue_style( 'embla-gutenberg', get_theme_file_uri( '/css/gutenberg-editor.css' ), false );
	}
	add_action( 'enqueue_block_editor_assets', 'embla_gutenberg_assets' );
}

if ( ! function_exists( 'embla_excerpt_length' ) ) {
	/**
	 * Embla uses different excerpt lengths depending on where it is displayed.
	 */
	function embla_excerpt_length( $length ) {
		if ( ! is_admin() ) {
			global $wp_query;
			if ( $wp_query->current_post === 0 && ! is_paged() && ! is_archive() ) {
				return 150;
			} else {
				return 30;
			}
		} else {
			return $length;
		}
	}
	add_filter( 'excerpt_length', 'embla_excerpt_length', 999 );
}

if ( ! function_exists( 'embla_excerpt_more' ) ) {
	function embla_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			global $post;
			global $wp_query;
			if ( $wp_query->current_post === 0 && ! is_paged() ) {
				return '&hellip; <br><br><a class="more-link" href="' . esc_url( get_permalink( $post->ID ) ) . '">' .
				sprintf( esc_html__( 'Continue Reading %s', 'embla' ), get_the_title( $post->ID ) ) . '</a>';
			} else {
				return '&hellip; ';
			}
		} else {
			return $more;
		}
	}
	add_filter( 'excerpt_more', 'embla_excerpt_more' );
}

if ( ! function_exists( 'embla_comment_excerpt_length' ) ) {
	function embla_comment_excerpt_length( $length ) {
		if ( ! is_admin() ) {
			return 10;
		} else {
			return $length;
		}
	}
	add_filter( 'comment_excerpt_length', 'embla_comment_excerpt_length', 999 );
}

if ( ! function_exists( 'embla_comments_pagination' ) ) {
	/**
	 * Because get_the_comments_pagination() only accepts one type (plain) I had to alter the function slightly to add the list type,
	 * so that the comment pagination could be styled in the same way as the post pagination.
	 * https://developer.wordpress.org/reference/functions/get_the_comments_pagination/
	 * Related ticket: https://core.trac.wordpress.org/ticket/39792
	 **/
	function embla_comments_pagination( $args = array() ) {
		$navigation = '';
		$args       = wp_parse_args(
			$args,
			array(
				'screen_reader_text' => __( 'Comments navigation', 'embla' ),
				'prev_text'          => _x( 'Previous Comments', 'previous set of comments', 'embla' ),
				'next_text'          => _x( 'Next Comments', 'next set of comments', 'embla' ),
				'type'               => 'list',
			)
		);

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
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );

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
		$jprp     = Jetpack_RelatedPosts::init();
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
	if ( get_theme_mod( 'embla_show_footer_icon' ) ) {
		$body_classes[] = 'has-footer-icon';
	}
	if ( get_theme_mod( 'embla_show_header_icon' ) ) {
		$body_classes[] = 'has-header-icon';
	}
	return $body_classes;
}
add_filter( 'body_class', 'embla_body_classes' );

if ( ! function_exists( 'embla_post_classes' ) ) {
	function embla_post_classes( $classes ) {
		if ( get_page_template_slug() === 'templates/blank.php' ) {
			$classes[] = 'hide-content-borders';
		} elseif ( is_singular() && false !== strpos( get_queried_object()->post_content, '<!-- wp:' ) && false !== strpos( get_queried_object()->post_content, '"align":"full"' ) ) {
			$classes[] = 'hide-content-borders';
		} elseif ( is_front_page() && false !== strpos( get_post()->post_content, '<!-- wp:' ) && false !== strpos( get_post()->post_content, '"align":"full"' ) ) {
			$classes[] = 'hide-content-borders';
		}
		return $classes;
	}
	add_filter( 'post_class', 'embla_post_classes', 10, 3 );
}

if ( ! function_exists( 'embla_footer' ) ) {
	function embla_footer() {
		?>
		<div class="credits">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'embla' ) ); ?>" class="credit"><?php printf( esc_html__( 'Proudly powered by %s', 'embla' ), 'WordPress' ); ?></a>
			&nbsp; &nbsp;
			<a href="<?php echo esc_url( 'https://themesbycarolina.com' ); ?>" rel="nofollow" class="theme-credit"><?php printf( esc_html__( 'Theme: %1$s by Carolina', 'embla' ), 'Embla' ); ?></a>
		</div>
		<?php
	}
}

if ( ! function_exists( 'embla_customize_css' ) ) {
	/**
	 * Custom CSS for the icon, fonts and accent colors.
	 */
	function embla_customize_css() {
		echo '<style type="text/css">';
		/* Accent color */
		echo '.site-title, .site-title a, .site-description {color: #' . esc_attr( get_theme_mod( 'header_textcolor', '111' ) ) . ';} 
			.embla-icon .icon {fill: ' . esc_attr( get_theme_mod( 'embla_icon_color', '#000' ) ) . ';}';

		if ( get_theme_mod( 'embla_accent_color' ) ) {
			echo 'a:hover, a:focus, a:active, .main-navigation a:hover, .main-navigation a:focus, .widget:not(.embla-recent-posts) a img:focus, 
			.widget:not(.embla-recent-posts) a img:hover, #mobile-menu-toggle:hover, #mobile-menu-toggle:focus{ color: ' . esc_attr( get_theme_mod( 'embla_accent_color' ) ) . ';} ';
			echo '.social-menu li a:focus .icon, .social-menu li a:hover .icon, #mobile-menu-toggle .icon:hover { fill: ' . esc_attr( get_theme_mod( 'embla_accent_color' ) ) . ';} ';
			echo '.has-post-thumbnail a:focus img.wp-post-image{outline:3px solid ' . esc_attr( get_theme_mod( 'embla_accent_color' ) ) . ';} ';

			if ( class_exists( 'WooCommerce' ) ) {
				echo '.woocommerce .woocommerce-breadcrumb a:hover, .woocommerce .woocommerce-breadcrumb a:focus { color: ' . esc_attr( get_theme_mod( 'embla_accent_color' ) ) . ';} ';
				echo '.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, 
				.woocommerce #respond input#submit.alt:focus, .woocommerce a.button.alt:focus, .woocommerce button.button.alt:focus, .woocommerce input.button.alt:focus {
					background: ' . esc_attr( get_theme_mod( 'embla_accent_color' ) ) . ';} ';
			}
		}
		/* Menu */
		if ( get_theme_mod( 'embla_hide_priority_menu' ) ) {
			echo '@media screen and (max-width: 1280px) {
				.main-navigation {
					padding-bottom: 3px;
				}	
				.main-navigation #main-menu {
					display: none;
				}';
			echo ' }';
		}

		if ( is_child_theme() === false && get_theme_mod( 'embla_body_font', 'Noto Serif, serif' ) !== 'Noto Serif, serif' ) {
			/* Fonts */
			echo 'html, body, button, input, select, textarea { font-family:' . esc_attr( get_theme_mod( 'embla_body_font', 'Noto Serif, serif' ) ) . ';}';
			echo '.site-title, site-title a{ font-family:' . esc_attr( get_theme_mod( 'embla_title_font', 'Noto Serif, serif' ) ) . ';}';
			echo '.site-description { font-family:' . esc_attr( get_theme_mod( 'embla_description_font', 'Noto Serif, serif' ) ) . ';}';
			echo '.entry-title, .entry-title a { font-family:' . esc_attr( get_theme_mod( 'embla_post_title_font', 'Noto Serif, serif' ) ) . ';}';
		}
		echo '</style>';
	}
	add_action( 'wp_head', 'embla_customize_css' );
}

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
 * Custom metabox for header options.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-icons.php';
require get_template_directory() . '/inc/class-customize.php';
require get_template_directory() . '/inc/customizer-fonts.php';

/**
 * SVG icons
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Load custom widget files.
 */
require get_template_directory() . '/inc/class-recent-posts-widget.php';
require get_template_directory() . '/inc/class-recent-comments-widget.php';

