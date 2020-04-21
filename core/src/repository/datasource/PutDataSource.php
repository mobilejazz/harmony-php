<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * @template T
 */
interface PutDataSource
{
    /**
     * @param Query  $query
     * @param T|null $baseModel
     *
     * @return T
     */
    public function put(Query $query, $baseModel = null);

    /**
     * @param Query                     $query
     * @param GenericCollection<T>|null $baseModels
     *
     * @return GenericCollection<T>
     */
    public function putAll(
        Query $query,
        GenericCollection $baseModels = null
    ): GenericCollection;
}
