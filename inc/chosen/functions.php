<?php
/**
 * Custom Chosen specific functions calld in hooks.php
 */

/**
 * Load stylesheets and scripts.
 */
function storefront_child_chosen_load_styles_and_scripts() {
	// Load vendor styles and script.
	wp_enqueue_style(  'chosen',                  get_stylesheet_directory_uri() . '/inc/chosen/vendor/chosen/chosen.css' );
	wp_enqueue_script( 'chosen',                  get_stylesheet_directory_uri() . '/inc/chosen/vendor/chosen/chosen.jquery.js', array( 'jquery' ) );

	// Load styles and script specific to this theme.
	wp_enqueue_style(  'storefront-child-chosen', get_stylesheet_directory_uri() . '/inc/chosen/chosen.css', array( 'chosen' ) );
	wp_enqueue_script( 'storefront-child-chosen', get_stylesheet_directory_uri() . '/inc/chosen/chosen.js', array( 'chosen' ) );
}
