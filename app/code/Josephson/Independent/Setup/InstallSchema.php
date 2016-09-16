<?php

namespace Josephson\Independent\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
	{
		$installer = $setup;
		echo "INSTALLER?\n";
		echo get_class($installer);
		var_dump($installer->getTable('josephson_independent_post'));
		echo "^ INSTALLER?\n";
		$table = $installer->getConnection()
			->newTable($installer->getTable('josephson_independent_post'))
			->addColumn(
				'post_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
				'Entity ID'
			)->addColumn(
				'some_title',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Title'
			)->addColumn(
				'body',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Post Body'
			);

		$installer->getConnection()->createTable($table);
	}
}
