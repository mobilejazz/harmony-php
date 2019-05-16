<?php

namespace harmony\data\repository;

use harmony\data\dataSource\DeleteDataSource;
use harmony\data\dataSource\GetDataSource;
use harmony\data\dataSource\PutDataSource;
use harmony\data\dataSource\query\Query;
use harmony\data\repository\operation\Operation;
use harmony\domain\model\BaseCollection;
use harmony\domain\model\BaseHarmony;

class SingleDataSourceRepository
    implements GetRepository, PutRepository, DeleteRepository {

    /** @var GetDataSource */
    private $getDataSource;
    /** @var PutDataSource */
    private $putDataSource;
    /** @var DeleteDataSource */
    private $deleteDataSource;

    /**
     * SingleDataSourceRepository constructor.
     *
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
     * Delete
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return mixed
     */
    public function delete(Query $query, Operation $operation)
    {
        return $this->deleteDataSource->delete($query);
    }

    /**
     * Delete all
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return mixed
     */
    public function deleteAll(Query $query, Operation $operation)
    {
        return $this->deleteDataSource->deleteAll($query);
    }

    /**
     * @param Query $query
     * @param Operation $operation
     * @return BaseHarmony
     */
    public function get(Query $query, Operation $operation): BaseHarmony
    {
        return $this->getDataSource->get($query);
    }

    /**
     * Get all
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return BaseCollection
     */
    public function getAll(Query $query, Operation $operation) : BaseCollection
    {
        return $this->getDataSource->getAll($query);
    }

    /**
     * Put
     *
     * @param Query $query
     * @param Operation $operation
     * @param BaseHarmony $baseModel
     *
     * @return BaseHarmony
     */
    public function put(Query $query, Operation $operation, BaseHarmony $baseModel): BaseHarmony
    {
        return $this->putDataSource->put($query, $baseModel);
    }

    /**
     * Put all
     *
     * @param Query     $query
     * @param Operation $operation
     *
     * @param BaseCollection $baseModels
     *
     * @return void
     */
    public function putAll(Query $query, Operation $operation, BaseCollection $baseModels)
    {
        $this->putDataSource->putAll($query, $baseModels);
    }
}