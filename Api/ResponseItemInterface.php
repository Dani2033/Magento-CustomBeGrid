<?php

namespace Drf\CustomBeGrid\Api;

/**
 * Interface ResponseItemInterface
 *
 * @api
 */
interface ResponseItemInterface
{
    const DATA_ID = 'id';
    const DATA_PATH = 'path';
    const DATA_NAME = 'name';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getPath();

    /**
     * @return string
     */
    public function getName();

    // setters:

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id);

    /**
     * @param string $path
     * @return $this
     */
    public function setPath(string $path);

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name);

}