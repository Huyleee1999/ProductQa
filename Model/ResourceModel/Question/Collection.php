<?php

namespace Training\ProductQa\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Training\ProductQa\Model\Question::class,
            \Training\ProductQa\Model\ResourceModel\Question::class
        );
    }
}
