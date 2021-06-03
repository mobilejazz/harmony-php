<?php

namespace harmony\core\Repository\DataSource;

use harmony\core\Repository\Query\Query;
use harmony\core\shared\error\MethodNotImplementedException;

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
