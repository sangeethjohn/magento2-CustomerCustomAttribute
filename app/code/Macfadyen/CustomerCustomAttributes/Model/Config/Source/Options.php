<?php
/*
 * Macfadyen_CustomerCustomAttributes

 * @category   Macfadyen
 * @package    Macfadyen_CustomerCustomAttributes
 * @version    1.0.0
 */
namespace Macfadyen\CustomerCustomAttributes\Model\Config\Source;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;

use Magento\Framework\DB\Ddl\Table;

/**

* Custom Attribute Renderer

*/

class Options extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource

{

/**

* @var OptionFactory

*/

protected $optionFactory;

/**

* @param OptionFactory $optionFactory

*/

/**

* Get all options

*

* @return array

*/

public function getAllOptions()

{

/* your Attribute options list*/

$this->_options=[ ['label'=>'Select Options', 'value'=>''],

['label'=>'Residential', 'value'=>'0'],

['label'=>'Business', 'value'=>'1']

];

return $this->_options;

}

}
