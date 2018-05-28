<?php
 
namespace Macfadyen\CustomerCustomAttributes\Plugin;

/*
 * Macfadyen_CustomerCustomAttributes

 * @category   Macfadyen
 * @package    Macfadyen_CustomerCustomAttributes
 * @version    1.0.0
 */
class Book
{   /**
     * @var \Magento\Customer\Helper\Session\CurrentCustomer
     */
    protected $currentCustomer;
    
     /**
     * @var \Magento\Customer\Model\Address\Config
     */
    protected $_addressConfig;
    
    /**
     * @var \Magento\Framework\App\ObjectManager
     */
    protected $_customerRepository;

    public function __construct(
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        \Magento\Customer\Model\Address\Config $addressConfig,
        \Magento\Customer\Api\CustomerRepositoryInterface $CustomerRepository
        
    ) {
        
        $this->currentCustomer = $currentCustomer;
         $this->_addressConfig = $addressConfig; 
         $this->_customerRepository = $CustomerRepository;
    }
     /**
     * Render an address as HTML and return the result
     *
     * @param \Magento\Customer\Api\Data\AddressInterface $address
     * @return string
     */
    public function aftergetAddressHtml(\Magento\Customer\Block\Address\Book\Interceptor $subject, $result = null)
    {
        $custid =  $this->currentCustomer->getCustomerId();        
        $customer = $this->_customerRepository->getById($custid);        
        echo $cattrValue = "Address Type".$customer->getCustomAttribute('address_type').'<br>';
        return $result;
    }

    
  
}
