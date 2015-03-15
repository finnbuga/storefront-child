<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php storefront_html_tag_schema(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'storefront' ); ?></a>

	<?php
	do_action( 'storefront_before_header' ); ?>

	<header id="masthead" class="site-header" role="banner" <?php if ( get_header_image() != '' ) { echo 'style="background-image: url(' . esc_url( get_header_image() ) . ');"'; } ?>>

		<div class="style col-full">
	
			<?php /**** Top Message ****/ ?>		
			<div class="top-message">
				Livrare prin curier cu plata ramburs
			</div>
	
			<?php /**** Top Menu ****/ ?>
			<ul class="top-menu menu">
				<li><a href="<?php bloginfo('url'); ?>/contact" title="Contact">Contact</a></li>
				<li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a></li>
				<li><a class="cart" href="<?php global $woocommerce; echo $woocommerce->cart->get_cart_url(); ?>"><?php printf( __( 'Cosul meu (%s)'), $woocommerce->cart->cart_contents_count ); ?></a></li>
			</ul>
	
			<?php /**** Logo ****/ ?>
			<div class="logo">
				<a href='<?php echo home_url( '/' ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
					<img src="<?php print(get_stylesheet_directory_uri() . '/img/logo.png'); ?>" width="293" height="93" alt="La Muse Chic">
				</a>
			</div>
			
		</div>
		
		<div class="style brand">
			<div class="style col-full">
				
				<?php /**** Main Navigation ****/ ?>
				<button class="menu-toggle"><?php apply_filters( 'storefront_menu_toggle_text', $content = _e( 'Primary Menu', 'storefront' ) ); ?></button>
				<nav class="main-nav" role="navigation">
					<?php wp_nav_menu( array(
						'theme_location'  => 'primary',
						'container'       => false ) ); ?>
				</nav>
				
				<?php /**** Secondary Navigation ****/ ?>
				<nav class="secondary-nav" role="navigation">
					<?php wp_nav_menu( array(
						'theme_location' => 'secondary',
						'container'       => false,
						'fallback_cb' => '' ) ); ?>
				</nav>
				
				<?php /**** Banner ****/ ?>
				<?php if (is_front_page()) : ?>
					<div class="banner">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banner.png" width="1140" height="500" alt="tanara domnisoara cu pantofi, poseta si pisic conduce o masina">
					</div>
				<?php endif; ?>
	
			</div>
		</div>

	</header><!-- #masthead -->

	<?php
	/**
	 * @hooked storefront_header_widget_region - 10
	 */
	do_action( 'storefront_before_content' ); ?>

	<div id="content" class="site-content">
		<div class="col-full">

		<?php
		/**
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'storefront_content_top' ); ?>
