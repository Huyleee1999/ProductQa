<?php

namespace Training\ProductQa\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class QuestionActions extends Column
{
    public const EDIT_URL = 'productqa/question/edit';
    public const DELETE_URL = 'productqa/question/delete';

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        private UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
    }

    public function prepareDataSource(array $dataSource): array
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as &$item) {

            if (!isset($item['question_id'])) {
                continue;
            }

            $item[$this->getData('name')]['edit'] = [
                'href' => $this->urlBuilder->getUrl(
                    self::EDIT_URL,
                    ['id' => $item['question_id']]
                ),
                'label' => __('Edit'),
            ];

            $item[$this->getData('name')]['delete'] = [
                'href' => $this->urlBuilder->getUrl(
                    self::DELETE_URL,
                    ['id' => $item['question_id']]
                ),
                'label' => __('Delete'),
                'confirm' => [
                    'title' => __('Delete Question'),
                    'message' => __('Are you sure you want to delete this question?')
                ]
            ];
        }

        return $dataSource;
    }
}
