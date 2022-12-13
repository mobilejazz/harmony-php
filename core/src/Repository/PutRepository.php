<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

/**
 * @template T
 */
interface PutRepository extends Repository {
  /**
   * @param T|null $model
   *
   * @return T
   */
  public function put(Query $query, Operation $operation, mixed $model = null);

  /**
   * @param array<T>|null $models
   *
   * @return array<T>
   */
  public function putAll(
    Query $query,
    Operation $operation,
    array $models = null,
  ): array;
}
