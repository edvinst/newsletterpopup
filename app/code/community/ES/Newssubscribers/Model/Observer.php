<?php

class ES_Newssubscribers_Model_Observer extends Mage_Newsletter_Model_Subscriber
{

    public function newsletterSubscriberSave($observer)
    {
        $subscriber = $observer->getEvent()->getSubscriber();

        $firstName          = (string) Mage::app()->getRequest()->getPost('first_name');
        $lastName           = (string) Mage::app()->getRequest()->getPost('last_name');

        if ($firstName == Mage::helper('newssubscribers')->__('First Name'))
            $firstName = '';

        if ($lastName == Mage::helper('newssubscribers')->__('Last Name'))
            $lastName = '';


        if ($firstName != '')
            $subscriber->setSubscriberFirstname($firstName);

        if ($lastName != '')
            $subscriber->setSubscriberLastname($lastName);

        return $this;
    }
}