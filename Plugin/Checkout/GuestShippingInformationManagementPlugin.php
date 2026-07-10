<?php

namespace Training\ProductQa\Plugin\Checkout;

use Magento\Checkout\Api\Data\ShippingInformationInterface;

class GuestShippingInformationManagementPlugin
{
    public function beforeSaveAddressInformation(
        $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    ) {
        $shippingAddress = $addressInformation->getShippingAddress();

        if ($shippingAddress && method_exists($shippingAddress, 'getExtensionAttributes')) {
            $extensionAttributes = $shippingAddress->getExtensionAttributes();

            if ($extensionAttributes && method_exists($extensionAttributes, 'getExpertQuestion')) {
                $expertQuestion = $extensionAttributes->getExpertQuestion();

                if ($expertQuestion !== null) {
                    $shippingAddress->setExtensionAttributes($extensionAttributes);
                }
            }
        }

        return [$cartId, $addressInformation];
    }
}