<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

interface PutRepository
{
    /**
     * @param Query      $query     query
     * @param Operation  $operation operation
     * @param BaseEntity $entity    model
     *
     * @return BaseEntity
     */
    public function put(
        Query $query,
        Operation $operation,
        BaseEntity $entity
    ): BaseEntity;

    /**
     * @param Query             $query
     * @param Operation         $operation
     * @param GenericCollection $collection
     *
     * @return mixed
     */
    public function putAll(
        Query $query,
        Operation $operation,
        GenericCollection $collection
    ): GenericCollection;
}
