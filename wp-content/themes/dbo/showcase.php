<?php
/**
 * Template Name: Showcase Template
 * Description: A Page Template that showcases Sticky Posts, Asides, and Blog Posts
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

// Enqueue showcase script for the slider
//wp_enqueue_script( 'twentyeleven-showcase', get_template_directory_uri() . '/js/showcase.js', array( 'jquery' ), '2011-04-28' );
wp_enqueue_script('nivoslider',get_stylesheet_directory_uri().'/js/nivo-slider/jquery.nivo.slider.pack.js',array('jquery'));

wp_enqueue_script(
	'dbo-custom',
	get_stylesheet_directory_uri() . '/js/dbo_custom.js',
	array()
);


get_header(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/js/nivo-slider/nivo-slider.css" type="text/css" media="screen" />

		<div id="primary" class="showcase">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/**
					 * We are using a heading by rendering the_content
					 * If we have content for this page, let's display it.
					 */
					if ( '' != get_the_content() )
						get_template_part( 'content', 'intro' );
				?>

				<?php endwhile; ?>

				

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>