<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Query\Query;
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
