<?php

namespace harmony\core\repository;

use harmony\core\repository\datasource\GetDataSource;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

class SingleGetDataSourceRepository
    implements GetRepository
{
    /** @var GetDataSource */
    private $getDataSource;

    /**
     * SingleDataSourceRepository constructor.
     *
     * @param GetDataSource $getDataSource data source
     */
    public function __construct(
        GetDataSource $getDataSource
    ) {
        $this->getDataSource = $getDataSource;
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
}
