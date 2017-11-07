<?php
$installer = new Mage_Core_Model_Resource_Setup();

$installer->getConnection()->addColumn($installer->getTable('newsletter_subscriber'),
    'subscriber_firstname', 'varchar(50) AFTER subscriber_confirm_code');

$installer->getConnection()->addColumn($installer->getTable('newsletter_subscriber'),
    'subscriber_lastname', 'varchar(50) AFTER subscriber_firstname');

