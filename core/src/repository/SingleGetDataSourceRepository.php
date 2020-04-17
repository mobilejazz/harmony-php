<?php

namespace harmony\core\repository;

use harmony\core\repository\datasource\GetDataSource;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * @template T
 * @implements GetRepository<T>
 */
class SingleGetDataSourceRepository implements GetRepository
{
    /** @var GetDataSource<T> */
    private $getDataSource;

    /**
     * @param GetDataSource<T> $getDataSource
     */
    public function __construct(
        GetDataSource $getDataSource
    ) {
        $this->getDataSource = $getDataSource;
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
    public function getAll(Query $query, Operation $operation): GenericCollection
    {
        return $this->getDataSource->getAll($query);
    }
}
