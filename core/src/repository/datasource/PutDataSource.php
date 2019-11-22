<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * Interface PutDataSource
 */
interface PutDataSource
{
    /**
     * @param Query      $query
     * @param BaseEntity $baseModel
     *
     * @return BaseEntity
     */
    public function put(Query $query, BaseEntity $baseModel): BaseEntity;

    /**
     * @param Query             $query
     * @param GenericCollection $baseModels
     *
     * @return GenericCollection
     */
    public function putAll(Query $query, GenericCollection $baseModels): GenericCollection;
}
