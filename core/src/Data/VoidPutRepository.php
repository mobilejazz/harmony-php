<?php

namespace Harmony\Core\Data;

use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Domain\Exception\MethodNotImplementedException;

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
    array $models = null,
  ): array {
    throw new MethodNotImplementedException();
  }
}
