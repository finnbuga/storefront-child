<?php
/**
 * Functions called from outside this theme.
 */

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
