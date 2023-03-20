<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\DataSource\DeleteDataSource;
use Harmony\Core\Data\DataSource\GetDataSource;
use Harmony\Core\Data\DataSource\PutDataSource;
use Harmony\Core\Data\Operation\DefaultOperation;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;

/**
 * @template   T
 * @implements GetRepository<T>
 * @implements PutRepository<T>
 */
class SingleDataSourceRepository implements
  GetRepository,
  PutRepository,
  DeleteRepository {
  /**
   * @param GetDataSource<T> $getDataSource
   * @param PutDataSource<T> $putDataSource
   * @param DeleteDataSource $deleteDataSource
   */
  public function __construct(
    protected readonly GetDataSource $getDataSource,
    protected readonly PutDataSource $putDataSource,
    protected readonly DeleteDataSource $deleteDataSource,
  ) {
  }

  /**
   * @inheritdoc
   */
  public function get(Query $query, Operation $operation): mixed {
    return $this->getDataSource->get($query);
  }

  /**
   * @inheritdoc
   */
  public function put(
    Query $query = null,
    $models = null,
    Operation $operation = new DefaultOperation(),
  ): mixed {
    return $this->putDataSource->put($query, $models);
  }

  public function delete(Query $query, Operation $operation): void {
    $this->deleteDataSource->delete($query);
  }
}
