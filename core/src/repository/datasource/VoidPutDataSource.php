<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use harmony\core\shared\error\MethodNotImplementedException;

class VoidPutDataSource implements PutDataSource
{
    /**
     * @param Query           $query
     * @param BaseEntity|null $baseModel
     *
     * @return BaseEntity
     * @throws MethodNotImplementedException
     */
    public function put(Query $query, BaseEntity $baseModel = null): BaseEntity
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query                  $query
     * @param GenericCollection|null $baseModels
     *
     * @return GenericCollection
     * @throws MethodNotImplementedException
     */
    public function putAll(
        Query $query,
        GenericCollection $baseModels = null
    ): GenericCollection {
        throw new MethodNotImplementedException();
    }
}
