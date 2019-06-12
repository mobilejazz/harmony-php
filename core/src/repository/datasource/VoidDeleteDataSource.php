<?php

namespace harmony\core\repository\datasource;

use harmony\core\error\MethodNotImplementedException;
use harmony\core\repository\query\Query;

class VoidDeleteDataSource implements DeleteDataSource
{
    /**
     * @param Query $query
     * @throws MethodNotImplementedException
     *
     * @return void
     */
    public function delete(Query $query)
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     * @throws MethodNotImplementedException
     *
     * @return void
     */
    public function deleteAll(Query $query)
    {
        throw new MethodNotImplementedException();
    }
}
