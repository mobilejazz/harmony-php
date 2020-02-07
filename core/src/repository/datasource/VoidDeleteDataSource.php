<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\query\Query;
use harmony\core\shared\error\MethodNotImplementedException;

class VoidDeleteDataSource implements DeleteDataSource
{
    /**
     * @param Query $query
     *
     * @return bool
     * @throws MethodNotImplementedException
     */
    public function delete(Query $query): bool
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     *
     * @return bool
     * @throws MethodNotImplementedException
     */
    public function deleteAll(Query $query): bool
    {
        throw new MethodNotImplementedException();
    }
}
