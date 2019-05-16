<?php

namespace harmony\data\dataSource;

use harmony\data\dataSource\query\Query;
use harmony\domain\model\BaseCollection;
use harmony\domain\model\BaseHarmony;

/**
 * Interface PutDataSource
 */
interface PutDataSource {

    /**
     * Put
     *
     * @param Query      $query      query
     * @param BaseHarmony $baseModel entity
     *
     * @return BaseHarmony
     */
    public function put(Query $query, BaseHarmony $baseModel) : BaseHarmony;

    /**
     * Put all
     *
     * @param Query       $query      query
     * @param BaseCollection $baseModels entities
     *
     * @return void
     */
    public function putAll(Query $query, BaseCollection $baseModels);

}