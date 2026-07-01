<?php

namespace Training\ProductQa\Cron;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Psr\Log\LoggerInterface;
use Training\ProductQa\Model\QuestionService;

class QuestionDigestCron
{
    private QuestionService $questionService;
    private LoggerInterface $logger;
    private ScopeConfigInterface $scopeConfig;

    public function __construct(
        QuestionService $questionService,
        LoggerInterface $logger,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->questionService = $questionService;
        $this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
    }

    public function execute()
    {
        try {
            $this->logger->info('ProductQa Digest Cron started');

            $isEnabled = $this->scopeConfig->isSetFlag(
                'productqa/general/enabled',
                ScopeInterface::SCOPE_STORE
            );

            if (!$isEnabled) {
                $this->logger->info('Digest cron skipped (disabled in config)');
                return;
            }

            $this->questionService->sendDigestEmail();

            $this->logger->info('ProductQa Digest Cron finished');
        } catch (\Throwable $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
