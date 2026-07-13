<?php

namespace Training\ProductQa\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Training\ProductQa\Api\Data\QuestionInterface;
use Training\ProductQa\Api\Data\QuestionSearchResultsInterface;

interface QuestionRepositoryInterface
{
    /**
     * Save question.
     *
     * @param QuestionInterface $question
     * @return QuestionInterface
     */
    public function save(QuestionInterface $question): QuestionInterface;

    /**
     * Get question by ID.
     *
     * @param int $id
     * @return QuestionInterface
     */
    public function getById(int $id): QuestionInterface;

    /**
     * Delete question.
     *
     * @param QuestionInterface $question
     * @return bool
     */
    public function delete(QuestionInterface $question): bool;

    /**
     * Delete question by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;
    
    /**
     * Get question list.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuestionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): QuestionSearchResultsInterface;
}
