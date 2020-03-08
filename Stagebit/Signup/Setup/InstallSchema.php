<?php

namespace Stagebit\Signup\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class InstallSchema implements InstallSchemaInterface
{

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */


    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();


        $installer->getConnection()->dropTable($installer->getTable('mkv_signup_form'));
        
        /* Start : mkv_signup_form : table for save signup forms*/

        $table = $installer->getConnection()->newTable(
            $installer->getTable('mkv_signup_form')
        )->addColumn(
            'regi_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Customer Register Id'
        )->addColumn(
            'c_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Customer Name'
        )->addColumn(
            'c_email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Customer Email'
        )->addColumn(
            'c_password',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Customer Password'
        )->addColumn(
            'c_telephone',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Customer Telephone'
        )->addColumn(
            'c_bdate',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => true, ],
            'Customer Birth-Date'
        )->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Created At'
        )->addColumn(
            'updated_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
            'Updated At'
        )->addIndex(
            $installer->getIdxName('mkv_signup_form', ['regi_id']),
                ['regi_id']
        )->setComment(
            'Manisha Sign-Up Form'
        );

        $installer->getConnection()->createTable($table);
        $installer->endSetup();
        /* End : mkv_signup_form */  
    }
}
