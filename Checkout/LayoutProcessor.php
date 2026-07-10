<?php

namespace Training\ProductQa\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class LayoutProcessor implements LayoutProcessorInterface
{
    public function process($jsLayout)
    {
        $shippingFields = &$jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'];

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
                'required-entry' => true,
                'min_text_length' => 30,
                'max_text_length' => 255
            ],
            'visible' => true
        ];

        return $jsLayout;
    }
}
