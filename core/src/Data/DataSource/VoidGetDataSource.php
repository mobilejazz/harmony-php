<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;
use Harmony\Core\Domain\Exception\MethodNotImplementedException;

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
