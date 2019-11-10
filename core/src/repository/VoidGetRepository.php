<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use harmony\core\shared\error\MethodNotImplementedException;

class VoidGetRepository
    implements GetRepository
{
    /**
     * @param Query     $query
     * @param Operation $operation
     *
     * @return BaseEntity
     * @throws MethodNotImplementedException
     */
    public function get(
        Query $query,
        Operation $operation
    ): BaseEntity {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query     $query
     * @param Operation $operation
     *
     * @return GenericCollection
     * @throws MethodNotImplementedException
     */
    public function getAll(
        Query $query,
        Operation $operation
    ): GenericCollection {
        throw new MethodNotImplementedException();
    }
}