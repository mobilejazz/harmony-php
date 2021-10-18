<?php

namespace Harmony\Core\Data;

use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Domain\Exception\MethodNotImplementedException;

/**
 * @template   T
 * @implements GetRepository<T>
 * @implements PutRepository<T>
 * @implements DeleteRepository<T>
 */
class VoidRepository implements GetRepository, PutRepository, DeleteRepository {
  /**
   * @inheritdoc
   */
  public function get(Query $query, Operation $operation) {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   */
  public function getAll(Query $query, Operation $operation): array {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   */
  public function put(Query $query, Operation $operation, $model = null) {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   */
  public function putAll(
    Query $query,
    Operation $operation,
    array $models = null,
  ): array {
    throw new MethodNotImplementedException();
  }

  /**
   * @inheritdoc
   */
  public function delete(Query $query, Operation $operation): void {
    throw new MethodNotImplementedException();
  }
}
