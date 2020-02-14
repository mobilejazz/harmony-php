<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\query\Query;

interface DeleteDataSource
{
    /**
     * @param Query $query
     *
     * @return void
     */
    public function delete(Query $query): void;
}
