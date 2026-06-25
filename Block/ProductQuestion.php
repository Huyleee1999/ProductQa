<?php

namespace Training\ProductQa\Block;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Training\ProductQa\Api\QuestionRepositoryInterface;

class ProductQuestion extends Template
{
    private Registry $registry;
    private Context $context;
    private QuestionRepositoryInterface $questionRepository;
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    public function __construct(
        Context $context,
        Registry $registry,
        QuestionRepositoryInterface $questionRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,

        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->questionRepository = $questionRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getProduct()
    {
        return $this->registry->registry('current_product');
    }

    public function getQuestions()
    {
        $product = $this->getProduct();

        if (!$product) {
            return [];
        }

        $searchCriteria = $this->searchCriteriaBuilder->addFilter('product_id', $product->getId())->create();
        $searchResults = $this->questionRepository->getList($searchCriteria);
        
        return $searchResults->getItems();
    }
}
