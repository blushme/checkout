// 2020-06-09
// 1) "Handle the `+` / `-` buttons in the cart block of the checkout page":
// https://github.com/blushme/checkout/issues/7
// 2) The code is similar to https://github.com/blushme/site/blob/2020-06-09/app/code/Seavus/Categories/view/frontend/templates/sidebar/content.phtml#L51-L69
define([], function() {return function() {require(['jquery'], function($) {
	$(document).on('click', '.more, .less', function(){
		var obj = $(this);
		var $siblings = obj.siblings('.input-text');
		var current_qty = $siblings.attr('data-value');
		var update_button = '#button-' + $siblings.attr('id');
		var qty;
		if (obj.hasClass('more')) {
			qty = parseInt(current_qty) + parseInt(1);
		}
		else {
			qty = parseInt(current_qty) - parseInt(1);
		}
		$siblings.val(qty);
		$(update_button).click();
	});
});}});