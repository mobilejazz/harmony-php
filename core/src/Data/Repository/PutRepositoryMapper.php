<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\Mapper\Mapper;

/**
 * @template   TModel
 * @template   TEntity
 * @template-extends RepositoryMapper<TModel, TEntity>
 */
class PutRepositoryMapper extends RepositoryMapper {
  /**
   * @param PutRepository<TEntity>  $putRepository
   * @param Mapper<TModel, TEntity> $modelToEntityMapper
   * @param Mapper<TEntity, TModel> $entityToModelMapper
   */
  public function __construct(
    PutRepository $putRepository,
    Mapper $modelToEntityMapper,
    Mapper $entityToModelMapper,
  ) {
    /** @var VoidRepository<TEntity> $voidRepository */
    $voidRepository = new VoidRepository();

    parent::__construct(
      $voidRepository,
      $putRepository,
      $voidRepository,
      $modelToEntityMapper,
      $entityToModelMapper,
    );
  }
}
