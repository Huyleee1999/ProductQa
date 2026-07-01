<?php

namespace Training\ProductQa\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    public function toOptionArray(): array
    {
        return [
            ['label' => __('Pending'), 'value' => 'pending'],
            ['label' => __('Answered'), 'value' => 'answered'],
        ];
    }
}
