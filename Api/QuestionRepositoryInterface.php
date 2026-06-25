<?php

namespace Training\ProductQa\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Training\ProductQa\Api\Data\QuestionInterface;
use Training\ProductQa\Api\Data\QuestionSearchResultsInterface;

interface QuestionRepositoryInterface
{
    public function save(QuestionInterface $question): QuestionInterface;

    public function getById(int $id): QuestionInterface;

    public function delete(QuestionInterface $question): bool;

    public function getList(SearchCriteriaInterface $searchCriteria): QuestionSearchResultsInterface;
}
