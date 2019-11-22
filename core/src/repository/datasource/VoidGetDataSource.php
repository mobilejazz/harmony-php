<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use harmony\core\shared\error\MethodNotImplementedException;

class VoidGetDataSource implements GetDataSource
{
    /**
     * @param Query $query
     *
     * @return BaseEntity
     * @throws MethodNotImplementedException
     */
    public function get(Query $query): BaseEntity
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     *
     * @return GenericCollection
     * @throws MethodNotImplementedException
     */
    public function getAll(Query $query): GenericCollection
    {
        throw new MethodNotImplementedException();
    }
}
