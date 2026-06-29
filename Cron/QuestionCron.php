<?php

namespace Training\ProductQa\Cron;

use Psr\Log\LoggerInterface;

class QuestionCron
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute() {
        $this->logger->info('Cron executed at: ' . date('Y-m-d H:i:s'));
    }
}
