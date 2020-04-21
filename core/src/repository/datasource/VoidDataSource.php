<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use harmony\core\shared\error\MethodNotImplementedException;

/**
 * @template   T
 * @implements GetDataSource<T>
 * @implements PutDataSource<T>
 */
class VoidDataSource implements GetDataSource, PutDataSource, DeleteDataSource
{
    /**
     * @inheritdoc
     */
    public function get(Query $query)
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @inheritdoc
     */
    public function getAll(Query $query): GenericCollection
    {
        throw new MethodNotImplementedException();
    }

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

    /**
     * @inheritdoc
     */
    public function delete(Query $query): void
    {
        throw new MethodNotImplementedException();
    }
}
