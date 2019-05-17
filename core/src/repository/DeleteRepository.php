<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

/**
 * Interface DeleteRepository
 */
interface DeleteRepository
{
    /**
     * Delete
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return void
     */
    public function delete(Query $query, Operation $operation);

    /**
     * Delete all
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return void
     */
    public function deleteAll(Query $query, Operation $operation);
}
