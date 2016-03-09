<?php

// Metaboxes
require_once( get_template_directory().'/components/metaboxes/metaboxes.php');

add_theme_support('post-thumbnails');
add_theme_support( 'automatic-feed-links' );

// Register custom post types
add_action('init', 'mc_init');
function mc_init() {
	global $global_theme_options;
	register_post_type(
		'mc_portfolio',
		array(
			'labels' => array(
				'name' => 'Portfolio',
				'singular_name' => 'Portfolio'
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array('title', 'editor', 'thumbnail','comments'),
			'can_export' => true,
		)
	);

	register_taxonomy('portfolio_category', 'mc_portfolio', array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true));

}

?>