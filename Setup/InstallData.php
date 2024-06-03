<?php
namespace Drf\CustomBeGrid\Setup;

use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Integration\Model\ConfigBasedIntegrationManager;


class InstallData implements InstallDataInterface
{
    protected $categorySetupFactory;
   
    private $integrationManager;
    

    public function __construct (
        CategorySetupFactory $categorySetupFactory,
        ConfigBasedIntegrationManager $integrationManager
    ) {
        $this->categorySetupFactory = $categorySetupFactory;
        $this->integrationManager = $integrationManager;
    }
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
        $entityTypeId = $categorySetup->getEntityTypeId(\Magento\Catalog\Model\Category::ENTITY);
        $attributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);
        $categorySetup->removeAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'custom_thumbnail' );
        $categorySetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'custom_thumbnail', [
                'type' => 'varchar',
                'label' => 'Custom Thumbnail',
                'input' => 'image',
                'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                'required' => false,
                'sort_order' => 5,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]
        );

        $this->integrationManager->processIntegrationConfig(['TestIntegration']);

        $installer->endSetup();
    }
}