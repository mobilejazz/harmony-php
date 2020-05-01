<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use harmony\core\shared\error\MethodNotImplementedException;

class VoidRepository implements GetRepository, PutRepository, DeleteRepository
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

    /**
     * @param Query           $query
     * @param Operation       $operation
     * @param BaseEntity|null $entity
     *
     * @return BaseEntity
     * @throws MethodNotImplementedException
     */
    public function put(
        Query $query,
        Operation $operation,
        BaseEntity $entity = null
    ): BaseEntity {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query                  $query
     * @param Operation              $operation
     * @param GenericCollection|null $collection
     *
     * @return GenericCollection
     * @throws MethodNotImplementedException
     */
    public function putAll(
        Query $query,
        Operation $operation,
        GenericCollection $collection = null
    ): GenericCollection {
        throw new MethodNotImplementedException();
    }

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
