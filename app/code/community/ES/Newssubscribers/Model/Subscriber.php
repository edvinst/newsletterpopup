<?php

class ES_Newssubscribers_Model_Subscriber extends Mage_Newsletter_Model_Subscriber
{

    const ERROR_SHOPPING_CARD_RULE_IS_MISSING = 'ERROR_SHOPPING_CARD_RULE_IS_MISSING';

    public function getCouponCode()
    {
        if (!Mage::getStoreConfig('newssubscribers/coupon/isactive'))
            return '';

        $model = Mage::getModel('salesrule/rule');
        $model->load(Mage::getStoreConfig('newssubscribers/coupon/roleid'));
        $massGenerator = $model->getCouponMassGenerator();
        $session = Mage::getSingleton('core/session');
        $ruleId = Mage::getStoreConfig('newssubscribers/coupon/roleid');
        if (!is_numeric($ruleId)) {
            return self::ERROR_SHOPPING_CARD_RULE_IS_MISSING;
        }

        $rule = Mage::getModel('salesrule/rule')->load($ruleId);
        if (!$rule->getId()) {
            return self::ERROR_SHOPPING_CARD_RULE_IS_MISSING;
        }

        try {
            $massGenerator->setData(
                array(
                    'rule_id' => $ruleId,
                    'qty' => 1,
                    'length' => Mage::getStoreConfig('newssubscribers/coupon/length'),
                    'format' => Mage::getStoreConfig('newssubscribers/coupon/format'),
                    'prefix' => Mage::getStoreConfig('newssubscribers/coupon/prefix'),
                    'suffix' => Mage::getStoreConfig('newssubscribers/coupon/suffix'),
                    'dash' => Mage::getStoreConfig('newssubscribers/coupon/dash'),
                    'uses_per_coupon' => 1,
                    'uses_per_customer' => 1
                )
            );
            $massGenerator->generatePool();
            $latestCuopon = max($model->getCoupons());
        } catch (Mage_Core_Exception $e) {
            $session->addException($e, $this->__('There was a problem with coupon: %s', $e->getMessage()));
        } catch (Exception $e) {
            $session->addException($e, $this->__('There was a problem with coupon.'));
        }

        return $latestCuopon->getCode();
    }
}