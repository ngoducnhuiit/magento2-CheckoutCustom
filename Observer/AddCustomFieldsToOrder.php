<?php

namespace Magepow\CheckoutCustom\Observer;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magepow\CheckoutCustom\Api\Data\CustomFieldsInterface;
use Magepow\CheckoutCustom\Model\Data\CustomFields;

class AddCustomFieldsToOrder implements ObserverInterface
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $_checkoutSession;
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession
    )
    {
        $this->_checkoutSession = $checkoutSession;
    }
    /**
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();


        $order->setData(
            CustomFieldsInterface::CHECKOUT_ORDER_REFERENCE,
            $quote->getData(CustomFieldsInterface::CHECKOUT_ORDER_REFERENCE)
        );
        $order->setData(
            CustomFieldsInterface::CHECKOUT_DATE,
            $quote->getData(CustomFieldsInterface::CHECKOUT_DATE)
        );
        $order->setData(
            CustomFieldsInterface::CHECKOUT_COMMENT,
            $quote->getData(CustomFieldsInterface::CHECKOUT_COMMENT)
        );
        $order->setData(
            CustomFieldsInterface::CHECKOUT_EMAIL_CC,
            $quote->getData(CustomFieldsInterface::CHECKOUT_EMAIL_CC)
        );
        $this->_checkoutSession->setEmailCc($quote->getData(CustomFieldsInterface::CHECKOUT_EMAIL_CC));

    }
}
