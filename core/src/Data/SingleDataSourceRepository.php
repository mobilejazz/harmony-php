<?php

namespace Harmony\Core\Data;

use Harmony\Core\Data\DataSource\DeleteDataSource;
use Harmony\Core\Data\DataSource\GetDataSource;
use Harmony\Core\Data\DataSource\PutDataSource;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;

/**
 * @template   T
 * @implements GetRepository<T>
 * @implements PutRepository<T>
 * @implements DeleteRepository<T>
 */
class SingleDataSourceRepository implements
  GetRepository,
  PutRepository,
  DeleteRepository {
  /**
   * @param GetDataSource<T> $getDataSource
   * @param PutDataSource<T> $putDataSource
   * @param DeleteDataSource<T> $deleteDataSource
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

  /**
   * @inheritdoc
   */
  public function delete(Query $query, Operation $operation): void {
    $this->deleteDataSource->delete($query);
  }
}
