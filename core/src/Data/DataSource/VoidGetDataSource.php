<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;
use Harmony\Core\Error\MethodNotImplementedException;

/**
 * @template   T
 * @implements GetDataSource<T>
 */
class VoidGetDataSource implements GetDataSource {
  /**
   * @inheritdoc
   * @throws MethodNotImplementedException
   */
  public function get(Query $query): mixed {
    throw new MethodNotImplementedException();
  }
}
