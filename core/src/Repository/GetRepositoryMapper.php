<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Mapper\Mapper;
use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

/**
 * @template   TModel
 * @template   TEntity
 * @implements GetRepository<TModel>
 */
class RepositoryMapper implements GetRepository {
  /**
   * @param GetRepository<TEntity>  $getRepository
   * @param Mapper<TEntity, TModel> $entityToModelMapper
   */
  public function __construct(
    protected readonly GetRepository $getRepository,
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
}
