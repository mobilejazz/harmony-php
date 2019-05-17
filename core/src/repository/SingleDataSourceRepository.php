<?php

namespace harmony\core\repository;

use harmony\core\repository\datasource\DeleteDataSource;
use harmony\core\repository\datasource\GetDataSource;
use harmony\core\repository\datasource\PutDataSource;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

class SingleDataSourceRepository
    implements GetRepository, PutRepository, DeleteRepository
{
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
     * @param Query     $query
     * @param Operation $operation
     *
     * @return BaseHarmony
     */
    public function get(Query $query, Operation $operation): BaseHarmony
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
     * Put
     *
     * @param Query       $query
     * @param Operation   $operation
     * @param BaseHarmony $baseModel
     *
     * @return BaseHarmony
     */
    public function put(Query $query, Operation $operation, BaseHarmony $baseModel): BaseHarmony
    {
        return $this->putDataSource->put($query, $baseModel);
    }

    /**
     * @param Query             $query
     * @param Operation         $operation
     * @param GenericCollection $baseModels
     *
     * @return mixed|void
     */
    public function putAll(Query $query, Operation $operation, GenericCollection $baseModels)
    {
        $this->putDataSource->putAll($query, $baseModels);
    }
}
