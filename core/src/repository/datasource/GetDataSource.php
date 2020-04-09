<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * @template T
 */
interface GetDataSource
{
    /**
     * @param Query $query
     *
     * @return BaseEntity
     */
    public function get(Query $query): BaseEntity;

    /**
     * @param Query $query
     *
     * @psalm-return GenericCollection<T>
     * @return GenericCollection
     */
    public function getAll(Query $query): GenericCollection;
}
