<?php
/**
 * Storefront Child theme functions.php file.
 *
 * @package storefront-child
 */


/**
 * Load parent theme stylesheets.
 */
function enqueue_parent_theme_style() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() .    '/style.css' );
	wp_enqueue_style( 'chosen',       get_stylesheet_directory_uri()  . '/inc/chosen/chosen.css' );
	wp_enqueue_script( 'chosen',      get_stylesheet_directory_uri() .  '/inc/chosen/chosen.jquery.js', array( 'jquery' ) );
	wp_enqueue_script( 'theme',       get_stylesheet_directory_uri() .  '/script.js',  array( 'chosen' ) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );


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
}
add_action( 'init', 'storefront_child_reorder_product_page' );


/**
 * Display terms for a give taxonomy.
 */
function storefront_child_display_terms($taxonomy) {
	global $post;
	
	if ( $terms_as_text = get_the_term_list( $post->ID, $taxonomy, '', ', ', '' ) ) {
	?>
		<div class="term <?php echo $taxonomy; ?>">
			<label><?php echo ucfirst( $taxonomy ); ?>: </label>
			<span><?php echo strip_tags( $terms_as_text ); ?></span>
		</div>
	<?php
	}
}


/**
 * Display custom taxonomies' terms.
 */
function storefront_child_display_custom_taxonomies() {
	storefront_child_display_terms('atentionari');
	
	$custom_taxonomies = array( 'colectii' , 'stil', 'dimensiuni', 'materiale', 'sistem de inchidere', 'accesorii', 'culori', 'origine', 'metoda de fabricatie', 'instructiuni de intretinere' );
	
	foreach ($custom_taxonomies as $taxonomy) {
		storefront_child_display_terms($taxonomy);
	}
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