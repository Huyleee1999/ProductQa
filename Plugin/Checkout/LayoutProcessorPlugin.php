<?php

namespace Training\ProductQa\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

class LayoutProcessorPlugin
{
    public function beforeProcess(LayoutProcessor $subject, array $jsLayout): array
    {
        $shippingFields =& $jsLayout['components']['checkout']['children']['steps']
        ['children']['shipping-step']['children']['shippingAddress']
        ['children']['shipping-address-fieldset']['children'];

        $shippingFields['expert_question'] = [
            'component' => 'Magento_Ui/js/form/element/textarea',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/textarea'
            ],
            'dataScope' => 'shippingAddress.expert_question',
            'label' => __('Expert Question'),
            'provider' => 'checkoutProvider',
            'sortOrder' => 250,
            'validation' => [
                'required-entry' => true
            ],
            'visible' => true
        ];

        return [$jsLayout];
    }
}
