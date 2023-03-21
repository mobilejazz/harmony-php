<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;
use Harmony\Core\Shared\Error\MethodNotImplementedException;

class VoidDeleteRepository implements DeleteRepository {
  /**
   * @throws MethodNotImplementedException
   */
  public function delete(Query $query, Operation $operation): void {
    throw new MethodNotImplementedException();
  }
}
