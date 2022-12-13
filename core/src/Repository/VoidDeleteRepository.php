<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;
use Harmony\Core\Domain\Exception\MethodNotImplementedException;

/**
 * @template T
 * @implements DeleteRepository<T>
 */
class VoidDeleteRepository implements DeleteRepository {
  /**
   * @inheritdoc
   */
  public function delete(Query $query, Operation $operation): void {
    throw new MethodNotImplementedException();
  }
}
