<?php
namespace BlushMe\Checkout\Block\Extra;
use Seavus\Products\Block\Product\View as PB;
/**
 * 2020-06-06
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
 * "Reimplement the «Aktuella erbjudanden» block": https://github.com/blushme/checkout/issues/6
 */
class Item extends \Magento\Framework\View\Element\Template {
	/**
	 * 2020-06-06
	 * @override
	 * @see \Magento\Framework\View\Element\Template::getTemplate()
	 * @used-by \Magento\Framework\View\Element\Template::_toHtml()
	 * @used-by \Magento\Framework\View\Element\Template::fetchView()
	 * @used-by \Magento\Framework\View\Element\Template::getCacheKeyInfo()
	 * @used-by \Magento\Framework\View\Element\Template::getTemplateFile()
	 * @return string
	 */
	function getTemplate() {return df_asset_name('extra/item.phtml');}

	/**
	 * 2020-06-05
	 * @used-by vendor/blushme/checkout/view/frontend/templates/extra-sell.phtml
	 * @param string $n
	 * @param mixed $v
	 * @return string
	 */
	function hidden($n, $v) {return df_tag('input', ['name' => $n, 'type' => 'hidden', 'value' => $v]);}

	/**
	 * 2020-06-05
	 * @param string $t
	 * @param array(string => mixed) $d [optional]
	 * @return string
	 */
	function part($t, $d = []) {return df_block(
		PB::class, $d + ['product' => $this['p']], "Seavus_Products::product/view/$t"
	)->toHtml();}
}