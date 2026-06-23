<?php

namespace Training\ProductQa\Plugin;

use Magento\Catalog\Model\Product;

class ProductNamePlugin
{
    public function afterGetName(Product $subject, string $result)
    {
        return $result . ' [ProductQA]' . $subject->getId();
    }
}
