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
   * @param T|null     $models
   * @param Operation  $operation
   *
   * @return T
   */
  public function put(
    Query $query = null,
    mixed $models = null,
    Operation $operation = new DefaultOperation(),
  ): mixed;
}
