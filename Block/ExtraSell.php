<?php
namespace BlushMe\Checkout\Block;
// 2020-06-04
// "Reimplement the «Aktuella erbjudanden» block": https://github.com/blushme/checkout/issues/6
// I have ported the code from here:
// https://github.com/blushme/site/blob/2020-04-28-before-Klarna-upgrade/app/code/Seavus/Klarna/Block/Checkout/Extrasell.php
class ExtraSell extends \Magento\Catalog\Block\Product\AbstractProduct {
	function __construct(
		\Magento\Catalog\Block\Product\Context $context,
		\Magento\Catalog\Model\ProductRepository $productRepository,
		\Magento\Framework\App\ResourceConnection $resourceConnection,
		array $data = []
	) {
		$this->productRepository = $productRepository;
		$this->resourceConnection = $resourceConnection;
		parent::__construct($context, $data);			
	}
	
	function getExtraSellDescription(){return df_cfg("klarna/settings/extra_sell_description");}
	
	function getExtraSellProducts(){
		$products = array();
		$extra_sell_products = df_cfg("klarna/settings/extra_sell_products");
		if($extra_sell_products != ""){
			$extra_sell_products = explode(",", $extra_sell_products);
			if(!empty($extra_sell_products)){
				foreach($extra_sell_products as $extra_sell_product){
					$connection = $this->resourceConnection->getConnection();
					$result = $connection->fetchOne('SELECT entity_id FROM catalog_product_entity WHERE sku = "' . $extra_sell_product . '"');
					if($result){
						$reloaded_product = $this->productRepository->get($extra_sell_product);
						if($reloaded_product->isSaleable() && $reloaded_product->getVisibility() != "1"){
							$products[] = $reloaded_product;
						}
					}
				}
			}
		}
		return $products;
	}

	protected $productRepository;
	protected $resourceConnection;
}