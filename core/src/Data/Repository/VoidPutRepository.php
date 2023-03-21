<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\Operation\DefaultOperation;
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
    Query $query = null,
    $models = null,
    Operation $operation = new DefaultOperation(),
  ): mixed {
    throw new MethodNotImplementedException();
  }
}
