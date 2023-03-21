<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\DataSource\PutDataSource;
use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

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
  public function put(Query $query, Operation $operation, $model = null) {
    return $this->putDataSource->put($query, $model);
  }

  /**
   * @inheritdoc
   * @psalm-suppress InvalidArgument
   */
  public function putAll(
    Query $query,
    Operation $operation,
    array $models = null,
  ): array {
    return $this->putDataSource->putAll($query, $models);
  }
}
