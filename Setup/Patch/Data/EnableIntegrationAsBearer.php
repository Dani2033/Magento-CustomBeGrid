<?php


namespace Drf\CustomBeGrid\Setup\Patch\Data;


use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class EnableIntegrationAsBearer implements DataPatchInterface
{
   public function __construct(
       private ModuleDataSetupInterface $moduleDataSetup,
       private WriterInterface $configWriter
   ) {
   }


   public function apply()
   {
       $this->moduleDataSetup->startSetup();


       $this->configWriter->save(
           'enable_integration_as_bearer',
           1,
           \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
           0
       );


       $this->moduleDataSetup->endSetup();
   }


   public static function getDependencies()
   {
       return [];
   }


   public function getAliases()
   {
       return [];
   }
}
