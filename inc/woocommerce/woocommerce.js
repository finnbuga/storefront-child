jQuery(document).ready(function($) {

	/*
	 * Show the update cart button only when and where necessary:
	 *
	 * Show it only when modifying the quantity.
	 * Show it right after the modified quantity.
	 */
	$( ".cart input.qty" ).focus(function() {
		update_button = $( ".cart input[name='update_cart']" );
		update_button.val("OK");
		$( this ).after( update_button );
	});

	/*
	 * Show the apply coupon button only when needed:
	 *
	 * Show it when typing the coupon code.
	 */	
	$( ".cart input[name='coupon_code']" ).keypress(function() {
		$( ".cart input[name='apply_coupon']" ).show();
	});
});

