<?php

namespace Training\ProductQa\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;

class CreateQuestionObserver implements ObserverInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $question = $observer->getEvent()->getQuestion();
        $this->logger->info(
            sprintf(
                'Question Created | Product_Id: %s | Question_text: %s | Status: %s',
                $question->getProductId(),
                $question->getQuestionText(),
                $question->getStatus(),
            )
        );
    }
}
