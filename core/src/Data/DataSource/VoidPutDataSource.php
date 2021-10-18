<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;
use Harmony\Core\Domain\Exception\MethodNotImplementedException;

/**
 * @template   T
 * @implements PutDataSource<T>
 */
class VoidPutDataSource implements PutDataSource {
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
}
