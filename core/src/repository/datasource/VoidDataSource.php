<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use harmony\core\shared\error\MethodNotImplementedException;

class VoidDataSource implements GetDataSource, PutDataSource, DeleteDataSource
{
    /**
     * @param Query $query
     *
     * @return BaseEntity
     * @throws MethodNotImplementedException
     */
    public function get(Query $query): BaseEntity
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     *
     * @return GenericCollection
     * @throws MethodNotImplementedException
     */
    public function getAll(Query $query): GenericCollection
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query      $query
     * @param BaseEntity $baseModel
     *
     * @return BaseEntity
     * @throws MethodNotImplementedException
     */
    public function put(Query $query, BaseEntity $baseModel): BaseEntity
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query             $query
     * @param GenericCollection $baseModels
     *
     * @return GenericCollection
     * @throws MethodNotImplementedException
     */
    public function putAll(Query $query, GenericCollection $baseModels): GenericCollection
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     *
     * @return void
     * @throws MethodNotImplementedException
     */
    public function delete(Query $query): void
    {
        throw new MethodNotImplementedException();
    }
}
