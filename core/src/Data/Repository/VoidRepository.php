<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\Operation\DefaultOperation;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Error\MethodNotImplementedException;

/**
 * @template   T
 * @implements GetRepository<T>
 * @implements PutRepository<T>
 */
class VoidRepository implements GetRepository, PutRepository, DeleteRepository {
  /**
   * @inheritdoc
   * @throws MethodNotImplementedException
   */
  public function get(Query $query, Operation $operation): mixed {
    throw new MethodNotImplementedException();
  }

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

  /**
   * @throws MethodNotImplementedException
   */
  public function delete(Query $query, Operation $operation): void {
    throw new MethodNotImplementedException();
  }
}
