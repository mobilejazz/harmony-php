<?php

namespace harmony\core\repository\datasource;

use harmony\core\error\MethodNotImplementedException;
use harmony\core\repository\BaseHarmony;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

class VoidGetDataSource implements GetDataSource
{
    /**
     * @param Query $query
     * @return BaseHarmony
     * @throws MethodNotImplementedException
     */
    public function get(Query $query): BaseHarmony
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     * @return GenericCollection
     * @throws MethodNotImplementedException
     */
    public function getAll(Query $query): GenericCollection
    {
        throw new MethodNotImplementedException();
    }
}
