<?php

namespace Training\ProductQa\Cron;

use Psr\Log\LoggerInterface;
use Training\ProductQa\Model\QuestionService;

class QuestionDigestCron
{
    private QuestionService $questionService;
    private LoggerInterface $logger;

    public function __construct(QuestionService $questionService, LoggerInterface $logger)
    {
        $this->questionService = $questionService;
        $this->logger = $logger;
    }

    public function execute()
    {
        try {
            $this->logger->info('ProductQa Digest Cron started');
            $this->questionService->sendDigestEmail();

            $this->logger->info('ProductQa Digest Cron finished');
        } catch (\Throwable $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
