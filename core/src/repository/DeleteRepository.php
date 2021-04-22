<?php

namespace harmony\core\repository;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

interface DeleteRepository extends Repository {
  /**
   * @param Query     $query     query
   * @param Operation $operation operation
   *
   * @return void
   */
  public function delete(Query $query, Operation $operation): void;
}
