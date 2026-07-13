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

    public const STATUS_PENDING = 'pending';
    public const STATUS_ANSWERED = 'answered';

    /**
     * Get question ID.
     *
     * @return int|null
     */
    public function getQuestionId();

    /**
     * Set question ID.
     *
     * @param int $id
     * @return $this
     */
    public function setQuestionId(int $id);

    /**
     * Get question text.
     *
     * @return string|null
     */
    public function getQuestionText();

    /**
     * Set question text.
     *
     * @param string $text
     * @return $this
     */
    public function setQuestionText(string $text);

    /**
     * Get question status.
     *
     * @return string|null
     */
    public function getStatus();

    /**
     * Set question status.
     *
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status);

    /**
     * Get product ID.
     *
     * @return int|null
     */
    public function getProductId();

    /**
     * Set product ID.
     *
     * @param int $id
     * @return $this
     */
    public function setProductId(int $id);

    /**
     * Get customer ID.
     *
     * @return int|null
     */
    public function getCustomerId();

    /**
     * Set customer ID.
     *
     * @param int|null $id
     * @return $this
     */
    public function setCustomerId(?int $id);

    /**
     * Get answer text.
     *
     * @return string|null
     */
    public function getAnswerText();

    /**
     * Set answer text.
     *
     * @param string|null $text
     * @return $this
     */
    public function setAnswerText(?string $text);
}
