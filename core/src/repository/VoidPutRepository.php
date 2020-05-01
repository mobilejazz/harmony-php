<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use harmony\core\shared\error\MethodNotImplementedException;

class VoidPutRepository implements PutRepository
{
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
}
