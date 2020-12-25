<?php
namespace Magepow\CheckoutCustom\Plugin\Model\Checkout;

class LayoutProcessorPlugin
{
    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */

    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
        ['children']['shippingAddress']['children']['before-form']['children']['custom-checkout-form-container']
        ['children']['custom-checkout-form-fieldset']['children']['checkout_email_cc']['notice'] = __('If you would like to notify a colleague about this order, please enter their email address in the EMAIL CC field.');
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
        ['children']['shippingAddress']['children']['before-form']['children']['custom-checkout-form-container']
        ['children']['custom-checkout-form-fieldset']['children']['checkout_date']['notice'] = __('Date shown or next working day.');
        return $jsLayout;
    }
}
