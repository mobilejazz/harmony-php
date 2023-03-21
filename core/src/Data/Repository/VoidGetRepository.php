<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Error\MethodNotImplementedException;

/**
 * @template   T
 * @implements GetRepository<T>
 */
class VoidGetRepository implements GetRepository {
  /**
   * @inheritdoc
   * @throws MethodNotImplementedException
   */
  public function get(Query $query, Operation $operation): mixed {
    throw new MethodNotImplementedException();
  }
}
