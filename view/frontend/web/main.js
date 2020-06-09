// 2020-06-09
// 1) "Handle the `+` / `-` buttons in the cart block of the checkout page":
// https://github.com/blushme/checkout/issues/7
// 2) The code is similar to https://github.com/blushme/site/blob/2020-06-09/app/code/Seavus/Categories/view/frontend/templates/sidebar/content.phtml#L51-L69
define([], function() {return function() {require(['jquery', 'domReady!'], function($) {
	$(document).on('click', '.more, .less', function() {
		var $this = $(this);
		var $siblings = $this.siblings('.input-text');
		$siblings.val(parseInt($siblings.data('value')) + ($this.hasClass('more') ? 1 : -1));
		$('#button-' + $siblings.attr('id')).click();
	});
});}});