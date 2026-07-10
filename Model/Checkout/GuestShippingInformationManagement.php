<?php

namespace Training\ProductQa\Model\Checkout;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Api\GuestShippingInformationManagementInterface;
use Magento\Checkout\Model\GuestShippingInformationManagement as MagentoGuestShippingInformationManagement;

class GuestShippingInformationManagement implements GuestShippingInformationManagementInterface
{
    /**
     * @var MagentoGuestShippingInformationManagement
     */
    private $guestShippingInformationManagement;

    public function __construct(
        MagentoGuestShippingInformationManagement $guestShippingInformationManagement
    ) {
        $this->guestShippingInformationManagement = $guestShippingInformationManagement;
    }

    public function saveAddressInformation($cartId, ShippingInformationInterface $addressInformation)
    {
        dd(3333);
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

        return $this->guestShippingInformationManagement->saveAddressInformation($cartId, $addressInformation);
    }
}
