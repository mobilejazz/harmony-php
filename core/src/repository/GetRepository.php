<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

interface GetRepository extends Repository
{
    /**
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return BaseEntity
     */
    public function get(
        Query $query,
        Operation $operation
    ): BaseEntity;

    /**
     * @param Query     $query
     * @param Operation $operation
     *
     * @return GenericCollection
     */
    public function getAll(
        Query $query,
        Operation $operation
    ): GenericCollection;
}
