<?php

namespace harmony\data\repository;

use harmony\data\dataSource\query\Query;
use harmony\data\repository\operation\Operation;
use harmony\domain\model\BaseModel;

/**
 * Interface GetRepository
 */
interface GetRepository {

    /**
     * Get
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return BaseModel
     */
    public function get(
        Query $query, Operation $operation
    ) : BaseModel;

    /**
     * Get all
     *
     * @param Query     $query
     * @param Operation $operation
     *
     * @return BaseModel[]
     */
    public function getAll(
        Query $query, Operation $operation
    ) : array;
}