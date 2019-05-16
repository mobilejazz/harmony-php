<?php

namespace harmony\data\dataSource;

use harmony\data\dataSource\query\Query;
use harmony\domain\model\BaseModel;

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