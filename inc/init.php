<?php
/**
 * Initialise the included modules.
 */

/**
 * Include default customizations for a standard Wordpress install
 */
require get_stylesheet_directory() . '/inc/structure/functions.php';
require get_stylesheet_directory() . '/inc/structure/function_exists.php';
require get_stylesheet_directory() . '/inc/structure/hooks.php';

/**
 * Include Woocommerce customizations.
 */
require get_stylesheet_directory() . '/inc/woocommerce/functions.php';
require get_stylesheet_directory() . '/inc/woocommerce/function_exists.php';
require get_stylesheet_directory() . '/inc/woocommerce/hooks.php';

/**
 * Include the Chosen jQuery library for beatiful select boxes.
 */
require get_stylesheet_directory() . '/inc/chosen/functions.php';
require get_stylesheet_directory() . '/inc/chosen/hooks.php';
