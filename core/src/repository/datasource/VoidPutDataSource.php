<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use harmony\core\shared\error\MethodNotImplementedException;

/**
 * @template   T
 * @implements PutDataSource<T>
 */
class VoidPutDataSource implements PutDataSource
{
    /**
     * @inheritdoc
     */
    public function put(Query $query, $baseModel = null)
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @inheritdoc
     */
    public function putAll(
        Query $query,
        GenericCollection $baseModels = null
    ): GenericCollection {
        throw new MethodNotImplementedException();
    }
}
