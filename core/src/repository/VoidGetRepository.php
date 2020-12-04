<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\error\MethodNotImplementedException;

/**
 * @template   T
 * @implements GetRepository<T>
 */
class VoidGetRepository implements GetRepository
{
    /**
     * @inheritdoc
     */
    public function get(
        Query $query,
        Operation $operation
    ) {
        throw new MethodNotImplementedException();
    }

    /**
     * @inheritdoc
     */
    public function getAll(
        Query $query,
        Operation $operation
    ): array {
        throw new MethodNotImplementedException();
    }
}
