<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Mapper\Mapper;
use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

/**
 * @template   TModel
 * @template   TEntity
 * @implements GetRepository<TModel>
 * @implements PutRepository<TModel>
 */
class RepositoryMapper implements
  GetRepository,
  PutRepository,
  DeleteRepository {
  /**
   * @param GetRepository<TEntity>  $getRepository
   * @param PutRepository<TEntity>  $putRepository
   * @param DeleteRepository        $deleteRepository
   * @param Mapper<TModel, TEntity> $modelToEntityMapper
   * @param Mapper<TEntity, TModel> $entityToModelMapper
   */
  public function __construct(
    protected readonly GetRepository $getRepository,
    protected readonly PutRepository $putRepository,
    protected readonly DeleteRepository $deleteRepository,
    protected readonly Mapper $modelToEntityMapper,
    protected readonly Mapper $entityToModelMapper,
  ) {
  }

  /**
   * @inheritdoc
   */
  public function get(Query $query, Operation $operation) {
    $entity = $this->getRepository->get($query, $operation);
    $model = $this->entityToModelMapper->map($entity);

    return $model;
  }

  /**
   * @inheritdoc
   */
  public function getAll(Query $query, Operation $operation): array {
    $entities = $this->getRepository->getAll($query, $operation);
    $models = [];

    foreach ($entities as $entity) {
      $models[] = $this->entityToModelMapper->map($entity);
    }

    return $models;
  }

  /**
   * @inheritdoc
   */
  public function put(Query $query, Operation $operation, $model = null) {
    $entity = null;

    if ($model !== null) {
      $entity = $this->modelToEntityMapper->map($model);
    }

    $entityPutted = $this->putRepository->put($query, $operation, $entity);
    $modelPutted = $this->entityToModelMapper->map($entityPutted);

    return $modelPutted;
  }

  /**
   * @inheritdoc
   */
  public function putAll(
    Query $query,
    Operation $operation,
    array $models = null,
  ): array {
    $entities = null;

    if ($models !== null) {
      $entities = [];

      foreach ($models as $model) {
        $entities[] = $this->modelToEntityMapper->map($model);
      }
    }

    $entitiesPutted = $this->putRepository->putAll(
      $query,
      $operation,
      $entities,
    );
    $modelsPutted = [];

    foreach ($entitiesPutted as $entityPutted) {
      $modelsPutted[] = $this->entityToModelMapper->map($entityPutted);
    }

    return $modelsPutted;
  }

  public function delete(Query $query, Operation $operation): void {
    $this->deleteRepository->delete($query, $operation);
  }
}
