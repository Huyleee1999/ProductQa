<?php

namespace Training\ProductQa\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Training\ProductQa\Api\QuestionRepositoryInterface;
use Training\ProductQa\Model\ResourceModel\Question\CollectionFactory;
use Training\ProductQa\Api\Data\QuestionInterface;
use Training\ProductQa\Api\Data\QuestionSearchResultsInterfaceFactory;
use Training\ProductQa\Api\Data\QuestionSearchResultsInterface;
use Training\ProductQa\Model\QuestionFactory;
use Training\ProductQa\Model\ResourceModel\Question as QuestionResource;

class QuestionRepository implements QuestionRepositoryInterface
{
    private QuestionFactory $questionFactory;
    private QuestionResource $questionResource;
    private CollectionFactory $collectionFactory;
    private CollectionProcessorInterface $collectionProcessor;
    private QuestionSearchResultsInterfaceFactory $searchResultsFactory;

    public function __construct(
        QuestionFactory $questionFactory,
        QuestionResource $questionResource,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        QuestionSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->questionFactory = $questionFactory;
        $this->questionResource = $questionResource;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    public function save(QuestionInterface $question): QuestionInterface
    {
        /** @var \Training\ProductQa\Model\Question $question */
        $this->questionResource->save($question);
        return $question;
    }

    public function getById(int $id): QuestionInterface
    {
        $question = $this->questionFactory->create();
        $this->questionResource->load($question, $id);

        return $question;
    }

    public function delete(QuestionInterface $question): bool
    {
        /** @var \Training\ProductQa\Model\Question $question */
        $this->questionResource->delete($question);

        return true;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): QuestionSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process(
            $searchCriteria,
            $collection
        );

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setsearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
