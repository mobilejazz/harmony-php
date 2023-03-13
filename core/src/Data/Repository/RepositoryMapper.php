<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\Mapper\Mapper;
use Harmony\Core\Data\Operation\DefaultOperation;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;

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
  public function get(Query $query, Operation $operation): mixed {
    $toMap = $this->getRepository->get($query, $operation);

    return $this->entityToModelMapper->map($toMap);
  }

  /**
   * @inheritdoc
   */
  public function put(
    Query $query = null,
    Operation $operation = new DefaultOperation(),
    mixed $model = null,
  ): mixed {
    $toPut = null;

    if ($model !== null) {
      $toPut = $this->modelToEntityMapper->map($model);
    }

    $toMap = $this->putRepository->put($query, $operation, $toPut);

    return $this->entityToModelMapper->map($toMap);
  }

  public function delete(Query $query, Operation $operation): void {
    $this->deleteRepository->delete($query, $operation);
  }
}
