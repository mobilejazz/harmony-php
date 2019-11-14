<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\query\Query;

interface DeleteDataSource
{
    /**
     * @param Query $query
     *
     * @return bool
     */
    public function delete(Query $query): bool;

    /**
     * @param Query $query
     *
     * @return bool
     */
    public function deleteAll(Query $query): bool;
}
