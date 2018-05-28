<?php
/*
 * Macfadyen_CustomerCustomAttributes

 * @category   Macfadyen
 * @package    Macfadyen_CustomerCustomAttributes
 * @version    1.0.0
 */
namespace Macfadyen\CustomerCustomAttributes\Api\Rewrite\Customer\Data;

use Magento\Customer\Api\Data\AddressInterface as MainAddressInterface;

interface AddressInterface extends MainAddressInterface
{
    
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ADDRESS = 'address_type';
    /**#@-*/
    
    /**
     * Get the house number
     * @return int
     */
    public function getAddressType();

    
    /**
     * Set house number
     * @param int $addresstype
     * @return $this
     */
    public function setAddressType($addresstype);
    
    
    
}