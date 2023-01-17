<?php

namespace craft\commerce\postfinance\responses;

use craft\commerce\base\RequestResponseInterface;
use PostFinanceCheckout\Sdk\Model\TransactionState;
use PostFinanceCheckout\Sdk\Model\RefundState;

class PostfinanceResponse implements RequestResponseInterface
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    private $_redirect = '';

    /**
     * @var bool
     */
    private $_processing = false;

    /**
     * Construct the response
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Set the redirect URL.
     *
     * @param string $url
     */
    public function setRedirectUrl(string $url): void
    {
        $this->_redirect = $url;
    }

    /**
     * Set processing status.
     *
     * @param bool $status
     */
    public function setProcessing(bool $status): void
    {
        $this->_processing = $status;
    }

    /**
     * @inheritdoc
     */
    public function isSuccessful(): bool
    {
        if (empty($this->data['status'])) {
            return false;
        }
        return array_key_exists('status', $this->data) && in_array($this->data['status'], [TransactionState::FULFILL, RefundState::SUCCESSFUL]);
    }

    /**
     * @inheritdoc
     */
    public function isProcessing(): bool
    {
        return $this->_processing;
    }

    /**
     * @inheritdoc
     */
    public function isRedirect(): bool
    {
        return !empty($this->_redirect);
    }

    /**
     * @inheritdoc
     */
    public function getRedirectMethod(): string
    {
        return 'GET';
    }

    /**
     * @inheritdoc
     */
    public function getRedirectData(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getRedirectUrl(): string
    {
        return $this->_redirect;
    }

    /**
     * @inheritdoc
     */
    public function getTransactionReference(): string
    {
        if (empty($this->data['reference'])) {
            return '';
        }

        return (string)$this->data['reference'];
    }

    /**
     * @inheritdoc
     */
    public function getCode(): string
    {
        if (empty($this->data['code'])) {
            return '';
        }

        return $this->data['code'];
    }

    /**
     * @inheritdoc
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @inheritdoc
     */
    public function getMessage(): string
    {
        if (empty($this->data['message'])) {
            return '';
        }

        return $this->data['message'];
    }

    /**
     * @inheritdoc
     */
    public function redirect(): void
    {
        return;
    }
}
