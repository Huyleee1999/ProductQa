<?php

namespace Training\ProductQa\Controller\Question;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Training\ProductQa\Api\QuestionRepositoryInterface;
use Training\ProductQa\Model\QuestionFactory;

class Save implements HttpPostActionInterface
{
    private RequestInterface $request;
    private RedirectFactory $redirectFactory;
    private QuestionFactory $questionFactory;
    private QuestionRepositoryInterface $questionRepository;

    public function __construct(
        RequestInterface $request,
        RedirectFactory $redirectFactory,
        QuestionFactory $questionFactory,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->request = $request;
        $this->redirectFactory = $redirectFactory;
        $this->questionFactory = $questionFactory;
        $this->questionRepository = $questionRepository;
    }

    public function execute()
    {
        $productId = $this->request->getParam('product_id');
        $questionText = $this->request->getParam('question_text');

        $question = $this->questionFactory->create();
        $question->setData('product_id', $productId);
        $question->setQuestionText($questionText);
        $question->setStatus('pending');

        $this->questionRepository->save($question);

        return $this->redirectFactory->create()->setRefererUrl();
    }
}
