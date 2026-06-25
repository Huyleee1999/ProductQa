<?php

namespace Training\ProductQa\Api\Data;

interface QuestionInterface
{
    public const QUESTION_ID = 'question_id';
    public const PRODUCT_ID = 'product_id';
    public const CUSTOMER_ID = 'customer_id';
    public const QUESTION_TEXT = 'question_text';
    public const ANSWER_TEXT = 'answer_text';
    public const STATUS = 'status';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    public function getQuestionId();

    public function setQuestionId(int $id);

    public function getQuestionText();

    public function setQuestionText(string $text);

    public function getStatus();

    public function setStatus(string $status);
}
