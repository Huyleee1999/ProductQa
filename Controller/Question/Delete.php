<?php

namespace Training\ProductQa\Controller\Question;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Training\ProductQa\Api\QuestionRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\Request\InvalidRequestException;

class Delete implements HttpPostActionInterface, CsrfAwareActionInterface
{
    public function __construct(
        private JsonFactory $jsonFactory,
        private QuestionRepositoryInterface $questionRepository,
        private SearchCriteriaBuilder $searchCriteriaBuilder
    ) {}

    public function createCsrfValidationException(
        RequestInterface $request
    ): ?InvalidRequestException {
        return null;
    }

    public function validateForCsrf(
        RequestInterface $request
    ): ?bool {
        return true;
    }

    public function execute()
    {
        $result = $this->jsonFactory->create();

        try {
            $searchCriteria = $this->searchCriteriaBuilder->create();
            $searchResults = $this->questionRepository->getList($searchCriteria);
            $questions = $searchResults->getItems();

            foreach ($questions as $question) {
                $this->questionRepository->delete($question);
            }

            return $result->setData([
                'success' => true,
                'msg' => 'Xóa thành công !'
            ]);
        } catch (\Exception $e) {
            return $result->setData([
                'error' => $e->getMessage()
            ]);
        }
    }
}
