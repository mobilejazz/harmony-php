<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\DataSource\DeleteDataSource;
use Harmony\Core\Repository\DataSource\GetDataSource;
use Harmony\Core\Repository\DataSource\PutDataSource;
use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

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
    protected GetDataSource $getDataSource,
    protected PutDataSource $putDataSource,
    protected DeleteDataSource $deleteDataSource,
  ) {
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

  public function delete(Query $query, Operation $operation): void {
    $this->deleteDataSource->delete($query);
  }
}
