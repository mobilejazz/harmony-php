<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;

/**
 * @template T
 */
interface GetRepository {
  /**
   * @return T
   */
  public function get(Query $query, Operation $operation): mixed;
}
