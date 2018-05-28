<?php
/*
 * Macfadyen_CustomerCustomAttributes

 * @category   Macfadyen
 * @package    Macfadyen_CustomerCustomAttributes
 * @version    1.0.0
 */
namespace Macfadyen\CustomerCustomAttributes\Setup;


use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;
use Magento\Eav\Model\AttributeRepository;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig,AttributeRepository $attributeRepository
)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->_attributeRepository = $attributeRepository;

    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Indexer\Address\AttributeProvider::ENTITY,
            'address_type',
            [
                "type"     => "varchar",
                "backend"  => "",
                "label"    => "Address Type",
                "input"    => "select",
                "source"   => 'Macfadyen\CustomerCustomAttributes\Model\Config\Source\Options',
                'option' =>
                    array (
                        'values' =>
                            array (
                                0 => 'Residential',
                                1 => 'Business',
                            ),
                    ),

                "visible"  => true,
                "required" => false,
                "default" => "0",
                "system" => "0",
                "unique"     => false,
                "note"       => "",
                'sort_order' => 130,
                'position' => 100,
                'is_user_defined' => 0
            ]
        );
        $sampleAttribute = $this->eavConfig->getAttribute(\Magento\Customer\Model\Indexer\Address\AttributeProvider::ENTITY, 'address_type');
        $sampleAttribute->setData(
            'used_in_forms',
            ['customer_address_edit', 'customer_register_address']
        );
        $sampleAttribute->save();
        // allow customer_attribute attribute to be saved in the specific areas
	$attribute = $this->_attributeRepository->get('customer_address', 'address_type');
	$setup->getConnection()
	->insertOnDuplicate(
		$setup->getTable('customer_form_attribute'),
		[
			['form_code' => 'adminhtml_customer', 'attribute_id' => $attribute->getId()],
			['form_code' => 'customer_account_create', 'attribute_id' => $attribute->getId()],
			['form_code' => 'customer_account_edit', 'attribute_id' => $attribute->getId()],
		]
	);

    }
}