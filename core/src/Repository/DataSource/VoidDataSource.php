<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Query\Query;
use Harmony\Core\Shared\Error\MethodNotImplementedException;

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
  public function getAll(Query $query): array {
    throw new MethodNotImplementedException();
  }

  /**
   * @throws MethodNotImplementedException
   */
  public function getCount(Query $query): int {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   * @throws MethodNotImplementedException
   */
  public function put(Query $query, mixed $entity = null): mixed {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   * @throws MethodNotImplementedException
   */
  public function putAll(Query $query, array $entities = null): array {
    throw new MethodNotImplementedException();
  }

  /**
   * @throws MethodNotImplementedException
   */
  public function delete(Query $query): void {
    throw new MethodNotImplementedException();
  }
}
