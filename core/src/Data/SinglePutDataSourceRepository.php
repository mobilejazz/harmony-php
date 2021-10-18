<?php

namespace Harmony\Core\Data;

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
  public function __construct(protected PutDataSource $putDataSource) {
  }

  /**
   * @inheritdoc
   */
  public function put(Query $query, Operation $operation, $model = null) {
    return $this->putDataSource->put($query, $model);
  }

  /**
   * @inheritdoc
   */
  public function putAll(
    Query $query,
    Operation $operation,
    array $models = null,
  ): array {
    return $this->putDataSource->putAll($query, $models);
  }
}
