<?php

namespace harmony\core\Repository;

use harmony\core\Repository\DataSource\GetDataSource;
use harmony\core\Repository\Operation\Operation;
use harmony\core\Repository\Query\Query;

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
