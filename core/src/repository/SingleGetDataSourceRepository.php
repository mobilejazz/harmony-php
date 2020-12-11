<?php

namespace harmony\core\repository;

use harmony\core\repository\datasource\GetDataSource;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

/**
 * @template   T
 * @implements GetRepository<T>
 */
class SingleGetDataSourceRepository implements GetRepository
{
    /**
     * @param GetDataSource<T> $getDataSource
     */
    public function __construct(protected GetDataSource $getDataSource)
    {
    }

    /**
     * @inheritdoc
     */
    public function get(Query $query, Operation $operation)
    {
        return $this->getDataSource->get($query);
    }

    /**
     * @inheritdoc
     */
    public function getAll(Query $query, Operation $operation): array
    {
        return $this->getDataSource->getAll($query);
    }
}
