<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Mapper\Mapper;

/**
 * @template   TModel
 * @template   TEntity
 * @implements PutRepository<TModel>
 */
class PutRepositoryMapper extends RepositoryMapper {
  /**
   * @param PutRepository<TEntity>  $putRepository
   * @param Mapper<TModel, TEntity> $modelToEntityMapper
   * @param Mapper<TEntity, TModel> $entityToModelMapper
   */
  public function __construct(
    protected readonly PutRepository $putRepository,
    protected readonly Mapper $modelToEntityMapper,
    protected readonly Mapper $entityToModelMapper,
  ) {
    parent::__construct(
      new VoidRepository(),
      $this->putRepository,
      new VoidRepository(),
      $this->modelToEntityMapper,
      $this->entityToModelMapper,
    );
  }
}
