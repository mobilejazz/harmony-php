<?php

namespace src\data\dataSource;

use src\data\dataSource\query\Query;
use src\domain\model\BaseModel;

interface GetDataSource {

    /**
     * Get
     *
     * @param Query $query query
     *
     * @return BaseModel
     */
    public function get(Query $query) : BaseModel;

    /**
     * Get all
     *
     * @param Query $query query
     *
     * @return BaseModel[]
     */
    public function getAll(Query $query) : array;

}