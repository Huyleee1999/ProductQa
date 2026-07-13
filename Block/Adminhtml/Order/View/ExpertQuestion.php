<?php

namespace Training\ProductQa\Block\Adminhtml\Order\View;

use Magento\Backend\Block\Template;
use Magento\Framework\Registry;

class ExpertQuestion extends Template
{
    public function __construct(Template\Context $context, private Registry $registry, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getExpertQuestion(): ?string
    {
        $order = $this->registry->registry('current_order');
        return $order?->getData('expert_question');
    }
}