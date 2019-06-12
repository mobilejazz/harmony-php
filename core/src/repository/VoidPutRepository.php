<?php

namespace harmony\core\repository;

use harmony\core\error\MethodNotImplementedException;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

class VoidPutRepository
    implements PutRepository
{
    /**
     * @param Query $query
     * @param Operation $operation
     * @param BaseHarmony $baseModel
     * @return BaseHarmony
     * @throws MethodNotImplementedException
     */
    public function put(
        Query $query,
        Operation $operation,
        BaseHarmony $baseModel
    ): BaseHarmony {
        throw new MethodNotImplementedException();
    }

    /**
     * @param Query $query
     * @param Operation $operation
     * @param GenericCollection $baseModel
     * @throws MethodNotImplementedException
     *
     * @return void
     */
    public function putAll(
        Query $query,
        Operation $operation,
        GenericCollection $baseModel
    ) {
        throw new MethodNotImplementedException();
    }
}