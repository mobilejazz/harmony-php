<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Mapper\Mapper;

/**
 * @template   TModel
 * @template   TEntity
 * @template-extends RepositoryMapper<TModel, TEntity>
 */
class PutRepositoryMapper extends RepositoryMapper {

  /**
   * @inheritdoc $putRepository
   * @param Mapper<TModel, TEntity> $modelToEntityMapper
   * @param Mapper<TEntity, TModel> $entityToModelMapper
   */
  public function __construct(
    protected readonly PutRepository $putRepository,
    protected readonly Mapper $modelToEntityMapper,
    protected readonly Mapper $entityToModelMapper,
  ) {
    /** @var VoidRepository<TEntity> $voidRepository */
    $voidRepository = new VoidRepository();

    parent::__construct(
      $voidRepository,
      $this->putRepository,
      $voidRepository,
      $this->modelToEntityMapper,
      $this->entityToModelMapper,
    );
  }
}
