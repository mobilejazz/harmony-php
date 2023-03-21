<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

interface DeleteRepository extends Repository {
  public function delete(Query $query, Operation $operation): void;
}
