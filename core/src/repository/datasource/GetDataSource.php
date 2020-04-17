<?php

namespace harmony\core\repository\datasource;

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
     * @return T
     */
    public function get(Query $query);

    /**
     * @param Query $query
     *
     * @return GenericCollection<T>
     */
    public function getAll(Query $query): GenericCollection;
}
