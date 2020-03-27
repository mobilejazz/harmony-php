<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

interface PutRepository extends Repository
{
    /**
     * @param Query           $query
     * @param Operation       $operation
     * @param BaseEntity|null $entity
     *
     * @return BaseEntity
     */
    public function put(
        Query $query,
        Operation $operation,
        BaseEntity $entity = null
    ): BaseEntity;

    /**
     * @param Query                  $query
     * @param Operation              $operation
     * @param GenericCollection|null $collection
     *
     * @return GenericCollection
     */
    public function putAll(
        Query $query,
        Operation $operation,
        GenericCollection $collection = null
    ): GenericCollection;
}
