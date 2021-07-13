<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Query\Query;
use Harmony\Core\Shared\Error\MethodNotImplementedException;

class VoidDeleteDataSource implements DeleteDataSource {
  /**
   * @inheritdoc
   */
  public function delete(Query $query): void {
    throw new MethodNotImplementedException();
  }
}
