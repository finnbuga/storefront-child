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
 * Remove header elements.
 */
function storefront_child_remove_header() {
	remove_action( 'storefront_header', 'storefront_social_icons', 10 );
	remove_action( 'storefront_header', 'storefront_site_branding', 20 );
	remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
	remove_action( 'storefront_header', 'storefront_product_search', 40 );
	remove_action( 'storefront_header', 'storefront_primary_navigation', 50 );
	remove_action( 'storefront_header', 'storefront_header_cart', 60 );
}
add_action( 'init', 'storefront_child_remove_header' );


/**
 * Header region.
 */
function storefront_child_header() {
?>
	<div id="top-zone-wrapper">
		<div class="col-full">
			<div class="top-message">Livrare prin curier cu plata ramburs</div>
			<div class="top-menu">
				<ul class="menu">
					<li><a href="<?php bloginfo('url'); ?>/contact" title="Contact">Contact</a></li>
					<?php if ( $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' ) ) : ?>
					<li><a href="<?php echo get_permalink( $myaccount_page_id ); ?>">Account</a></li>
					<?php endif; ?>                    
					<li><a class="cart" href="<?php global $woocommerce; echo $woocommerce->cart->get_cart_url(); ?>"><?php printf( __( 'Cosul meu (%s)'), $woocommerce->cart->cart_contents_count ); ?></a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div id="logo-zone-wrapper">
		<a href='<?php echo home_url( '/' ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
			<img class="logo" src="<?php print(get_stylesheet_directory_uri() . '/img/logo.png'); ?>">
		</a>
	</div>
	
	<div id="brand-zone-wrapper">
		<div class="col-full">
			<nav id="site-navigation" class="main-nav" role="navigation">
			<button class="menu-toggle"><?php apply_filters( 'storefront_menu_toggle_text', $content = _e( 'Primary Menu', 'storefront' ) ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
			
			<nav class="secondary-nav" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'fallback_cb' => '' ) ); ?>
			</nav><!-- #site-navigation -->
			<?php if (is_front_page()) : ?>
				<img class="banner" src="<?php echo get_stylesheet_directory_uri(); ?>/img/banner.png" />
			<?php endif; ?>
		</div>
	</div>
<?php
}
add_action( 'storefront_header', 'storefront_child_header' );


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
