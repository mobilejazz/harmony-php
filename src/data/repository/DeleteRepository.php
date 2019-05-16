<?php

namespace harmony\data\repository;

use harmony\data\dataSource\query\Query;
use harmony\data\repository\operation\Operation;

/**
 * Interface DeleteRepository
 */
interface DeleteRepository {

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