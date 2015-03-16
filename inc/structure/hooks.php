<?php
/**
 * Hooks
 */

/**
 * Stylesheets and scripts
 */
add_action( 'wp_enqueue_scripts', 'storefront_child_load_styles_and_scripts', 30 );

/**
 * Menus
 */
add_action( 'init', 'storefront_child_register_menus' );

/**
 * Breadcrumb
 */
add_action( 'init', 'storefront_child_remove_breadcrumb' );

/**
 * Footer
 */
add_action( 'wp_footer', 'storefront_child_facebook_script' );
add_action( 'wp_footer', 'storefront_child_embed_live_chat' );

/**
 * Backend
 */
add_filter( 'storefront_customizer_enabled', 'storefront_child_disable_customizer');
