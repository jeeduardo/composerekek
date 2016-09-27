<?php

namespace Josephson\Independent\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;


class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade(
		SchemaSetupInterface $setup,
		ModuleContextInterface $context
	) {
		$installer = $setup;
		$installer->startSetup();
		if (!$context->getVersion()) {
			echo 'No previous version found. No upgrades should execute.';
			$installer->endSetup();
			return false;
		}

		if (version_compare($context->getVersion(), '1.0.1') < 0) {
			$table = $installer->getTable('josephson_independent_post');
			$connection = $installer->getConnection();
			$connection->addColumn(
					$table,
					'some_addl_field',
					[
						'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						'nullable' => true, 
						'comment' => 'COMMNET. Hahaha'
					]
				);

			echo "TABLE josephson_independent_post upgraded. \n";
		}

		$installer->endSetup();
	}
}