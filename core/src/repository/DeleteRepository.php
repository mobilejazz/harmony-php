<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

interface DeleteRepository
{
    /**
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return bool
     */
    public function delete(Query $query, Operation $operation): bool;

    /**
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return bool
     */
    public function deleteAll(Query $query, Operation $operation): bool;
}
