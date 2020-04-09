<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use harmony\core\shared\error\MethodNotImplementedException;

/**
 * @template T2
 * @implements GetDataSource<T2>
 */
class VoidGetDataSource implements GetDataSource
{
    /**
     * @inheritdoc
     */
    public function get(Query $query): BaseEntity
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
