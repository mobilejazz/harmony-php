<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * @template T
 */
interface PutRepository extends Repository
{
    /**
     * @param Query     $query
     * @param Operation $operation
     * @param T|null    $entity
     *
     * @return T
     */
    public function put(
        Query $query,
        Operation $operation,
        $entity = null
    );

    /**
     * @param Query                     $query
     * @param Operation                 $operation
     * @param GenericCollection<T>|null $collection
     *
     * @return GenericCollection<T>
     */
    public function putAll(
        Query $query,
        Operation $operation,
        GenericCollection $collection = null
    ): GenericCollection;
}
