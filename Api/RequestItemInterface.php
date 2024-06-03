<?php

namespace Drf\CustomBeGrid\Api;

/**
 * Interface RequestItemInterface
 *
 * @api
 */
interface RequestItemInterface
{
    const DATA_ID = 'id';
    const DATA_NAME = 'name';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id);

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name);
}