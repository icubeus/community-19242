<?php
$installer = $this;

$installer->startSetup();

$installer->run("
    DROP TABLE IF EXISTS {$this->getTable('sociallink/sociallink')};  
    CREATE TABLE {$this->getTable('sociallink/sociallink')}
    ( 	
    	`id` int(11) unsigned NOT NULL auto_increment, 
    	`sku` varchar(255) DEFAULT NULL COMMENT 'Sku',
    	`name` varchar(255) DEFAULT NULL COMMENT 'Name',
    	`short_description` text COMMENT 'Short Description',
    	`description` text COMMENT 'Description',
    	`product_url` varchar(255) DEFAULT NULL COMMENT 'Product Url',
    	`sell_price` decimal(12,4) NOT NULL DEFAULT '0.0000' COMMENT 'Sell Price',
    	`qty` decimal(12,4) DEFAULT '0.0000' COMMENT 'Qty',
    	`channel` varchar(255) DEFAULT NULL COMMENT 'Channel',
    	`start_sell` date DEFAULT NULL COMMENT 'Start Sell',
		`end_sell` date DEFAULT NULL COMMENT 'End Sell',
    	PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup();