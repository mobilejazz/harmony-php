<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;

interface DeleteRepository {
  public function delete(Query $query, Operation $operation): void;
}
