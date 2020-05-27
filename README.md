A custom checkout module for [blushme.se](https://blushme.se) (Magento 2).  

## How to install
```posh             
bin/magento maintenance:enable
rm -rf composer.lock
composer clear-cache
composer require blushme/checkout:*
bin/magento setup:upgrade
bin/magento cache:enable
rm -rf var/di var/generation generated/*
bin/magento setup:di:compile
rm -rf pub/static/*
bin/magento setup:static-content:deploy \
	--area adminhtml \
	--theme Magento/backend \
	-f en_US sv_SE fi_FI
bin/magento setup:static-content:deploy \
	--area frontend \
	--theme Codazon/fastest_seavus \
	-f en_US sv_SE fi_FI
bin/magento maintenance:disable
```      

## How to upgrade
```posh              
bin/magento maintenance:enable
composer remove blushme/checkout
rm -rf composer.lock
composer clear-cache
composer require blushme/checkout:*
bin/magento setup:upgrade
bin/magento cache:enable
rm -rf var/di var/generation generated/*
bin/magento setup:di:compile
rm -rf pub/static/*
bin/magento setup:static-content:deploy \
	--area adminhtml \
	--theme Magento/backend \
	-f en_US sv_SE fi_FI
bin/magento setup:static-content:deploy \
	--area frontend \
	--theme Codazon/fastest_seavus \
	-f en_US sv_SE fi_FI
bin/magento maintenance:disable 
```