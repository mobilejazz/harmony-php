<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Mapper\Mapper;
use Harmony\Core\Data\Query\Query;

/**
 * @template   T
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
   * @return T
   */
  public function get(Query $query): mixed {
    $toMap = $this->getDataSource->get($query);

    if (!is_array($toMap)) {
      return $this->dataToEntityMapper->map($toMap);
    }

    $mapped = [];

    foreach ($toMap as $from) {
      $mapped[] = $this->dataToEntityMapper->map($from);
    }

    return $mapped;
  }

  /**
   * @param Query        $query
   * @param T|null $entity
   *
   * @return T
   */
  public function put(Query $query, mixed $entity = null): mixed {
    $toPut = null;

    if ($entity !== null) {
      if (!is_array($entity)) {
        $toPut = $this->entityToDataMapper->map($entity);
      } else {
        $toPut = [];

        foreach ($entity as $entityToMap) {
          $toPut[] = $this->entityToDataMapper->map($entityToMap);
          unset($entityToMap);
        }
      }
    }

    $toMap = $this->putDataSource->put($query, $toPut);

    if (!is_array($entity)) {
      return $this->dataToEntityMapper->map($toMap);
    }

    $mapped = [];

    foreach ($toMap as $dataToMap) {
      $mapped[] = $this->dataToEntityMapper->map($dataToMap);
    }

    return $mapped;
  }

  public function delete(Query $query): void {
    $this->deleteDataSource->delete($query);
  }
}
