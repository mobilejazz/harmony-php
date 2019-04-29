<?php

namespace src\data\repository;

use src\data\dataSource\query\Query;

interface DeleteDataSource {

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