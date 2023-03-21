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
    $entities = $this->getRepository->get($query, $operation);

    return $this->entityToModelMapper->map($entities);
  }

  /**
   * @inheritdoc
   */
  public function put(
    Query $query = null,
    mixed $models = null,
    Operation $operation = new DefaultOperation(),
  ): mixed {
    $entities =
      $models !== null ? $this->modelToEntityMapper->map($models) : null;

    $entitiesAfterPut = $this->putRepository->put(
      query: $query,
      models: $entities,
      operation: $operation,
    );

    return $this->entityToModelMapper->map($entitiesAfterPut);
  }

  public function delete(Query $query, Operation $operation): void {
    $this->deleteRepository->delete($query, $operation);
  }
}
