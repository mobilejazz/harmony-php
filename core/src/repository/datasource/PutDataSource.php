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
     * @return BaseEntity
     */
    public function put(Query $query, BaseEntity $baseModel = null): BaseEntity;

    /**
     * @param Query                  $query
     * @param GenericCollection|null $baseModels
     *
     * @psalm-return GenericCollection<T>
     * @return GenericCollection
     */
    public function putAll(
        Query $query,
        GenericCollection $baseModels = null
    ): GenericCollection;
}
