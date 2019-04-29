<?php

namespace src\data\repository;

use src\data\dataSource\query\Query;
use src\data\repository\operation\Operation;
use src\domain\model\BaseModel;

/**
 * Interface PutRepository
 */
interface PutRepository {

    /**
     * Put
     * @param Query     $query     query
     * @param Operation $operation operation
     * @param BaseModel $baseModel model
     *
     * @return BaseModel
     */
    public function put(
        Query $query, Operation $operation, BaseModel $baseModel
    ) : BaseModel;

    /**
     * Put all
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     * @param array     $baseModel model
     *
     * @return mixed
     */
    public function putAll(
        Query $query, Operation $operation, array $baseModel
    );

}