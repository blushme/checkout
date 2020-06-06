<?php
namespace BlushMe\Checkout\Block;
use Magento\Catalog\Model\Product as P;
use Magento\Catalog\Model\Product\Visibility as V;
use Magento\Catalog\Model\ResourceModel\Product\Collection as PC;
use Seavus\Products\Block\Product\View as ProductB;
/**
 * 2020-06-04
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
 * "Reimplement the «Aktuella erbjudanden» block": https://github.com/blushme/checkout/issues/6
 * I have ported the code from here: https://github.com/blushme/site/blob/2020-04-28-before-Klarna-upgrade/app/code/Seavus/Klarna/Block/Checkout/Extrasell.php
 */
class ExtraSell extends \Magento\Catalog\Block\Product\AbstractProduct {
	/**
	 * 2020-06-05
	 * @see \Magento\Framework\View\Element\Template::getCacheKeyInfo()
	 * @used-by \Magento\Framework\View\Element\AbstractBlock::getCacheKey()
	 * @return string[]
	 */
	function getCacheKeyInfo() {return array_merge($this->skus(), parent::getCacheKeyInfo());}

	/**
	 * 2020-06-05
	 * @override
	 * @see \Magento\Framework\View\Element\Template::getTemplate()
	 * @used-by \Magento\Framework\View\Element\Template::_toHtml()
	 * @used-by \Magento\Framework\View\Element\Template::fetchView()
	 * @used-by \Magento\Framework\View\Element\Template::getCacheKeyInfo()
	 * @used-by \Magento\Framework\View\Element\Template::getTemplateFile()
	 * @return string
	 */
	function getTemplate() {return df_asset_name('extra-sell.phtml');}

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
	 * @used-by vendor/blushme/checkout/view/frontend/templates/extra-sell.phtml
	 * @return PC
	 */
	function items() {return dfc($this, function() {
		$r = df_product_c(); /** @var PC $r */
		$r->addAttributeToSelect('*');
		$r->addAttributeToFilter('sku', ['in' => $this->skus()]);
		$r->setVisibility([V::VISIBILITY_BOTH, V::VISIBILITY_IN_CATALOG, V::VISIBILITY_IN_SEARCH]);
		df_stock_h()->addIsInStockFilterToCollection($r);
		return $r;
	});}

	/**
	 * @param P $p
	 * @param string $template
	 * @param array(string => mixed) $d [optional]
	 * @return string
	 */
	function part(P $p, $template, $d = []) {return df_block(
		ProductB::class, $d + ['product' => $p], "Seavus_Products::product/view/$template"
	)->toHtml();}

	/**
	 * 2020-06-05
	 * @used-by getCacheKeyInfo()
	 * @used-by items()
	 * @return string[]
	 */
	private function skus() {return dfc($this, function() {return df_csv_parse(df_cfg(
		'klarna/settings/extra_sell_products'
	));});}
}