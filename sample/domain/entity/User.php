<?php

namespace sample\domain\entity;

use src\domain\model\BaseModel;

class User extends BaseModel {

    /** @var integer */
    private $id;
    /** @var string */
    private $name;

    /**
     * UserEntity constructor.
     *
     * @param int    $id   id
     * @param string $name name
     */
    public function __construct(int $id, string $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
}