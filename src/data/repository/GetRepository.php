<?php

namespace harmony\data\repository;

use harmony\data\dataSource\query\Query;
use harmony\data\repository\operation\Operation;
use harmony\domain\model\BaseCollection;
use harmony\domain\model\BaseHarmony;

/**
 * Interface GetRepository
 */
interface GetRepository {

    /**
     * Get
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return BaseHarmony
     */
    public function get(
        Query $query, Operation $operation
    ) : BaseHarmony;

    /**
     * Get all
     *
     * @param Query     $query
     * @param Operation $operation
     *
     * @return BaseCollection
     */
    public function getAll(
        Query $query, Operation $operation
    ) : BaseCollection;
}