<?php

namespace harmony\data\repository;

use harmony\data\dataSource\GetDataSource;
use harmony\data\dataSource\query\Query;
use harmony\data\repository\operation\Operation;
use harmony\domain\model\BaseCollection;
use harmony\domain\model\BaseHarmony;

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
}