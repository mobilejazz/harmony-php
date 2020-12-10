<?php

namespace harmony\core\repository;

use harmony\core\repository\datasource\DeleteDataSource;
use harmony\core\repository\datasource\GetDataSource;
use harmony\core\repository\datasource\PutDataSource;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

/**
 * @template   T
 * @implements GetRepository<T>
 * @implements PutRepository<T>
 */
class SingleDataSourceRepository implements
    GetRepository,
    PutRepository,
    DeleteRepository
{
    /** @var GetDataSource<T> */
    private $getDataSource;
    /** @var PutDataSource<T> */
    private $putDataSource;
    /** @var DeleteDataSource */
    private $deleteDataSource;

    /**
     * @param GetDataSource<T> $getDataSource
     * @param PutDataSource<T> $putDataSource
     * @param DeleteDataSource $deleteDataSource
     */
    public function __construct(
        GetDataSource $getDataSource,
        PutDataSource $putDataSource,
        DeleteDataSource $deleteDataSource
    ) {
        $this->getDataSource = $getDataSource;
        $this->putDataSource = $putDataSource;
        $this->deleteDataSource = $deleteDataSource;
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

    /**
     * @inheritdoc
     */
    public function put(Query $query, Operation $operation, $model = null)
    {
        return $this->putDataSource->put($query, $model);
    }

    /**
     * @inheritdoc
     */
    public function putAll(
        Query $query,
        Operation $operation,
        array $models = null
    ): array {
        return $this->putDataSource->putAll($query, $models);
    }

    /**
     * @inheritdoc
     */
    public function delete(Query $query, Operation $operation): void
    {
        $this->deleteDataSource->delete($query);
    }
}
