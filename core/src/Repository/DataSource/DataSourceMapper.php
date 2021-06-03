<?php

namespace harmony\core\Repository\DataSource;

use harmony\core\Repository\Mapper\GenericMapper;
use harmony\core\Repository\Query\Query;

/**
 * @template   TEntity
 * @template   TData
 * @implements GetDataSource<TEntity>
 * @implements PutDataSource<TEntity>
 */
class DataSourceMapper implements GetDataSource, PutDataSource, DeleteDataSource {
  /**
   * @param GetDataSource<TData>          $getDataSource
   * @param PutDataSource<TData>          $putDataSource
   * @param DeleteDataSource              $deleteDataSource
   * @param GenericMapper<TEntity, TData> $entityToDataMapper
   * @param GenericMapper<TData, TEntity> $dataToEntityMapper
   */
  public function __construct(
    protected GetDataSource $getDataSource,
    protected PutDataSource $putDataSource,
    protected DeleteDataSource $deleteDataSource,
    protected GenericMapper $entityToDataMapper,
    protected GenericMapper $dataToEntityMapper
  ) {
  }

  /**
   * @inheritdoc
   */
  public function get(Query $query): mixed {
    $data = $this->getDataSource->get($query);
    $entity = $this->dataToEntityMapper->map($data);

    return $entity;
  }

  /**
   * @inheritdoc
   */
  public function getAll(Query $query): array {
    $datas = $this->getDataSource->getAll($query);
    $entities = [];

    foreach ($datas as $from) {
      $entities[] = $this->dataToEntityMapper->map($from);
    }

    return $entities;
  }

  /**
   * @param Query        $query
   * @param TEntity|null $entity
   *
   * @return TEntity|mixed
   */
  public function put(Query $query, mixed $entity = null): mixed {
    $data = null;

    if ($entity !== null) {
      $data = $this->entityToDataMapper->map($entity);
    }

    $dataPutted = $this->putDataSource->put($query, $data);
    $entityPutted = $this->dataToEntityMapper->map($dataPutted);

    return $entityPutted;
  }

  /**
   * @param Query               $query
   * @param array<TEntity>|null $entities
   *
   * @return array<TEntity>
   */
  public function putAll(Query $query, array $entities = null): array {
    $datas = null;

    if ($entities !== null) {
      $datas = [];

      foreach ($entities as $entity) {
        $datas[] = $this->entityToDataMapper->map($entity);
      }
    }

    $datasPutted = $this->putDataSource->putAll($query, $datas);
    $entitiesPutted = [];

    foreach ($datasPutted as $dataPutted) {
      $entitiesPutted[] = $this->dataToEntityMapper->map($dataPutted);
    }

    return $entitiesPutted;
  }

  /**
   * @inheritdoc
   */
  public function delete(Query $query): void {
    $this->deleteDataSource->delete($query);
  }
}
