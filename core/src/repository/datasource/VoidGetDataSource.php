<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use harmony\core\shared\error\MethodNotImplementedException;

/**
 * @template T
 * @implements GetDataSource<T>
 */
class VoidGetDataSource implements GetDataSource
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
}
