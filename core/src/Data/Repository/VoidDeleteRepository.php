<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Error\MethodNotImplementedException;

class VoidDeleteRepository implements DeleteRepository {
  /**
   * @throws MethodNotImplementedException
   */
  public function delete(Query $query, Operation $operation): void {
    throw new MethodNotImplementedException();
  }
}
