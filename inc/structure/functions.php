<?php
/**
 * Custom functions calld in hooks.php
 */

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


/**
 * Add Mobile menu.
 */
function storefront_child_register_menus() {
  register_nav_menus(
    array(  
    	'mobile_menu' => __( 'Mobile Menu' )
    )
  );
} 


/**
 * Script for Facebook.
 */
function storefront_child_facebook_script() {
?>
<!--Include Facebook JavaScript SDK-->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=272175299467751&version=v2.0";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<!--end Facebook-->
<?php
}


/**
 * Embed script for Zopim Live Chat.
 */
function storefront_child_embed_live_chat() {
?>
<!--Enable Zopim on desktops-->
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
<!--end Zopim-->
<?php
}


/**
 * Disable customizer.
 */
function storefront_child_disable_customizer() {
	return false;
}
