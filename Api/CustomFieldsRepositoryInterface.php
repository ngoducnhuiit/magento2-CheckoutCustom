<?php

namespace Magepow\CheckoutCustom\Api;

use Magento\Sales\Model\Order;
use Magepow\CheckoutCustom\Api\Data\CustomFieldsInterface;

interface CustomFieldsRepositoryInterface
{
    /**
     * @param int  $cartId
     * @param \Magepow\CheckoutCustom\Api\Data\CustomFieldsInterface $customFields
     *
     * @return \Magepow\CheckoutCustom\Api\Data\CustomFieldsInterface
     */
    public function saveCustomFields(int $cartId, CustomFieldsInterface $customFields): CustomFieldsInterface;

    /**
     * @param Order $order
     *
     * @return CustomFieldsInterface
     */
    public function getCustomFields(Order $order) : CustomFieldsInterface;
}
