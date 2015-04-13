<?php
/**
 * Custom WooCommerce specific functions calld in hooks.php
 */

/**
 * Load stylesheets and scripts.
 */
function storefront_child_woocommerce_load_styles_and_scripts() {
	wp_enqueue_style(  'storefront-child-woocommerce', get_stylesheet_directory_uri() . '/inc/woocommerce/woocommerce.css' );
	wp_enqueue_script( 'storefront-child-woocommerce', get_stylesheet_directory_uri() . '/inc/woocommerce/woocommerce.js', array( 'jquery' ), '20150327', true );
}


/**
 * Disable sidebar if not product listing page.
 */
function storefront_child_disable_sidebar() {
	if ( is_post_type_archive( 'product' ) || is_tax( 'colectii' ) || is_tax( 'product_cat' ) ) {
		return;
	}
	remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
}


/**
 * Customise homepage.
 */
function storefront_child_woocommerce_customise_homepage() {
	remove_action( 'homepage', storefront_homepage_content, 10);
	remove_action( 'homepage', storefront_product_categories, 20);
	remove_action( 'homepage', storefront_recent_products, 30);
	remove_action( 'homepage', storefront_popular_products, 50);
}


/**
 * Override theme default for products per page.
 */
function storefront_child_woocommerce_change_products_per_page() {
	return 24;
}


/**
 * Display custom taxonomies' terms.
 */
function storefront_child_display_custom_taxonomies() {
	global $post;
	
	$custom_taxonomies = array( 'colectii' , 'stil', 'dimensiuni', 'materiale', 'sistem de inchidere', 
			'accesorii', 'culori', 'origine', 'metoda de fabricatie', 'instructiuni de intretinere' );
	
	if ( $term_list = get_the_term_list( $post->ID, 'atentionari', '', ', ', '' ) ) {
		?>
		<div class="atentionari">
			<span><?php echo strip_tags( $term_list ); ?></span>
		</div>
		<?php
	}
	
	?>
	<ul class="custom_taxonomies">
	<?php 
		foreach ($custom_taxonomies as $taxonomy) {
			if ( $term_list = get_the_term_list( $post->ID, $taxonomy, '', ', ', '' ) ) {
				?>
				<li>
					<label><?php echo ucfirst( $taxonomy ); ?>: </label>
					<span><?php echo $taxonomy == 'colectii' ? $term_list : strip_tags( $term_list ); ?></span>
				</li>
				<?php
			}
		}
	?>
	</ul>
	<?php
}


/**
 * Display product info notes.
 */
function storefront_child_product_info_notes() {
	?>
	<div class="info-notes">
		<div class="delivery">Livrare prin curier 13 lei</div>
		<div class="payment">Plata Ramburs</div>
		<div class="return">Retur gratuit</div>
	</div>
	<?php
}


/**
 * Display product availability.
 */
function storefront_child_product_availability() {
	global $post;
	if ( $term_list = get_the_term_list( $post->ID, 'disponibilitate', '', ', ', '' ) ) {
		?>
		<div class="disponibilitate">
			<span><?php echo strip_tags( $term_list ); ?></span>
		</div>
		<?php
	}
}


/**
 * Display contact details.
 */
function storefront_child_product_contact() {
	?>
	<p class="contact">
	Ai intrebari? Suna-ne! - 0726 401 154<br />
	Luni - Duminica 09:00 - 21:00
	</p>
	<?php
}


/**
 * Make the postcode not mandatory on the checkout form.
 */
function storefront_child_woocommerce_make_postcode_optional( $address_fields ) {
	$address_fields['postcode']['required'] = 0;
	return $address_fields;
}


/**
 * Check the Terms & Conditions checkbox by default on the checkout form.
 */
function storefront_child_woocommerce_check_terms_by_default() {
	return true;
}


/**
 * Shorten the shipping line to contain only the cost.
 * Remove the name of the shipping. E.g. "Fast delivery".
 */
function storefront_child_woocommerce_shorten_shipping_line( $label, $method ) {
	return wc_price( $method->cost );
}
