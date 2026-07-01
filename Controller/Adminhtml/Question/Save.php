<?php

namespace Training\ProductQa\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Training\ProductQa\Api\QuestionRepositoryInterface;
use Training\ProductQa\Model\QuestionFactory;

class Save extends Action
{
    public const ADMIN_RESOURCE = 'Training_ProductQa::question_save';

    public function __construct(
        Action\Context $context,
        private QuestionFactory $questionFactory,
        private QuestionRepositoryInterface $questionRepository
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        $data = $post['data'] ?? [];
        $id = $data['question_id'] ?? null;

        if ($id) {
            $question = $this->questionRepository->getById($id);
        } else {
            $question = $this->questionFactory->create();
        }

        $question->setData($data);
        $this->questionRepository->save($question);
        $this->messageManager->addSuccessMessage(__('Saved successfully'));

        return $this->_redirect('*/*/index');
    }
}
