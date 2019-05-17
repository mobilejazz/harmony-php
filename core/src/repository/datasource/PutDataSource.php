<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseHarmony;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * Interface PutDataSource
 */
interface PutDataSource
{
    /**
     * @param Query       $query
     * @param BaseHarmony $baseModel
     *
     * @return BaseHarmony
     */
    public function put(Query $query, BaseHarmony $baseModel): BaseHarmony;

    /**
     * @param Query             $query
     * @param GenericCollection $baseModels
     *
     * @return mixed
     */
    public function putAll(Query $query, GenericCollection $baseModels);
}
