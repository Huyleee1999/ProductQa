<?php

namespace Training\ProductQa\Model;

use Psr\Log\LoggerInterface;

class QuestionService
{
    private LoggerInterface $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getQuestions(): array {
        $this->logger->info('QuestionService execute');

         return [
            'What is Magento 2?',
            'What is VirtualType?',
            'What is Preference?'
        ];
    }
}
