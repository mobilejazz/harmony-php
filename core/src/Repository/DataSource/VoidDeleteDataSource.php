<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Query\Query;
use Harmony\Core\Domain\Exception\MethodNotImplementedException;

/**
 * @template T
 * @implements DeleteDataSource<T>
 */
class VoidDeleteDataSource implements DeleteDataSource {
  /**
   * @inheritdoc
   */
  public function delete(Query $query): void {
    throw new MethodNotImplementedException();
  }
}
