<?php


namespace Magepow\CheckoutCustom\Api\Data;

interface CustomFieldsInterface
{
    const CHECKOUT_ORDER_REFERENCE = 'checkout_order_reference';
    const CHECKOUT_DATE = 'checkout_date';
    const CHECKOUT_COMMENT = 'checkout_comment';
    const CHECKOUT_EMAIL_CC = 'checkout_email_cc';



    /**
     * @return string|null
     */
    public function getCheckoutOrderReference();

    /**
     * @return string|null
     */
    public function getCheckoutDate();

    /**
     * @return string|null
     */
    public function getCheckoutComment();

    /**
     * @return string|null
     */
    public function getCheckoutEmailCc();

    /**
     * @param string|null $checkoutOrderReference
     *
     * @return CustomFieldsInterface
     */
    public function setCheckoutOrderReference(string $checkoutOrderReference = null);

    /**
     * @param string|null $checkoutDate
     *
     * @return CustomFieldsInterface
     */
    public function setCheckoutDate(string $checkoutDate = null);

    /**
     * @param string|null $comment
     *
     * @return CustomFieldsInterface
     */
    public function setCheckoutComment(string $comment = null);

    /**
     * @param string|null $emailcc
     *
     * @return CustomFieldsInterface
     */
    public function setCheckoutEmailCc(string $emailcc = null);
}
