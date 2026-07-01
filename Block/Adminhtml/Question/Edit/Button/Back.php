<?php

namespace Training\ProductQa\Block\Adminhtml\Question\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Back implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => "location.href = '.../question/index'",
            'class' => 'back',
            'sort_order' => 20
        ];
    }
}
