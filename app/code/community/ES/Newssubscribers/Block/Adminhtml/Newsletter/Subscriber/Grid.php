<?php

class ES_Newssubscribers_Block_Adminhtml_Newsletter_Subscriber_Grid extends Mage_Adminhtml_Block_Newsletter_Subscriber_Grid
{
    protected function _prepareColumns()
    {
        /**$this->addColumnAfter('subscriber_firstname', array(
            'header'    => Mage::helper('newssubscribers')->__('Subscriber First Name'),
            'index'     => 'subscriber_firstname',
            'default'   =>    '----'
        ), 'lastname');

        $this->addColumnAfter('subscriber_lastname', array(
            'header'    => Mage::helper('newssubscribers')->__('Subscriber Last Name'),
            'index'     => 'subscriber_lastname',
            'default'   =>    '----'
        ),'subscriber_firstname');**/
        parent::_prepareColumns();
    }
}
