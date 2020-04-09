<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * @template T
 */
interface PutDataSource
{
    /**
     * @param Query           $query
     * @param BaseEntity|null $baseModel
     *
     * @return T|BaseEntity
     */
    public function put(Query $query, BaseEntity $baseModel = null): BaseEntity;

    /**
     * @param Query                  $query
     * @param GenericCollection<T>|null $baseModels
     *
     * @return GenericCollection<T>
     */
    public function putAll(
        Query $query,
        GenericCollection $baseModels = null
    ): GenericCollection;
}
