<?php

function gsd_wordpress_scripts() {

// Example style enqueue:
// 	wp_enqueue_style('gsd_reset', get_template_directory_uri() . '/assets/css/reset.css', false, null);
	
// Example script enqueue: (dependencies, version, load in footer)
//	wp_register_script( 'script-name', get_template_directory_uri() . '/assets/js/script-name.js', false, null, true);
//	wp_enqueue_script( 'script-name' );

// STYLES
	// 1
	wp_enqueue_style('gsd_reset', get_template_directory_uri() . '/assets/css/reset.css', false, null);
	// 2
	wp_enqueue_style('gsd_style', get_template_directory_uri() . '/assets/css/system.css', false, null);
	// 3
	wp_enqueue_style('gsd_respd', get_template_directory_uri() . '/assets/css/respond.css', array('gsd_style'), null);

// SCRIPTS
	// 1
	wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr-1.6.min.js', false, null, false);
	wp_enqueue_script( 'modernizr' );
	// 2
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js', false, null, true);
	wp_enqueue_script( 'jquery' );
	// 3
	wp_register_script( 'cookie-law', get_template_directory_uri() . '/assets/js/easy.notification.min.js', false, null, true);
	wp_enqueue_script( 'cookie-law' );
	// 4
	wp_register_script( 'script', get_template_directory_uri() . '/assets/js/script.js', false, null, true);
	wp_enqueue_script( 'script' ); 
}
add_action('wp_enqueue_scripts', 'gsd_wordpress_scripts', 100);
