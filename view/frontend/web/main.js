// 2020-06-09
define([], function() {return function() {require(['jquery', 'domReady!'], function($) {
	$(document).on('click', '.more, .less', function() {
		var $this = $(this);
		var $siblings;
		if ($this.closest('#minicart-content-wrapper').length) {
			// 2020-06-08
			// "The `+` and `-` buttons initialization
			// by the `app/code/Seavus/Categories/view/frontend/templates/sidebar/content.phtml` file
			// should not affect the checkout page": https://github.com/blushme/site/issues/76
			// 2020-06-09
			// This code handles the mini-cart.
			// Similar buttons on the checkout page's main area are handled by the code:
			// https://github.com/blushme/checkout/blob/0.0.6/view/frontend/web/main.js
			// The mini-cart exists on the checkout page too, so we need to differentiate the both cases.
			$siblings = $this.siblings('.cart-item-qty');
			var newAdd = parseInt($siblings.val()) + ($this.hasClass('more') ? 1 : -1);
			$siblings.val(newAdd);
			$siblings.attr('data-item-qty', newAdd);
			$('#update-cart-item-' + $this.siblings('.update-cart-item').attr('data-cart-item')).click();
		}
		else if ($this.closest('#shopping-cart-table').length) {
			// 2020-06-09
			// "Handle the `+` / `-` buttons in the cart block of the checkout page":
			// https://github.com/blushme/checkout/issues/7
			$siblings = $this.siblings('.input-text');
			$siblings.val(parseInt($siblings.data('value')) + ($this.hasClass('more') ? 1 : -1));
			$('#button-' + $siblings.attr('id')).click();
		}
	});
});}});