<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;
use Harmony\Core\Error\MethodNotImplementedException;

/**
 * @template   T
 * @implements GetDataSource<T>
 * @implements PutDataSource<T>
 */
class VoidDataSource implements GetDataSource, PutDataSource, DeleteDataSource {
  /**
   * @inheritdoc
   * @throws MethodNotImplementedException
   */
  public function get(Query $query): mixed {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   * @throws MethodNotImplementedException
   */
  public function put(Query $query = null, mixed $entity = null): mixed {
    throw new MethodNotImplementedException();
  }

  /**
   * @throws MethodNotImplementedException
   */
  public function delete(Query $query): void {
    throw new MethodNotImplementedException();
  }
}
