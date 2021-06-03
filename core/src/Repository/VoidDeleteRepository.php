<?php

namespace harmony\core\Repository;

use harmony\core\Repository\Operation\Operation;
use harmony\core\Repository\Query\Query;
use harmony\core\shared\error\MethodNotImplementedException;

class VoidDeleteRepository implements DeleteRepository {
  /**
   * @inheritdoc
   */
  public function delete(Query $query, Operation $operation): void {
    throw new MethodNotImplementedException();
  }
}
