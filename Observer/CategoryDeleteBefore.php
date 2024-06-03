<?php
/**
 * Copyright &copy; Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Drf\CustomBeGrid\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class CategoryDeleteBefore implements ObserverInterface
{
    protected $_logger;
    public function __construct(
        LoggerInterface $logger,
    ) {
        $this->_logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $category = $observer->getEvent()->getCategory();
        $this->_logger->info('Categoria borrada: "' . $category->getName() . '"');
    }
}