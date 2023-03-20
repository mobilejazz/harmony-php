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
    $data = $this->getDataSource->get($query);

    return $this->dataToEntityMapper->map($data);
  }

  /**
   * @inheritdoc
   */
  public function put(Query $query = null, mixed $entities = null): mixed {
    $data =
      $entities !== null ? $this->entityToDataMapper->map($entities) : null;
    $dataAfterPut = $this->putDataSource->put($query, $data);

    return $this->dataToEntityMapper->map($dataAfterPut);
  }

  public function delete(Query $query): void {
    $this->deleteDataSource->delete($query);
  }
}
