<?php
/**
 * Created by PhpStorm.
 * User: sangeetha
 * Date: 28/5/18
 * Time: 12:38 PM
 */
namespace Macfadyen\CustomerCustomAttributes\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\RequestInterface;

class CustomattributeSaveObserver implements ObserverInterface
{
    /** @var CustomerRepositoryInterface */
    protected $customerRepository;
    protected $_request;
    /**
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        RequestInterface $request

    ) {
        $this->customerRepository = $customerRepository;
        $this->_request = $request;
    }

    /**
     * Manages redirect
     */
    public function execute(Observer $observer)
    {

        $customer = $observer->getCustomer();
        $customerAddress = $observer->getCustomerAddress();
        $address_type = $this->_request->getPost('address_type');
        $customerAddress->setCustomAttribute('address_type', $address_type);
        $customerAddress->save();
    }
}