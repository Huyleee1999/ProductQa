<?php

namespace Training\ProductQa\Model\Checkout;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Api\GuestShippingInformationManagementInterface;
use Magento\Checkout\Api\ShippingInformationManagementInterface;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\QuoteIdMaskFactory;

class GuestShippingInformationManagement implements GuestShippingInformationManagementInterface
{
    public function __construct(
        private ShippingInformationManagementInterface $shippingInformationManagement,
        private QuoteIdMaskFactory $quoteIdMaskFactory,
        private CartRepositoryInterface $cartRepository
    ) {}

    public function saveAddressInformation($cartId, ShippingInformationInterface $addressInformation)
    {
        $shippingAddress = $addressInformation->getShippingAddress();
        $extensionAttributes = $shippingAddress->getExtensionAttributes();

        if ($extensionAttributes) {
            $expertQuestion = $extensionAttributes->getExpertQuestion();

            if ($expertQuestion !== null) {
                $quoteId = $this->quoteIdMaskFactory
                    ->create()
                    ->load($cartId, 'masked_id')
                    ->getQuoteId();

                    /** @var \Magento\Quote\Model\Quote $quote */
                $quote = $this->cartRepository->getActive((int)$quoteId);
                $quote->setData('expert_question', $expertQuestion);

                $this->cartRepository->save($quote);
            }
        }

        return $this->shippingInformationManagement->saveAddressInformation($quoteId, $addressInformation);
    }
}
