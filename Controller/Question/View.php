<?php

namespace Training\ProductQa\Controller\Question;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Training\ProductQa\Api\QuestionRepositoryInterface;

class View implements HttpGetActionInterface
{
    public function __construct(
        private JsonFactory $jsonFactory,
        private QuestionRepositoryInterface $questionRepository,
        private RequestInterface $request
    ) {
    }

    public function execute()
    {
        $result = $this->jsonFactory->create();

        try {
            $questionId = $this->request->getParam('id');
            $question = $this->questionRepository->getById($questionId);

            return $result->setData([
                'id' => $question->getQuestionId(),
                'question_text' => $question->getQuestionText(),
                'status' => $question->getStatus()
            ]);
        } catch (\Exception $e) {
            return $result->setData([
                'error' => $e->getMessage()
            ]);
        }
    }
}
