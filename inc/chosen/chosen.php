<?php

/**
 * Load stylesheets and scripts.
 */
function storefront_child_chosen_load_styles_and_scripts() {
	wp_enqueue_style(  'chosen',                  get_stylesheet_directory_uri() . '/inc/chosen/vendor/chosen/chosen.css' );
	wp_enqueue_script( 'chosen',                  get_stylesheet_directory_uri() . '/inc/chosen/vendor/chosen/chosen.jquery.js', array( 'jquery' ) );
	wp_enqueue_script( 'storefront-child-chosen', get_stylesheet_directory_uri() . '/inc/chosen/chosen.js', array( 'chosen' ) );
}
add_action( 'wp_enqueue_scripts', 'storefront_child_chosen_load_styles_and_scripts' );
