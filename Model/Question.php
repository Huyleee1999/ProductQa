<?php

namespace Training\ProductQa\Model;

use Magento\Framework\Model\AbstractModel;
use Training\ProductQa\Api\Data\QuestionInterface;

class Question extends AbstractModel implements QuestionInterface
{
    protected function _construct()
    {
        $this->_init(\Training\ProductQa\Model\ResourceModel\Question::class);
    }

    public function getQuestionId()
    {
        return $this->getData(
            self::QUESTION_ID
        );
    }

    public function setQuestionId(int $id)
    {
        return $this->setData(
            self::QUESTION_ID,
            $id
        );
    }

    public function getQuestionText()
    {
        return $this->getData(
            self::QUESTION_TEXT
        );
    }

    public function setQuestionText(string $text)
    {
        return $this->setData(
            self::QUESTION_TEXT,
            $text
        );
    }

    public function getStatus()
    {
        return $this->getData(
            self::STATUS
        );
    }

    public function setStatus(string $status)
    {
        return $this->setData(
            self::STATUS,
            $status
        );
    }

    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    public function setProductId(int $id)
    {
        return $this->setData(self::PRODUCT_ID, $id);
    }

    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    public function setCustomerId(?int $id)
    {
        return $this->setData(self::CUSTOMER_ID, $id);
    }

    public function getAnswerText()
    {
        return $this->getData(self::ANSWER_TEXT);
    }

    public function setAnswerText(?string $text)
    {
        return $this->setData(self::ANSWER_TEXT, $text);
    }
}
