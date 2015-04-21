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

	/*
	 * Convert select options into links
	 * for product variations.
	 */	
	/*$('form.variations_form select').each(function(i, select){
	    var select = $( "#pa_masuri" );
	    select.find( 'option' ).each(function(j, option){
	        var option = $( option );
	        
	        if ( option.val() == '' ) {
		        return;
	        }
	        
	        // Create a link
			link = $('<a>',{
			    text: option.val(),
			    href: '#',
			    class: option.attr('selected') ? 'selected' : '',
			    click: function(){
					$( "option[value=" + option.val() + "]" ).prop( "selected", true );
					return false;
				}
			});
			
	        select.before( link );
	    });
	});*/
});

