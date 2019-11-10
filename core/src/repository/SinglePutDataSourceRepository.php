<?php

namespace harmony\core\repository;

use harmony\core\repository\datasource\PutDataSource;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

class SinglePutDataSourceRepository implements PutRepository
{
    /**
     * @var PutDataSource
     */
    protected $putDataSource;

    public function __construct(
        PutDataSource $putDataSource
    ) {
        $this->putDataSource = $putDataSource;
    }

    /**
     * @param Query      $query     query
     * @param Operation  $operation operation
     * @param BaseEntity $entity    model
     *
     * @return BaseEntity
     */
    public function put(Query $query, Operation $operation, BaseEntity $entity): BaseEntity
    {
        return $this->putDataSource->put(
            $query,
            $entity
        );
    }

    /**
     * @param Query             $query
     * @param Operation         $operation
     * @param GenericCollection $collection
     *
     * @return mixed
     */
    public function putAll(Query $query, Operation $operation, GenericCollection $collection): GenericCollection
    {
        return $this->putDataSource->putAll($query, $collection);
    }
}
