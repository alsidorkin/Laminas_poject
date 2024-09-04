<?php
namespace LenderModule\Model;

class LenderSettings implements ModelInterface
{
    protected $username;
    protected $returnUrls;
    protected $requestType;
    protected $testMode;
    protected $orderDetails;
    protected $customerDetails;

    public function getUsername()
    {
        return $this->username;
    }

    public function getReturnUrls()
    {
        return $this->returnUrls;
    }

    public function getRequestType()
    {
        return $this->requestType;
    }

    public function isTestMode()
    {
        return $this->testMode;
    }

    public function getOrderDetails()
    {
        return $this->orderDetails;
    }
    
    public function getCustomerDetails()
    {
        return $this->customerDetails;
    }
}
