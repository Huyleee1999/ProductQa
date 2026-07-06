<?php

namespace Training\ProductQa\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Training\ProductQa\Api\QuestionRepositoryInterface;
use Training\ProductQa\Model\Question;

class ProductQuestions implements ArgumentInterface
{
    private QuestionRepositoryInterface $questionRepository;
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    public function __construct(
        QuestionRepositoryInterface $questionRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ){
        $this->questionRepository = $questionRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getAnsweredQuestions(ProductInterface $product): array
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('product_id', $product->getId())
            ->addFilter('status', Question::STATUS_ANSWERED)
            ->create();

        return $this->questionRepository->getList($searchCriteria)->getItems();
    }

}
