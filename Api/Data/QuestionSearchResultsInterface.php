<?php

namespace Training\ProductQa\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface QuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Training\ProductQa\Api\Data\QuestionInterface[]
     */
    public function getItems();

     /**
     * @param \Training\ProductQa\Api\Data\QuestionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}



