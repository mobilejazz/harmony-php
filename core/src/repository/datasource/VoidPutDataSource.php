<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\query\Query;
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
    public function put(Query $query, $entity = null)
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @inheritdoc
     */
    public function putAll(Query $query, array $entities = null): array
    {
        throw new MethodNotImplementedException();
    }
}
