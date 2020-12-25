<?php

namespace Magepow\CheckoutCustom\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Magepow\CheckoutCustom\Api\Data\CustomFieldsInterface;

class CustomFields extends AbstractExtensibleObject implements CustomFieldsInterface
{


    /**
     * @return string|null
     */
    public function getCheckoutOrderReference()
    {
        return $this->_get(self::CHECKOUT_ORDER_REFERENCE);
    }

    /**
     * @return string|null
     */
    public function getCheckoutDate()
    {
        return $this->_get(self::CHECKOUT_DATE);
    }

    /**
     * @return string|null
     */
    public function getCheckoutComment()
    {
        return $this->_get(self::CHECKOUT_COMMENT);
    }

    /**
     * @return string|null
     */
    public function getCheckoutEmailCc()
    {
        return $this->_get(self::CHECKOUT_EMAIL_CC);
    }

    /**
     * @param string|null $checkoutOrderReference
     *
     * @return CustomFieldsInterface
     */
    public function setCheckoutOrderReference(string $checkoutOrderReference = null)
    {
        return $this->setData(self::CHECKOUT_ORDER_REFERENCE, $checkoutOrderReference);
    }

    /**
     * @param string|null $checkoutDate
     *
     * @return CustomFieldsInterface
     */
    public function setCheckoutDate(string $checkoutDate = null)
    {
        return $this->setData(self::CHECKOUT_DATE, $checkoutDate);
    }

    /**
     * @param string|null $comment
     *
     * @return CustomFieldsInterface
     */
    public function setCheckoutComment(string $comment = null)
    {
        return $this->setData(self::CHECKOUT_COMMENT, $comment);
    }

    /**
     * @param string|null $emailcc
     *
     * @return CustomFieldsInterface
     */
    public function setCheckoutEmailCc(string $emailcc = null)
    {
        return $this->setData(self::CHECKOUT_EMAIL_CC, $emailcc);
    }

}
