<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use harmony\core\shared\error\MethodNotImplementedException;

/**
 * @template T2
 * @implements GetRepository<T2>
 */
class VoidGetRepository implements GetRepository
{
    /**
     * @inheritdoc
     */
    public function get(
        Query $query,
        Operation $operation
    ): BaseEntity {
        throw new MethodNotImplementedException();
    }

    /**
     * @inheritdoc
     */
    public function getAll(
        Query $query,
        Operation $operation
    ): GenericCollection {
        throw new MethodNotImplementedException();
    }
}
