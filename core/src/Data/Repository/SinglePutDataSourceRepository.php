<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\DataSource\PutDataSource;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;

/**
 * @template   T
 * @implements PutRepository<T>
 */
class SinglePutDataSourceRepository implements PutRepository {
  /**
   * @param PutDataSource<T> $putDataSource
   */
  public function __construct(protected readonly PutDataSource $putDataSource) {
  }

  /**
   * @inheritdoc
   */
  public function put(
    Query $query,
    Operation $operation,
    $model = null,
  ): mixed {
    return $this->putDataSource->put($query, $model);
  }
}
