<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use harmony\core\shared\error\MethodNotImplementedException;

/**
 * @template T2
 * @implements PutDataSource<T2>
 */
class VoidPutDataSource implements PutDataSource
{
    /**
     * @inheritdoc
     */
    public function put(Query $query, BaseEntity $baseModel = null): BaseEntity
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
