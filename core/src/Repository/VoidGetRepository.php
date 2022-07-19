<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;
use Harmony\Core\Shared\Error\MethodNotImplementedException;

/**
 * @template   T
 * @implements GetRepository<T>
 */
class VoidGetRepository implements GetRepository {
  /**
   * @inheritdoc
   */
  public function get(Query $query, Operation $operation) {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   */
  public function getAll(Query $query, Operation $operation): array {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   */
  public function getCount(Query $query, Operation $operation): int {
    throw new MethodNotImplementedException();
  }
}
