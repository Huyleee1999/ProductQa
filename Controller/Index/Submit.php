<?php

namespace Training\ProductQa\Controller\Index;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Training\ProductQa\Api\QuestionRepositoryInterface;
use Training\ProductQa\Api\Data\QuestionInterfaceFactory;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Controller\Result\JsonFactory;
use Training\ProductQa\Model\Question;
use Training\ProductQa\Model\QuestionFactory;
use Magento\Framework\App\Request\Http;

class Submit implements HttpPostActionInterface
{
    public function __construct(
        // private RequestInterface $request,
        private QuestionRepositoryInterface $questionRepository,
        private QuestionFactory $questionFactory,
        private Validator $formKeyValidator,
        private JsonFactory $resultJsonFactory,
        private Http $request,
    ) {}

    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $session = $objectManager->get(\Magento\Framework\Session\SessionManager::class);

        file_put_contents(
            BP . '/var/log/formkey.log',
            print_r([
                'cookie' => $_COOKIE,
                'session_id' => session_id(),
                'session_name' => session_name(),
                'session_form_key' => $objectManager
                    ->get(\Magento\Framework\Data\Form\FormKey::class)
                    ->getFormKey()
            ], true)
        );
        if (!$this->formKeyValidator->validate($this->request)) {
            return $result->setData([
                'success' => false,
                'message' => __('Invalid form key.')
            ]);
        }

        $productId = $this->request->getParam('product_id');
        $questionText = $this->request->getParam('question_text');

        if (!$productId) {
            return $result->setData([
                'success' => false,
                'message' => __('Product ID is required.')
            ]);
        }

        if ($questionText === '') {
            return $result->setData([
                'success' => false,
                'message' => __('Question is required.')
            ]);
        }

        try {
            $question = $this->questionFactory->create();
            $question->setProductId($productId);
            $question->setQuestionText($questionText);
            $question->setStatus(Question::STATUS_PENDING);

            $this->questionRepository->save($question);

            return $result->setData([
                'success' => true,
                'message' => __('Your question has been submitted.')
            ]);
        } catch (\Throwable $e) {
            return $result->setData([
                'success' => false,
                'message' => __('Unable to submit question.')
            ]);
        }
    }
}
