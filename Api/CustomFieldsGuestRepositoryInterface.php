<?php

namespace Magepow\CheckoutCustom\Api;

use Magento\Sales\Model\Order;
use Magepow\CheckoutCustom\Api\Data\CustomFieldsInterface;

interface CustomFieldsGuestRepositoryInterface
{
    /**
     * @param string  $cartId
     * @param \Magepow\CheckoutCustom\Api\Data\CustomFieldsInterface $customFields
     *
     * @return \Magepow\CheckoutCustom\Api\Data\CustomFieldsInterface
     */
    public function saveCustomFields(string $cartId, CustomFieldsInterface $customFields): CustomFieldsInterface;
}
