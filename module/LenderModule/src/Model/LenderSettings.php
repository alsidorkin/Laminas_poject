<?php

declare(strict_types=1);

namespace LenderModule\Model;

class LenderSettings implements ModelInterface
{
    /** @var string|null*/
    protected $username;

    /** @var array|null*/
    protected $returnUrls;

    /** @var string|null*/
    protected $requestType;

    /** @var bool|null*/
    protected $testMode;

    /** @var array|null*/
    protected $orderDetails;

     /** @var array|null*/
    protected $customerDetails;

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getReturnUrls(): ?array
    {
        return $this->returnUrls;
    }

    public function getRequestType(): ?string
    {
        return $this->requestType;
    }

    public function isTestMode(): ?bool
    {
        return $this->testMode;
    }

    public function getOrderDetails(): ?array
    {
        return $this->orderDetails;
    }

    public function getCustomerDetails(): ?array
    {
        return $this->customerDetails;
    }
}
