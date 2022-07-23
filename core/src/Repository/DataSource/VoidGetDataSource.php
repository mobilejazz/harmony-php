<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Query\Query;
use Harmony\Core\Shared\Error\MethodNotImplementedException;

/**
 * @template   T
 * @implements GetDataSource<T>
 */
class VoidGetDataSource implements GetDataSource {
  /**
   * @inheritdoc
   */
  public function get(Query $query): mixed {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   */
  public function getAll(Query $query): array {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   */
  public function getCount(Query $query): int {
    throw new MethodNotImplementedException();
  }
}
