<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

interface DeleteRepository extends Repository {
  /**
   * @param Query     $query     query
   * @param Operation $operation operation
   *
   * @return void
   */
  public function delete(Query $query, Operation $operation): void;
}
