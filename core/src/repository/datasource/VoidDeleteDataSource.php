<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\query\Query;
use harmony\core\shared\error\MethodNotImplementedException;

class VoidDeleteDataSource implements DeleteDataSource {
  /**
   * @inheritdoc
   */
  public function delete(Query $query): void {
    throw new MethodNotImplementedException();
  }
}
