<?php
class ES_Newssubscribers_Block_Newssubscribers extends Mage_Core_Block_Template
{

    public function getCookieName()
    {
        return Mage::getStoreConfig('newssubscribers/general/cookiename');
    }

    public function getCookieLifeTime()
    {
        return Mage::getStoreConfig('newssubscribers/general/cookielifetime');
    }

    public function isActivePopUp()
    {
        return Mage::getStoreConfig('newssubscribers/general/isactive');
    }

    public function getTheme()
    {
        return Mage::getStoreConfig('newssubscribers/general/theme');
    }

    public function getFirstTitle()
    {
        return Mage::getStoreConfig('newssubscribers/general/firsttitle');
    }

    public function getSecondTitle()
    {
        return Mage::getStoreConfig('newssubscribers/general/secondtitle');
    }

    public function getText()
    {
        return Mage::getStoreConfig('newssubscribers/general/message');
    }
}