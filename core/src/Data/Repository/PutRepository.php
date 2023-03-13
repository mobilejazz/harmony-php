<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\Operation\DefaultOperation;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;

/**
 * @template T
 */
interface PutRepository {
  /**
   * @param Query|null $query
   * @param Operation  $operation
   * @param T|null     $model
   *
   * @return T
   */
  public function put(
    Query $query = null,
    Operation $operation = new DefaultOperation(),
    mixed $model = null,
  ): mixed;
}
