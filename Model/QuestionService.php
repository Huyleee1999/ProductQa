<?php

namespace Training\ProductQa\Model;

use Psr\Log\LoggerInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Area;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Training\ProductQa\Api\ConfigInterface;
use Training\ProductQa\Api\QuestionRepositoryInterface;

class QuestionService
{
    private const TEMPLATE_VAR_QUESTION_LIST = 'question_list';
    private const EMAIL_TEMPLATE = 'training_productqa_digest_email';


    private LoggerInterface $logger;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    private QuestionRepositoryInterface $questionRepository;
    private TransportBuilder $transportBuilder;
    private ScopeConfigInterface $scopeConfig;
    private StoreManagerInterface $storeManager;

    public function __construct(
        LoggerInterface $logger,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        QuestionRepositoryInterface $questionRepository,
        TransportBuilder $transportBuilder,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager
    ) {
        $this->logger = $logger;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->questionRepository = $questionRepository;
        $this->transportBuilder = $transportBuilder;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    private function getPendingQuestions(): array
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('status', Question::STATUS_PENDING)
            ->create();

        return $this->questionRepository->getList($searchCriteria)->getItems();
    }

    private function buildQuestionList(array $questions): string
    {
        $html = '';

        foreach ($questions as $question) {
            $html .= sprintf(
                '<li>
                    <strong>Question #%d</strong><br>
                    Product ID: %d<br>
                    %s
                </li><br>',
                $question->getId(),
                $question->getProductId(),
                $question->getQuestionText()
            );
        }

        return $html;
    }

    public function sendDigestEmail(): void
    {
        $questions = $this->getPendingQuestions();

        if (!$questions) {
            $this->logger->info(
                'No unanswered questions found.'
            );

            return;
        }

        $recipient = $this->scopeConfig->getValue(
            ConfigInterface::XML_PATH_DIGEST_RECIPIENT
        );

        if (!$recipient) {
            $this->logger->warning('Digest recipient email is not configured.');
            return;
        }

        $questionList = $this->buildQuestionList($questions);

        $transport = $this->transportBuilder
            ->setTemplateIdentifier(self::EMAIL_TEMPLATE)
            ->setTemplateOptions([
                'area' => Area::AREA_FRONTEND,
                'store' => $this->storeManager->getStore()->getId()
            ])
            ->setTemplateVars([
                self::TEMPLATE_VAR_QUESTION_LIST => $questionList
            ])
            ->setFromByScope('general')
            ->addTo($recipient)
            ->getTransport();

        $transport->sendMessage();

        $this->logger->info(
            sprintf(
                'Digest email sent successfully. Total questions: %d',
                count($questions)
            )
        );
    }
}
