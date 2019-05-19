<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\query\Query;

interface DeleteDataSource
{
    /**
     * Delete
     *
     * @param Query $query query
     *
     * @return mixed
     */
    public function delete(Query $query);

    /**
     * Delete all
     *
     * @param Query $query query
     *
     * @return mixed
     */
    public function deleteAll(Query $query);
}
