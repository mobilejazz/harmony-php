<?php

namespace harmony\core\repository;

use harmony\core\repository\datasource\DeleteDataSource;
use harmony\core\repository\datasource\GetDataSource;
use harmony\core\repository\datasource\PutDataSource;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * @template T2
 * @implements GetRepository<T2>
 * @implements PutRepository<T2>
 */
class SingleDataSourceRepository implements GetRepository, PutRepository, DeleteRepository
{
    /** @var GetDataSource */
    private $getDataSource;
    /** @var PutDataSource */
    private $putDataSource;
    /** @var DeleteDataSource */
    private $deleteDataSource;

    /**
     * @param GetDataSource    $getDataSource    data source
     * @param PutDataSource    $putDataSource    data source
     * @param DeleteDataSource $deleteDataSource data source
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
    public function get(Query $query, Operation $operation): BaseEntity
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

    /**
     * @inheritdoc
     */
    public function put(
        Query $query,
        Operation $operation,
        BaseEntity $entity = null
    ): BaseEntity {
        return $this->putDataSource->put($query, $entity);
    }

    /**
     * @inheritdoc
     */
    public function putAll(
        Query $query,
        Operation $operation,
        GenericCollection $baseModels = null
    ): GenericCollection {
        return $this->putDataSource->putAll($query, $baseModels);
    }

    /**
     * @inheritdoc
     */
    public function delete(Query $query, Operation $operation): void
    {
        $this->deleteDataSource->delete($query);
    }
}
