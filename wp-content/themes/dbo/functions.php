<?php
/* Override parent theme's functions */
if ( ! function_exists( 'twentyeleven_setup' ) ):
	function twentyeleven_setup() {

		load_theme_textdomain( 'twentyeleven', get_template_directory() . '/languages' );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Load up our theme options page and related code.
		require( get_template_directory() . '/inc/theme-options.php' );

		// Grab Twenty Eleven's Ephemera widget.
		require( get_template_directory() . '/inc/widgets.php' );

		// Add default posts and comments RSS feed links to <head>.
		add_theme_support( 'automatic-feed-links' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );

		// Add support for a variety of post formats
		add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

		$theme_options = twentyeleven_get_theme_options();
		if ( 'dark' == $theme_options['color_scheme'] )
			$default_background_color = '1d1d1d';
		else
			$default_background_color = 'f1f1f1';

		// Add support for custom backgrounds.
		add_theme_support( 'custom-background', array(
			// Let WordPress know what our default background color is.
			// This is dependent on our current color scheme.
			'default-color' => $default_background_color,
		) );

		// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
		add_theme_support( 'post-thumbnails' );

		// Add support for custom headers.
		$custom_header_support = array(
			// The default header text color.
			'default-text-color' => '000',
			// The height and width of our custom header.
			'width' => apply_filters( 'twentyeleven_header_image_width', 1200 ),
			'height' => apply_filters( 'twentyeleven_header_image_height', 406 ),
			// Support flexible heights.
			'flex-height' => true,
			// Random image rotation by default.
			'random-default' => true,
			// Callback for styling the header.
			'wp-head-callback' => 'twentyeleven_header_style',
			// Callback for styling the header preview in the admin.
			'admin-head-callback' => 'twentyeleven_admin_header_style',
			// Callback used to display the header preview in the admin.
			'admin-preview-callback' => 'twentyeleven_admin_header_image',
		);
		
		add_theme_support( 'custom-header', $custom_header_support );

		if ( ! function_exists( 'get_custom_header' ) ) {
			// This is all for compatibility with versions of WordPress prior to 3.4.
			define( 'HEADER_TEXTCOLOR', $custom_header_support['default-text-color'] );
			define( 'HEADER_IMAGE', '' );
			define( 'HEADER_IMAGE_WIDTH', $custom_header_support['width'] );
			define( 'HEADER_IMAGE_HEIGHT', $custom_header_support['height'] );
			add_custom_image_header( $custom_header_support['wp-head-callback'], $custom_header_support['admin-head-callback'], $custom_header_support['admin-preview-callback'] );
			add_custom_background();
		}

		// We'll be using post thumbnails for custom header images on posts and pages.
		// We want them to be the size of the header image that we just defined
		// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
		set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );

		// Add Twenty Eleven's custom image sizes.
		// Used for large feature (header) images.
		add_image_size( 'large-feature', $custom_header_support['width'], $custom_header_support['height'], true );
		// Used for featured posts if a large-feature doesn't exist.
		add_image_size( 'small-feature', 500, 300 );

		// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
		register_default_headers( array(
			//DF:
			'header1' => array(
				'url' => 'http://d1s11jhccim4uj.cloudfront.net/wp-content/uploads/2013/01/header1.png',
				'thumbnail_url' => 'http://d1s11jhccim4uj.cloudfront.net/wp-content/uploads/2013/01/header1-thumbnail.png',
				'description' => __( 'Header 1', 'twentyeleven' )
			)
		) );
	}
endif; // twentyeleven_setup

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'm/d/Y' ) ),//DF:
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

