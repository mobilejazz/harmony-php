<?php

namespace harmony\core\Repository\DataSource;

use harmony\core\Repository\Query\Query;
use harmony\core\shared\error\MethodNotImplementedException;

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
}
