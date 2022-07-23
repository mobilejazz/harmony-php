<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

/**
 * @template T
 */
interface GetRepository extends Repository {
  /**
   * @return T
   */
  public function get(Query $query, Operation $operation);

  /**
   * @return array<T>
   */
  public function getAll(Query $query, Operation $operation): array;

  public function getCount(Query $query, Operation $operation): int;
}
