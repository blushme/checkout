<?php
namespace BlushMe\Checkout\Block\Extra;
use Magento\Catalog\Model\Product as P;
use Seavus\Products\Block\Product\View as ProductB;
/**
 * 2020-06-06
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
 * "Reimplement the «Aktuella erbjudanden» block": https://github.com/blushme/checkout/issues/6
 */
class Item extends \Magento\Catalog\Block\Product\AbstractProduct {
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
	 * @param string $name
	 * @param mixed $value
	 * @return string
	 */
	function hidden($name, $value) {return df_tag('input', ['name' => $name, 'type' => 'hidden', 'value' => $value]);}

	/**
	 * 2020-06-05
	 * @param string $template
	 * @param array(string => mixed) $d [optional]
	 * @return string
	 */
	function part($template, $d = []) {return df_block(
		ProductB::class, $d + ['product' => $this['p']], "Seavus_Products::product/view/$template"
	)->toHtml();}
}