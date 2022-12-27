<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Mapper\Mapper;
use Harmony\Core\Repository\Mapper\VoidMapper;

/**
 * @template   TModel
 * @template   TEntity
 */
class GetRepositoryMapper extends RepositoryMapper {
  /**
   * @param GetRepository<TEntity>  $getRepository
   * @param Mapper<TEntity, TModel> $entityToModelMapper
   */
  public function __construct(
    protected readonly GetRepository $getRepository,
    protected readonly Mapper $entityToModelMapper,
  ) {
    parent::__construct(
      $this->getRepository,
      new VoidRepository(),
      new VoidRepository(),
      new VoidMapper(),
      $this->entityToModelMapper
    );
  }
}
