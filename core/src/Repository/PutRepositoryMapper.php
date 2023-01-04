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
   * @param PutRepository<TEntity>  $putRepository
   * @param Mapper<TModel, TEntity> $modelToEntityMapper
   * @param Mapper<TEntity, TModel> $entityToModelMapper
   */
  public function __construct(
    // @phpstan-ignore-next-line
    protected readonly PutRepository $putRepository,
    // @phpstan-ignore-next-line
    protected readonly Mapper $modelToEntityMapper,
    // @phpstan-ignore-next-line
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
