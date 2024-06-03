<?php

namespace Drf\CustomBeGrid\Model\Api;

use Drf\CustomBeGrid\Api\CategoryRepositoryInterface;
use Drf\CustomBeGrid\Api\RequestItemInterfaceFactory;
use Drf\CustomBeGrid\Api\ResponseItemInterfaceFactory;
use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class CategoryRepository
 */
class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     */
    private $categoryCollectionFactory;

    /**
     * @var \Drf\CustomBeGrid\Api\RequestItemInterfaceFactory
     */
    private $requestItemFactory;

    /**
     * @var \Drf\CustomBeGrid\Api\ResponseItemInterfaceFactory
     */
    private $responseItemFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
     * @param \Drf\CustomBeGrid\Api\RequestItemInterfaceFactory $requestItemFactory
     * @param \Drf\CustomBeGrid\Api\ResponseItemInterfaceFactory $responseItemFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        CollectionFactory $categoryCollectionFactory,
        RequestItemInterfaceFactory $requestItemFactory,
        ResponseItemInterfaceFactory $responseItemFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->requestItemFactory = $requestItemFactory;
        $this->responseItemFactory = $responseItemFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritDoc}
     *
     * @param int $id
     * @return \Drf\CustomBeGrid\Api\ResponseItemInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getItem(int $id)
    {
        $collection = $this->getCategoryCollection()
            ->addAttributeToFilter('entity_id', ['eq' => $id]);

        /** @var \Magento\Catalog\Api\Data\CategoryInterface $category */
        $category = $collection->getFirstItem();
        if (!$category->getId()) {
            throw new NoSuchEntityException(__('Category not found'));
        }

        return $this->getResponseItemFromCategory($category);
    }

    /**
     * {@inheritDoc}
     *
     * @return \Drf\CustomBeGrid\Api\ResponseItemInterface[]
     */
    public function getList()
    {
        $collection = $this->getCategoryCollection();

        $result = [];
        /** @var \Magento\Catalog\Api\Data\CategoryInterface $category */
        foreach ($collection->getItems() as $category) {
            $result[] = $this->getResponseItemFromCategory($category);
        }

        return $result;
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection
     */
    private function getCategoryCollection()
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Category\Collection $collection */
        $collection = $this->categoryCollectionFactory->create();

        $collection
            ->addAttributeToSelect(
                [
                    'entity_id',
                    CategoryInterface::KEY_PATH,
                    CategoryInterface::KEY_NAME
                ],
                'left'
            );

        return $collection;
    }

    /**
     * @param \Magento\Catalog\Api\Data\CategoryInterface $category
     * @return \Drf\CustomBeGrid\Api\ResponseItemInterface
     */
    private function getResponseItemFromCategory(CategoryInterface $category)
    {
        /** @var \Drf\CustomBeGrid\Api\ResponseItemInterface $responseItem */
        $responseItem = $this->responseItemFactory->create();

        $responseItem->setId($category->getId())
            ->setPath($category->getPath())
            ->setName($category->getName());

        return $responseItem;
    }

}