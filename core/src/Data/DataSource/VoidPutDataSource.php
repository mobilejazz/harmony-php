<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;
use Harmony\Core\Error\MethodNotImplementedException;

/**
 * @template   T
 * @implements PutDataSource<T>
 */
class VoidPutDataSource implements PutDataSource {
  /**
   * @inheritdoc
   * @throws MethodNotImplementedException
   */
  public function put(Query $query = null, mixed $entities = null): mixed {
    throw new MethodNotImplementedException();
  }
}
