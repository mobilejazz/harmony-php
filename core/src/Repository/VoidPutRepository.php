<?php

namespace harmony\core\Repository;

use harmony\core\Repository\Operation\Operation;
use harmony\core\Repository\Query\Query;
use harmony\core\shared\error\MethodNotImplementedException;

/**
 * @template   T
 * @implements PutRepository<T>
 */
class VoidPutRepository implements PutRepository {
  /**
   * @inheritdoc
   */
  public function put(Query $query, Operation $operation, $model = null) {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   */
  public function putAll(
    Query $query,
    Operation $operation,
    array $models = null
  ): array {
    throw new MethodNotImplementedException();
  }
}
