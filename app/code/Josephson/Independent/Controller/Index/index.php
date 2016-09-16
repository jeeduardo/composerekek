<?php

namespace Josephson\Independent\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	public function execute()
	{
		echo 'Independent module...<br>';
		$home_fragrance_id = 44;
		// get instance of Installer...
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
		$store = $storeManager->getStore();

		$rootCategory = $objectManager->get('\Magento\Catalog\Model\Category')->load($store->getRootCategoryId());
		// var_dump(get_class_methods(get_class($rootCategory)));
		var_dump($rootCategory->getName());
		$categoryFactory = $objectManager->get('\Magento\Catalog\Model\CategoryFactory');
		try {
			$category = $categoryFactory->create();
			$category->setName('test category 1 2 3');
			$category->setIsActive(true);
			$category->setStoreIds([0, $store->getId()]);
			$category->setPath($rootCategory->getPath());
			$category->setParentId($rootCategory->getId());

			$category->save();

			echo 'Category ' . $category->getName() . ' saved. ID: ' . $category->getId() . "\n";
		} catch (\Exception $e) {
			var_dump($e->getMessage());
		}
	}
}
