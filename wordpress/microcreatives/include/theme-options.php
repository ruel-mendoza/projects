<?php

function mc_theme_options_init() {

	register_setting(
		'mc_options',       // Options group, see settings_fields() call in twentyeleven_theme_options_render_page()
		'mc_theme_options', // Database option, see twentyeleven_get_theme_options()
		'mc_theme_options_validate' // The sanitization callback, see twentyeleven_theme_options_validate()
	);
	
}

add_action( 'admin_init', 'mc_theme_options_init' );

?>