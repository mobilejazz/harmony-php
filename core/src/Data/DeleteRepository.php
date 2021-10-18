<?php

namespace Harmony\Core\Data;

use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;

/**
 * @template T
 */
interface DeleteRepository extends Repository {
  /**
   * @param Query     $query     query
   * @param Operation $operation operation
   *
   * @return void
   */
  public function delete(Query $query, Operation $operation): void;
}
