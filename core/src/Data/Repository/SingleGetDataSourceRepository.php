<?php

namespace Harmony\Core\Data\Repository;

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
  public function __construct(protected readonly GetDataSource $getDataSource) {
  }

  /**
   * @inheritdoc
   */
  public function get(Query $query, Operation $operation): mixed {
    return $this->getDataSource->get($query);
  }
}
