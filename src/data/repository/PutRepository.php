<?php

namespace harmony\data\repository;

use harmony\data\dataSource\query\Query;
use harmony\data\repository\operation\Operation;
use harmony\domain\model\BaseCollection;
use harmony\domain\model\BaseHarmony;

/**
 * Interface PutRepository
 */
interface PutRepository
{

    /**
     * Put
     * @param Query       $query     query
     * @param Operation   $operation operation
     * @param BaseHarmony $baseModel model
     *
     * @return BaseHarmony
     */
    public function put(
        Query $query,
        Operation $operation,
        BaseHarmony $baseModel
    ): BaseHarmony;

    /**
     * Put all
     *
     * @param Query          $query     query
     * @param Operation      $operation operation
     * @param BaseCollection $baseModel model
     *
     * @return mixed
     */
    public function putAll(
        Query $query,
        Operation $operation,
        BaseCollection $baseModel
    );

}