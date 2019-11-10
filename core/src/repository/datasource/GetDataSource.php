<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

interface GetDataSource
{
    /**
     * Get
     *
     * @param Query $query query
     *
     * @return BaseEntity
     */
    public function get(Query $query): BaseEntity;

    /**
     * @param Query $query
     *
     * @return GenericCollection
     */
    public function getAll(Query $query): GenericCollection;
}
