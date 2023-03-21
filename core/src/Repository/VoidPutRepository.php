<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;
use Harmony\Core\Shared\Error\MethodNotImplementedException;

/**
 * @template   T
 * @implements PutRepository<T>
 */
class VoidPutRepository implements PutRepository {
  /**
   * @inheritdoc
   * @throws MethodNotImplementedException
   */
  public function put(Query $query, Operation $operation, $model = null) {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   * @throws MethodNotImplementedException
   */
  public function putAll(
    Query $query,
    Operation $operation,
    array $models = null,
  ): array {
    throw new MethodNotImplementedException();
  }
}
