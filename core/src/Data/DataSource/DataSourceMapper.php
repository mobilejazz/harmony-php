<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Mapper\Mapper;
use Harmony\Core\Data\Query\Query;

/**
 * @template   TEntity
 * @template   TData
 * @implements GetDataSource<TEntity>
 * @implements PutDataSource<TEntity>
 */
class DataSourceMapper implements
  GetDataSource,
  PutDataSource,
  DeleteDataSource {
  /**
   * @param GetDataSource<TData>   $getDataSource
   * @param PutDataSource<TData>   $putDataSource
   * @param DeleteDataSource       $deleteDataSource
   * @param Mapper<TEntity, TData> $entityToDataMapper
   * @param Mapper<TData, TEntity> $dataToEntityMapper
   */
  public function __construct(
    protected readonly GetDataSource $getDataSource,
    protected readonly PutDataSource $putDataSource,
    protected readonly DeleteDataSource $deleteDataSource,
    protected readonly Mapper $entityToDataMapper,
    protected readonly Mapper $dataToEntityMapper,
  ) {
  }

  /**
   * @inheritdoc
   */
  public function get(Query $query): mixed {
    $toMap = $this->getDataSource->get($query);

    return $this->dataToEntityMapper->map($toMap);
  }

  /**
   * @inheritdoc
   */
  public function put(Query $query = null, mixed $entity = null): mixed {
    $toPut = null;

    if ($entity !== null) {
      $toPut = $this->entityToDataMapper->map($entity);
    }

    $toMap = $this->putDataSource->put($query, $toPut);

    return $this->dataToEntityMapper->map($toMap);
  }

  public function delete(Query $query): void {
    $this->deleteDataSource->delete($query);
  }
}
