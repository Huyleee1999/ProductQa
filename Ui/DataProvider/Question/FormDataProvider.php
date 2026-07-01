<?php

namespace Training\ProductQa\Ui\DataProvider\Question;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Training\ProductQa\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\App\RequestInterface;

class FormDataProvider extends AbstractDataProvider
{
    protected $loadedData;
    protected $request;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->request = $request;

        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    public function getData()
    {

        if ($this->loadedData !== null) {
            return $this->loadedData;
        }

        $this->loadedData = [];

        $id = (int)$this->request->getParam('id');
        if (!$id) {
            return $this->loadedData;
        }

        $item = $this->collection
            ->addFieldToFilter('question_id', $id)
            ->getFirstItem();

        if ($item->getId()) {
            $this->loadedData[$item->getId()] = [
                'data' => [
                    'question_id'   => $item->getId(),
                    'question_text' => $item->getQuestionText(),
                    'answer_text'   => $item->getAnswerText(),
                    'status'        => $item->getStatus(),
                ]
            ];
        }

        return $this->loadedData;
    }

}
