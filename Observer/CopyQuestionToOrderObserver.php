<?php

namespace Training\ProductQa\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CopyQuestionToOrderObserver implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $quote = $observer->getQuote();
        $order = $observer->getOrder();

        $order->setData('expert_question', $quote->getData('expert_question'));
    }
}