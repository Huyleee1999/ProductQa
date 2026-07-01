<?php

namespace Training\ProductQa\Block\Adminhtml\Question\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'productqa_question_form.productqa_question_form',
                                'actionName' => 'save'
                            ]
                        ]
                    ]
                ]
            ],
            'sort_order' => 10
        ];
    }
}
