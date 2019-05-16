<?php

namespace harmony\data\dataSource\query;

class IntegerIdQuery extends Query {

    /** @var integer */
    private $id;

    /**
     * IntegerIdQuery constructor.
     *
     * @param integer $id id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId() : int
    {
        return $this->id;
    }
}