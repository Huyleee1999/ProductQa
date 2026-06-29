<?php

namespace Training\ProductQa\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class CustomerLoginObserver implements ObserverInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $this->logger->info(
            sprintf(
                'Customer Login | ID: %s | Email: %s',
                $customer->getId(),
                $customer->getEmail()
            )
        );
    }
}
