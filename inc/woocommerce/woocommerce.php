<?php

/**
 * Load stylesheet.
 */
function storefront_child_woocommerce_load_styles() {
	wp_enqueue_style(  'storefront-child-woocommerce', get_stylesheet_directory_uri() . '/inc/woocommerce/woocommerce.css' );
}
add_action( 'wp_enqueue_scripts', 'storefront_child_woocommerce_load_styles', 30 );


/**
 * Make the postcode not mandatory on the checkout form.
 */
function storefront_child_woocommerce_make_postcode_optional( $address_fields ) {
	$address_fields['postcode']['required'] = 0;
	return $address_fields;
}
add_filter( 'woocommerce_default_address_fields', 'storefront_child_woocommerce_make_postcode_optional' );
