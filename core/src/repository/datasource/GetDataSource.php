<?php

namespace harmony\core\repository\datasource;


use harmony\core\repository\BaseHarmony;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

interface GetDataSource
{
    /**
     * Get
     *
     * @param Query $query query
     *
     * @return BaseHarmony
     */
    public function get(Query $query): BaseHarmony;

    /**
     * @param Query $query
     *
     * @return GenericCollection
     */
    public function getAll(Query $query): GenericCollection;
}
