<?php

/**
 * Load stylesheet.
 */
function storefront_child_woocommerce_load_styles() {
	wp_enqueue_style(  'storefront-child-woocommerce', get_stylesheet_directory_uri() . '/inc/woocommerce/woocommerce.css' );
}
add_action( 'wp_enqueue_scripts', 'storefront_child_woocommerce_load_styles', 30 );
