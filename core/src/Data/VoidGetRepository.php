<?php

namespace Harmony\Core\Data;

use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Domain\Exception\MethodNotImplementedException;

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
}
