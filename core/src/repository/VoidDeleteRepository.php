<?php

namespace harmony\core\repository;

use harmony\core\error\MethodNotImplementedException;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

class VoidDeleteRepository
    implements DeleteRepository
{
    /**
     * @param Query $query
     * @param Operation $operation
     * @throws MethodNotImplementedException
     */
    public function delete(Query $query, Operation $operation)
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     * @param Operation $operation
     * @throws MethodNotImplementedException
     */
    public function deleteAll(Query $query, Operation $operation)
    {
        throw new MethodNotImplementedException();
    }
}