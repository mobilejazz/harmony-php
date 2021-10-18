<?php

namespace Harmony\Core\Data;

use Harmony\Core\Data\DataSource\GetDataSource;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;

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
}
