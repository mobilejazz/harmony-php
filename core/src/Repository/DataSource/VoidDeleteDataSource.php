<?php

namespace harmony\core\Repository\DataSource;

use harmony\core\Repository\Query\Query;
use harmony\core\shared\error\MethodNotImplementedException;

class VoidDeleteDataSource implements DeleteDataSource {
  /**
   * @inheritdoc
   */
  public function delete(Query $query): void {
    throw new MethodNotImplementedException();
  }
}
