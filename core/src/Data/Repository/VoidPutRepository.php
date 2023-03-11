<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Error\MethodNotImplementedException;

/**
 * @template   T
 * @implements PutRepository<T>
 */
class VoidPutRepository implements PutRepository {
  /**
   * @inheritdoc
   * @throws MethodNotImplementedException
   */
  public function put(
    Query $query,
    Operation $operation,
    $model = null,
  ): mixed {
    throw new MethodNotImplementedException();
  }
}
