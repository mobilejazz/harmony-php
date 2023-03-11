<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\Mapper\Mapper;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;

/**
 * @template   T
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
   * @return T
   */
  public function get(Query $query, Operation $operation): mixed {
    $toMap = $this->getRepository->get($query, $operation);

    if (!is_array($toMap)) {
      return $this->entityToModelMapper->map($toMap);
    }

    $mapped = [];

    foreach ($toMap as $entityToMap) {
      $mapped[] = $this->entityToModelMapper->map($entityToMap);
    }

    return $mapped;
  }

  /**
   * @param Query     $query
   * @param Operation $operation
   * @param T|null    $model
   *
   * @return T
   */
  public function put(
    Query $query,
    Operation $operation,
    $model = null,
  ): mixed {
    $toPut = null;

    if ($model !== null) {
      if (!is_array($model)) {
        $toPut = $this->modelToEntityMapper->map($model);
      } else {
        $toPut = [];
        foreach ($model as $modelToMap) {
          $toPut[] = $this->modelToEntityMapper->map($modelToMap);
        }
      }
    }

    $toMap = $this->putRepository->put($query, $operation, $toPut);

    if (!is_array($model)) {
      return $this->entityToModelMapper->map($toMap);
    }

    $mapped = [];

    foreach ($toMap as $entityToMap) {
      $mapped[] = $this->entityToModelMapper->map($entityToMap);
    }

    return $mapped;
  }

  public function delete(Query $query, Operation $operation): void {
    $this->deleteRepository->delete($query, $operation);
  }
}
