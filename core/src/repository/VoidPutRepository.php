<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use harmony\core\shared\error\MethodNotImplementedException;

class VoidPutRepository
    implements PutRepository
{
    /**
     * @param Query      $query
     * @param Operation  $operation
     * @param BaseEntity $entity
     *
     * @return BaseEntity
     * @throws MethodNotImplementedException
     */
    public function put(
        Query $query,
        Operation $operation,
        BaseEntity $entity
    ): BaseEntity {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query             $query
     * @param Operation         $operation
     * @param GenericCollection $collection
     *
     * @return GenericCollection
     * @throws MethodNotImplementedException
     */
    public function putAll(
        Query $query,
        Operation $operation,
        GenericCollection $collection
    ): GenericCollection {
        throw new MethodNotImplementedException();
    }
}
