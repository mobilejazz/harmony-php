<?php

namespace harmony\data\repository;

use harmony\data\dataSource\GetDataSource;
use harmony\data\dataSource\query\Query;
use harmony\data\repository\operation\Operation;
use harmony\domain\model\BaseModel;

class SingleGetDataSourceRepository
    implements GetRepository {

    /** @var GetDataSource */
    private $getDataSource;

    /**
     * SingleDataSourceRepository constructor.
     *
     * @param GetDataSource    $getDataSource    data source
     */
    public function __construct(
        GetDataSource $getDataSource
    ) {
        $this->getDataSource = $getDataSource;
    }

    /**
     * @param Query $query
     * @param Operation $operation
     * @return BaseModel
     */
    public function get(Query $query, Operation $operation): BaseModel
    {
        return $this->getDataSource->get($query);
    }

    /**
     * Get all
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return array
     */
    public function getAll(Query $query, Operation $operation) : array
    {
        return $this->getDataSource->getAll($query);
    }
}