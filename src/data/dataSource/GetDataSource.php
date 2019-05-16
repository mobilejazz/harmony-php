<?php

namespace harmony\data\dataSource;

use harmony\data\dataSource\query\Query;
use harmony\domain\model\BaseCollection;
use harmony\domain\model\BaseHarmony;

interface GetDataSource {

    /**
     * Get
     *
     * @param Query $query query
     *
     * @return BaseHarmony
     */
    public function get(Query $query) : BaseHarmony;

    /**
     * Get all
     *
     * @param Query $query query
     *
     * @return BaseCollection
     */
    public function getAll(Query $query) : BaseCollection;

}