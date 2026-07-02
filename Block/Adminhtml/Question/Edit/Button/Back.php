<?php

namespace Training\ProductQa\Block\Adminhtml\Question\Edit\Button;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Back implements ButtonProviderInterface
{
    private UrlInterface $urlBuilder;

    public function __construct(
        UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf(
                "location.href = '%s';",
                $this->urlBuilder->getUrl('productqa/question/index')
            ),
            'class' => 'back',
            'sort_order' => 20
        ];
    }
}
