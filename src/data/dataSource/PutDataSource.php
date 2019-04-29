<?php

namespace src\data\dataSource;

use src\data\dataSource\query\Query;
use src\domain\model\BaseModel;

/**
 * Interface PutDataSource
 */
interface PutDataSource {

    /**
     * Put
     *
     * @param Query      $query      query
     * @param BaseModel $baseModel entity
     *
     * @return BaseModel
     */
    public function put(Query $query, BaseModel $baseModel) : BaseModel;

    /**
     * Put all
     *
     * @param Query       $query      query
     * @param BaseModel[] $baseModels entities
     *
     * @return void
     */
    public function putAll(Query $query, array $baseModels);

}