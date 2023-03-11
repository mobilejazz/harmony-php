<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;

/**
 * @template T
 */
interface PutRepository {
  /**
   * @param T|null $model
   *
   * @return T
   */
  public function put(
    Query $query,
    Operation $operation,
    mixed $model = null,
  ): mixed;
}
