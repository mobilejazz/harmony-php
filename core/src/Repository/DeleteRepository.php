<?php

namespace harmony\core\Repository;

use harmony\core\Repository\Operation\Operation;
use harmony\core\Repository\Query\Query;

interface DeleteRepository extends Repository {
  /**
   * @param Query     $query     query
   * @param Operation $operation operation
   *
   * @return void
   */
  public function delete(Query $query, Operation $operation): void;
}
