<?php

namespace harmony\core\repository\datasource;

use harmony\core\error\MethodNotImplementedException;
use harmony\core\repository\BaseHarmony;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

class VoidDataSource implements GetDataSource, PutDataSource, DeleteDataSource
{
    /**
     * @param Query $query
     * @throws MethodNotImplementedException
     *
     * @return void
     */
    public function delete(Query $query)
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     * @throws MethodNotImplementedException
     *
     * @return void
     */
    public function deleteAll(Query $query)
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     * @return BaseHarmony
     * @throws MethodNotImplementedException
     */
    public function get(Query $query): BaseHarmony
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     * @return GenericCollection
     * @throws MethodNotImplementedException
     */
    public function getAll(Query $query): GenericCollection
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     * @param BaseHarmony $baseModel
     * @return BaseHarmony
     * @throws MethodNotImplementedException
     */
    public function put(Query $query, BaseHarmony $baseModel): BaseHarmony
    {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     * @param GenericCollection $baseModels
     * @throws MethodNotImplementedException
     *
     * @return void
     */
    public function putAll(Query $query, GenericCollection $baseModels)
    {
        throw new MethodNotImplementedException();
    }
}
