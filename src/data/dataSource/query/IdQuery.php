<?php

namespace src\data\dataSource\query;

class IdQuery extends Query {

    /** @var mixed */
    private $id;

    /**
     * IdQuery constructor.
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}