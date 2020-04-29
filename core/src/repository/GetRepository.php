<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

/**
 * @template T
 */
interface GetRepository extends Repository
{
    /**
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return T
     */
    public function get(
        Query $query,
        Operation $operation
    );

    /**
     * @param Query     $query
     * @param Operation $operation
     *
     * @return array<T>
     */
    public function getAll(
        Query $query,
        Operation $operation
    ): array;
}
