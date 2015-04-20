<?php

class ES_Newssubscribers_Model_Subscriber extends Mage_Newsletter_Model_Subscriber
{

    const ERROR_SHOPPING_CARD_RULE_IS_MISSING = 'ERROR_SHOPPING_CARD_RULE_IS_MISSING';

    public function getCouponCode()
    {
        if (!Mage::getStoreConfig('newsletter/coupon/isactive'))
            return '';

        $model = Mage::getModel('salesrule/rule');
        $model->load(Mage::getStoreConfig('newsletter/coupon/roleid'));
        $massGenerator = $model->getCouponMassGenerator();
        $session = Mage::getSingleton('core/session');
        $ruleId = Mage::getStoreConfig('newsletter/coupon/roleid');
        if (!is_numeric($ruleId)) {
            return self::ERROR_SHOPPING_CARD_RULE_IS_MISSING;
        }
        $rule = Mage::getModel('salesrule/rule')->load($ruleId);
        if (!$rule->getId()) {
            return self::ERROR_SHOPPING_CARD_RULE_IS_MISSING;
        }

        try {
            $massGenerator->setData(array(
                'rule_id' => $ruleId,
                'qty' => 1,
                'length' => Mage::getStoreConfig('newsletter/coupon/length'),
                'format' => Mage::getStoreConfig('newsletter/coupon/format'),
                'prefix' => Mage::getStoreConfig('newsletter/coupon/prefix'),
                'suffix' => Mage::getStoreConfig('newsletter/coupon/suffix'),
                'dash' => Mage::getStoreConfig('newsletter/coupon/dash'),
                'uses_per_coupon' => 1,
                'uses_per_customer' => 1
            ));
            $massGenerator->generatePool();
            $latestCuopon = max($model->getCoupons());
        } catch (Mage_Core_Exception $e) {
            $session->addException($e, $this->__('There was a problem with coupon: %s', $e->getMessage()));
        }
        catch (Exception $e) {
            $session->addException($e, $this->__('There was a problem with coupon.'));
        }

        return $latestCuopon->getCode();
    }


}