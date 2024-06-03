<?php
// app/code/Magently/RestApi/Model/Api/ResponseItem.php

namespace Drf\CustomBeGrid\Model\Api;

use Drf\CustomBeGrid\Api\ResponseItemInterface;
use Magento\Framework\DataObject;

/**
 * Class ResponseItem
 */
class ResponseItem extends DataObject implements ResponseItemInterface
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->_getData(self::DATA_ID);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->_getData(self::DATA_PATH);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_getData(self::DATA_NAME);
    }


    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id)
    {
        return $this->setData(self::DATA_ID, $id);
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath(string $path)
    {
        return $this->setData(self::DATA_PATH, $path);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        return $this->setData(self::DATA_NAME, $name);
    }

}