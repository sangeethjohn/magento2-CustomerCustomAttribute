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

    /**
     * @var \Magento\Framework\App\ObjectManager
     */
    protected $_addressMetadata;

    /**
     * @var \Magento\Eav\Model\ResourceModel\Entity\Attribute
     */
    protected $_eavAttribute;

    public function __construct(
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        \Magento\Customer\Model\Address\Config $addressConfig,
        \Magento\Customer\Api\CustomerRepositoryInterface $CustomerRepository,
        \Magento\Customer\Api\AddressMetadataInterface $AddressRepository,
        \Magento\Eav\Model\ResourceModel\Entity\Attribute $eavAttribute
        
    ) {
        
        $this->currentCustomer = $currentCustomer;
        $this->_addressConfig = $addressConfig;
        $this->_customerRepository = $CustomerRepository;
        $this->_addressMetadata = $AddressRepository;
        $this->_eavAttribute = $eavAttribute;
    }


    /**
     * @param int $addressId
     * @return \Magento\Customer\Api\Data\AddressInterface|null
     */
    public function aroundgetAddressById(\Magento\Customer\Block\Address\Book\Interceptor $subject,
                                         \Closure $proceed,
                                         $addressId
    )
    {
        $custid =  $this->currentCustomer->getCustomerId();
        $customer = $this->_customerRepository->getById($custid);
        $option_label = '';
        $addresses = $customer->getAddresses();
        $opt = array();
        foreach ($addresses as $address) {

            $_optionId = $address->getAddressType();
            $_attributeId = $this->_eavAttribute->getIdByCode('customer_address', 'address_type');
            $attribute = $this->_addressMetadata->getAttributeMetadata($_attributeId);
            $options = $attribute->getOptions();

            foreach ($options as $option){
                if ($option->getValue() == $_optionId){
                    $opt[$address->getId()] = $option->getLabel();
                }
            }

        };

        echo $cattrValue = "Address Type : ". $opt[$addressId].'<br>';
        $originalResult = $proceed($addressId);

        return $originalResult;




    }

    
  
}
