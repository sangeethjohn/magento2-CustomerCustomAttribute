<?php

namespace Macfadyen\CustomerCustomAttributes\Model\Rewrite\Customer\Data;

class Address extends \Magento\Customer\Model\Data\Address implements
    \Macfadyen\CustomerCustomAttributes\Api\Rewrite\Customer\Data\AddressInterface
{

    /**
     * Get the address type
     * @return int
     */
    public function getAddressType()
    {
        return $this->_get(self::ADDRESS);
    }

   
    
    /**
     * Set address type
     * @param int $addresstype
     * @return $this
     */
    public function setAddressType($addresstype)
    {
        return $this->setData(self::ADDRESS, $addresstype);
    }
    
    

}