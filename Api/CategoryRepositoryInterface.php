<?php

namespace Drf\CustomBeGrid\Api;

/**
 * Interface CategoryRepositoryInterface
 *
 * @api
 */
interface CategoryRepositoryInterface
{
    /**
     * Return a filtered category.
     *
     * @param int $id
     * @return \Drf\CustomBeGrid\Api\ResponseItemInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getItem(int $id);

    /**
     * Return a list of the filtered categories.
     *
     * @return \Drf\CustomBeGrid\Api\ResponseItemInterface[]
     */
    public function getList();
    
}