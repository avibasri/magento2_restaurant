<?php

namespace Dragontail\Restaurants\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0){

		$installer->run('SET sql_notes = 0');
$installer->run('CREATE TABLE IF NOT EXISTS `restaurants` (

  `id` int(11) NOT NULL auto_increment,   
  `name`  varchar(30) NOT NULL default \'\',
  `type` varchar(20) NOT NULL default \'\',    
  `phone` varchar(25) NOT NULL default \'\',
  `geo_location` varchar(30) NOT NULL default \'\',
  `address` varchar(100) NOT NULL default \'\',
   PRIMARY KEY  (`id`)
)');
$installer->run('SET sql_notes = 1');


		//demo
//$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//$scopeConfig = $objectManager->create('Magento\Framework\App\Config\ScopeConfigInterface');
//$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/updaterates.log');
//$logger = new \Zend\Log\Logger();
//$logger->addWriter($writer);
//$logger->info('updaterates');
//demo 

		}

        $installer->endSetup();

    }
}