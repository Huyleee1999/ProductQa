<?php

namespace Training\ProductQa\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Training\ProductQa\Api\QuestionRepositoryInterface;

class Delete extends Action
{
    public const ADMIN_RESOURCE = 'Training_ProductQa::question_delete';

    public function __construct(
        Action\Context $context,
        private QuestionRepositoryInterface $questionRepository
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id', []);
        $this->questionRepository->deleteById($id);

        $this->messageManager->addSuccessMessage(
            __('Deleted successfully')
        );

        return $this->_redirect('*/*/index');
    }
}
