<?php
/**
 * Storefront Child theme functions.php file.
 *
 * @package storefront-child
 */


/**
 * Initialize the included modules.
 */
require get_stylesheet_directory() . '/inc/init.php';


/**
 * Load stylesheets and scripts.
 */
function storefront_child_load_styles_and_scripts() {
	// Parent stylesheet
	wp_enqueue_style( 'parent-style', get_template_directory_uri() .    '/style.css' );

	// This theme's stylesheet. Readd it so it's the last to load.
	wp_dequeue_style( 'storefront-style' );
	wp_enqueue_style( 'storefront-child', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'storefront_child_load_styles_and_scripts', 30 );


/**
 * Get the product thumbnail for the loop.
 */
function woocommerce_template_loop_product_thumbnail() {
	echo '<figure>' . woocommerce_get_product_thumbnail() . '</figure>';
}


/**
 * Disable customizer.
 */
function storefront_child_disable_customizer() {
	return false;
}
add_filter( 'storefront_customizer_enabled', 'storefront_child_disable_customizer');


/**
 * Disable sidebar if not product listing page.
 */
function storefront_child_disable_sidebar() {
	if ( is_post_type_archive( 'product' ) || is_tax( 'colectii' ) || is_tax( 'product_cat' ) ) {
		return;
	}
	remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
}
add_action( 'storefront_sidebar', 'storefront_child_disable_sidebar', 1 );


/**
 * Display legal links instead of theme credit
 */
function storefront_credit() {
?>
	<div class="legal">
		<a target="_blank" href="http://www.anpc.gov.ro/">ANPC</a> |
		<a href="/termeni/">Termeni si conditii</a> | 
		<a href="/date-personale/">Protectia datelor personale</a> | 
		<?php echo ' &copy; ' . date("Y") . ' ' . get_bloginfo('name') . '. '; ?>
	</div>
<?php
}


/**
 * Reorder product page elements.
 */
function storefront_child_reorder_product_page() {
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
}
add_action( 'init', 'storefront_child_reorder_product_page' );


/**
 * Display custom taxonomies' terms.
 */
function storefront_child_display_custom_taxonomies() {
	include 'templates/custom_taxonomies.php';
}


/**
 * Display product info notes.
 */
function storefront_child_product_info_notes() {
	include 'templates/product_info_notes.php';
}


/**
 * Display product availability.
 */
function storefront_child_product_availability() {
	include 'templates/product_availability.php';
}


/**
 * Display product availability.
 */
function storefront_child_product_contact() {
	include 'templates/product_contact.php';
}


/**
 * Remove breadcrumb.
 */
function storefront_child_remove_breadcrumb() {
	remove_action( 'storefront_content_top', 'woocommerce_breadcrumb' );
}
add_action( 'init', 'storefront_child_remove_breadcrumb' );


/**
 * Script for Facebook.
 */
function storefront_child_facebook_script() {
?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=272175299467751&version=v2.0";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<?php
}
add_action( 'wp_footer', 'storefront_child_facebook_script' );


/**
 * Script for Zopim Live Chat.
 */
function storefront_child_live_chat_script() {
?>
	<script type="text/javascript">
		var ua = navigator.userAgent.toLowerCase(),
		platform = navigator.platform.toLowerCase();
		platformName = ua.match(/ip(?:ad|od|hone)/) ? 'ios' : (ua.match(/(?:webos|android)/) || platform.match(/mac|win|linux/) || ['other'])[0],
		isMobile = /ios|android|webos/.test(platformName);
		
		if (!isMobile) {
			<!--Start of Zopim Live Chat Script-->
			window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
			d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
			_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
			$.src='//v2.zopim.com/?2E9VTUCv7rtCfRQtkx8KGfGI4Xp2GWmo';z.t=+new Date;$.
			type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
			<!--End of Zopim Live Chat Script-->	
		}
	</script>
<?php
}
add_action( 'wp_footer', 'storefront_child_live_chat_script' );
