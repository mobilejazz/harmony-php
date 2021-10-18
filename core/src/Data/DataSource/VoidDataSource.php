<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;
use Harmony\Core\Domain\Exception\MethodNotImplementedException;

/**
 * @template   T
 * @implements GetDataSource<T>
 * @implements PutDataSource<T>
 * @implements DeleteDataSource<T>
 */
class VoidDataSource implements GetDataSource, PutDataSource, DeleteDataSource {
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
  public function put(Query $query, mixed $entity = null): mixed {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   */
  public function putAll(Query $query, array $entities = null): array {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   */
  public function delete(Query $query): void {
    throw new MethodNotImplementedException();
  }
}
