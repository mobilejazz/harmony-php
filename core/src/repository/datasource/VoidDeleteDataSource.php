<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\query\Query;
use harmony\core\shared\error\MethodNotImplementedException;

class VoidDeleteDataSource implements DeleteDataSource
{
    /**
     * @param Query $query
     *
     * @return void
     * @throws MethodNotImplementedException
     *
     */
    public function delete(Query $query)
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     *
     * @return void
     * @throws MethodNotImplementedException
     *
     */
    public function deleteAll(Query $query)
    {
        throw new MethodNotImplementedException();
    }
}
