<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\error\MethodNotImplementedException;

class VoidDeleteRepository implements DeleteRepository
{
    /**
     * @param Query     $query
     * @param Operation $operation
     *
     * @return void
     * @throws MethodNotImplementedException
     */
    public function delete(Query $query, Operation $operation): void
    {
        throw new MethodNotImplementedException();
    }
}
