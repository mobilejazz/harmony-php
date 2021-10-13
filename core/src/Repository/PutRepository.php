<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

/**
 * @template T
 */
interface PutRepository extends Repository {
  /**
   * @param Query     $query
   * @param Operation $operation
   * @param T|null    $model
   *
   * @return T
   */
  public function put(Query $query, Operation $operation, $model = null);

  /**
   * @param Query         $query
   * @param Operation     $operation
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
