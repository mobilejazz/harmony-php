<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;
use Harmony\Core\Error\MethodNotImplementedException;

class VoidDeleteDataSource implements DeleteDataSource {
  /**
   * @throws MethodNotImplementedException
   */
  public function delete(Query $query): void {
    throw new MethodNotImplementedException();
  }
}
