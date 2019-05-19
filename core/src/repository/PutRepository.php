<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * Interface PutRepository
 */
interface PutRepository
{
    /**
     * Put
     *
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
     * @param Query             $query
     * @param Operation         $operation
     * @param GenericCollection $baseModel
     *
     * @return mixed
     */
    public function putAll(
        Query $query,
        Operation $operation,
        GenericCollection $baseModel
    );
}
