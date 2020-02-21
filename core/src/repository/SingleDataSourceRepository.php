<?php

namespace harmony\core\repository;

use harmony\core\repository\datasource\DeleteDataSource;
use harmony\core\repository\datasource\GetDataSource;
use harmony\core\repository\datasource\PutDataSource;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

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
     * @param Query     $query
     * @param Operation $operation
     *
     * @return BaseEntity
     */
    public function get(Query $query, Operation $operation): BaseEntity
    {
        return $this->getDataSource->get($query);
    }

    /**
     * @param Query     $query
     * @param Operation $operation
     *
     * @return GenericCollection
     */
    public function getAll(Query $query, Operation $operation): GenericCollection
    {
        return $this->getDataSource->getAll($query);
    }

    /**
     * @param Query      $query
     * @param Operation  $operation
     * @param BaseEntity $entity
     *
     * @return BaseEntity
     */
    public function put(Query $query, Operation $operation, BaseEntity $entity): BaseEntity
    {
        return $this->putDataSource->put($query, $entity);
    }

    /**
     * @param Query             $query
     * @param Operation         $operation
     * @param GenericCollection $baseModels
     *
     * @return GenericCollection
     */
    public function putAll(Query $query, Operation $operation, GenericCollection $baseModels): GenericCollection
    {
        return $this->putDataSource->putAll($query, $baseModels);
    }

    /**
     * @param Query     $query
     * @param Operation $operation
     *
     * @return void
     */
    public function delete(Query $query, Operation $operation): void
    {
        $this->deleteDataSource->delete($query);
    }
}
