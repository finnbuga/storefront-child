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


/**
 * Check the Terms & Conditions checkbox by default on the checkout form.
 */
function storefront_child_woocommerce_check_terms_by_default() {
	return true;
}
add_filter( 'woocommerce_terms_is_checked_default', 'storefront_child_woocommerce_check_terms_by_default' );


/**
 * Shorten the shipping line to contain only the cost.
 * Remove the name of the shipping. E.g. "Fast delivery".
 */
function storefront_child_woocommerce_shorten_shipping_line( $label, $method ) {
	return wc_price( $method->cost );
}
add_filter( 'woocommerce_cart_shipping_method_full_label', 'storefront_child_woocommerce_shorten_shipping_line', 10, 2 );


/**
 * Customise homepage.
 */
function storefront_child_woocommerce_customise_homepage() {
	remove_action( 'homepage', storefront_homepage_content, 10);
	remove_action( 'homepage', storefront_product_categories, 20);
	remove_action( 'homepage', storefront_recent_products, 30);
	remove_action( 'homepage', storefront_popular_products, 50);
}
add_action( 'init', 'storefront_child_woocommerce_customise_homepage' );
