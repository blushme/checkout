// 2020-06-02
// 1) "The checkout page should show the order totals with the taxes but without the shipping rate":
// https://github.com/blushme/site/issues/74
// 2) I have implemented it by analogy with:
// 2.1) https://github.com/magento/magento2/blob/2.3.5-p1/app/code/Magento/Checkout/view/frontend/web/js/view/summary/grand-total.js#L1-L40
// 2.2) https://github.com/magento/magento2/blob/2.3.5-p1/app/code/Magento/Checkout/view/frontend/web/js/view/summary/subtotal.js#L1-L40
define([
    'df-lodash'
	,'Magento_Checkout/js/view/summary/abstract-total'
    ,'Magento_Checkout/js/model/quote'
], function (_, Component, quote) {
	'use strict';
	return Component.extend({
        // 2020-06-02 I use the `grand-total` template because I want to emphasize the value.
		defaults: {template: 'Magento_Checkout/cart/totals/grand-total'},

		/**
         * 2020-06-02
         * @used-by getValue()
		 * @return {*}
		 */
		getPureValue: function() {return _.get(
            /**
             * 2020-06-02
             * `quote.getTotals()()['grand_total']` contains a value without taxes for an unknown reason,
             * at the same time `quote.getTotals()()['base)grand_total']` contains the value with the taxes:
			 * 	{
			 *		"base_grand_total": "426.0000",
			 *		"grand_total": 340.8,
			 *		…
			 *		"total_segments": [
			 *			…,
			 *			{
			 *				"code": "grand_total",
			 *				"value": "426.0000",
			 *				…
			 *			}
			 *		],
			 *		…
			 *	}
             */
		    _.find(_.get(quote.getTotals()(), 'total_segments', []), ['code', 'grand_total'])
            ,'value'
            ,quote['grand_total']
        );},

		/**
         * 2020-06-02
		 * @return {*|String}
		 */
		getValue: function () {return this.getFormattedPrice(this.getPureValue());}
	});
});