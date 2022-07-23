<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\DataSource\GetDataSource;
use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

/**
 * @template   T
 * @implements GetRepository<T>
 */
class SingleGetDataSourceRepository implements GetRepository {
  /**
   * @param GetDataSource<T> $getDataSource
   */
  public function __construct(protected GetDataSource $getDataSource) {
  }

  /**
   * @inheritdoc
   */
  public function get(Query $query, Operation $operation) {
    return $this->getDataSource->get($query);
  }

  /**
   * @inheritdoc
   */
  public function getAll(Query $query, Operation $operation): array {
    return $this->getDataSource->getAll($query);
  }

  public function getCount(Query $query, Operation $operation): int {
    return $this->getDataSource->getCount($query);
  }
}
