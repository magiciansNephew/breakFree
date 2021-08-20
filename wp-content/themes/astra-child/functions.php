<?php

/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0');

/**
 * Include Files
 */

include('custom-shortcodes.php');

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{

	wp_enqueue_style('astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all');
}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);


function astra_post_author()
{
	ob_start();
?>
	<div class="author">

		<?php echo get_avatar(get_the_author_meta("ID")) ?>
		<span class="author-name"><?php the_author() ?></span>
	</div>
<?php
	return ob_get_clean();
}

/** 
 * removing "by" text in post author details
 */

add_filter('astra_default_strings', 'wpd_astra_default_strings');
function wpd_astra_default_strings($strings)
{
	$strings['string-blog-meta-author-by'] = '';

	return $strings;
}
