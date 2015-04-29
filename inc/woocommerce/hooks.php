<?php
/**
 * WooCommerce hooks
 */

/**
 * Stylesheets & Scripts
 */
add_action( 'wp_enqueue_scripts', 'storefront_child_woocommerce_load_styles_and_scripts', 30 );

/**
 * Sidebar
 */
add_action( 'storefront_sidebar', 'storefront_child_disable_sidebar', 1 );

/**
 * Homepage
 */
add_action( 'init', 'storefront_child_woocommerce_customise_homepage' );

/**
 * Products
 */
add_filter( 'loop_shop_per_page', 'storefront_child_woocommerce_change_products_per_page', 20 );

/**
 * Product page
 */
remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_title', 5 );
add_action(    'woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 100 );

remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_price', 10 );
add_action(    'woocommerce_after_single_product_summary',  'woocommerce_template_single_price', 5 );

remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_add_to_cart', 30 );
add_action(    'woocommerce_after_single_product_summary',  'woocommerce_template_single_add_to_cart', 10 );

remove_action( 'woocommerce_after_single_product_summary',  'woocommerce_output_product_data_tabs', 10 );

add_action(    'woocommerce_product_meta_end',              'storefront_child_display_custom_taxonomies', 40 );

add_action(    'woocommerce_after_single_product_summary',  'storefront_child_product_info_notes', 6 );
add_action(    'woocommerce_after_single_product_summary',  'storefront_child_product_availability', 7 );
add_action(    'woocommerce_after_single_product_summary',  'storefront_child_product_contact', 8 );

/**
 * Cart & Checkout
 */
add_filter( 'woocommerce_default_address_fields', 'storefront_child_woocommerce_make_postcode_optional' );
add_filter( 'woocommerce_cart_shipping_method_full_label', 'storefront_child_woocommerce_shorten_shipping_line', 10, 2 );
