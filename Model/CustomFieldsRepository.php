<?php

namespace Magepow\CheckoutCustom\Model;

use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Sales\Model\Order;
use Magepow\CheckoutCustom\Api\CustomFieldsRepositoryInterface;
use Magepow\CheckoutCustom\Api\Data\CustomFieldsInterface;


class CustomFieldsRepository implements CustomFieldsRepositoryInterface
{
    /**
     * @var CartRepositoryInterface
     */
    protected $cartRepository;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var CustomFieldsInterface
     */
    protected $customFields;

    /**
     * @param CartRepositoryInterface $cartRepository
     * @param ScopeConfigInterface    $scopeConfig
     * @param CustomFieldsInterface   $customFields
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        ScopeConfigInterface $scopeConfig,
        CustomFieldsInterface $customFields
    ) {
        $this->cartRepository = $cartRepository;
        $this->scopeConfig    = $scopeConfig;
        $this->customFields   = $customFields;
    }
    /**
     * @param int   $cartId
     * @param \Magepow\CheckoutCustom\Api\Data\CustomFieldsInterface $customFields
     *
     * @return \Magepow\CheckoutCustom\Api\Data\CustomFieldsInterface
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function saveCustomFields(int $cartId, CustomFieldsInterface $customFields): CustomFieldsInterface {
        $cart = $this->cartRepository->getActive($cartId);
        if (!$cart->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 is empty', $cartId));
        }

        try {

            $cart->setData(
                CustomFieldsInterface::CHECKOUT_ORDER_REFERENCE,
                $customFields->getCheckoutOrderReference()
            );
            $cart->setData(
                CustomFieldsInterface::CHECKOUT_DATE,
                $customFields->getCheckoutDate()
            );
            $cart->setData(
                CustomFieldsInterface::CHECKOUT_COMMENT,
                $customFields->getCheckoutComment()
            );
            $cart->setData(
                CustomFieldsInterface::CHECKOUT_EMAIL_CC,
                $customFields->getCheckoutEmailCc()
            );


            $this->cartRepository->save($cart);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Custom order data could not be saved!'));
        }

        return $customFields;
    }

    /**
     * @param Order $order
     *
     * @return CustomFieldsInterface
     * @throws NoSuchEntityException
     */
    public function getCustomFields(Order $order): CustomFieldsInterface
    {
        if (!$order->getId()) {
            throw new NoSuchEntityException(__('Order %1 does not exist', $order));
        }
        $this->customFields->setCheckoutOrderReference(
            $order->getData(CustomFieldsInterface::CHECKOUT_ORDER_REFERENCE)
        );
        $this->customFields->setCheckoutDate(
            $order->getData(CustomFieldsInterface::CHECKOUT_DATE)
        );
        $this->customFields->setCheckoutComment(
            $order->getData(CustomFieldsInterface::CHECKOUT_COMMENT)
        );
        $this->customFields->setCheckoutEmailCc(
            $order->getData(CustomFieldsInterface::CHECKOUT_EMAIL_CC)
        );


        return $this->customFields;
    }
}
