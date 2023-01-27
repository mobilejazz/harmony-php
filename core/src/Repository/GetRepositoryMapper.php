<?php

namespace Harmony\Core\Repository;

use Harmony\Core\Repository\Mapper\Mapper;
use Harmony\Core\Repository\Mapper\VoidMapper;

/**
 * @template   TModel
 * @template   TEntity
 * @template-extends RepositoryMapper<TModel, TEntity>
 */
class GetRepositoryMapper extends RepositoryMapper {
  /**
   * @param GetRepository<TEntity>  $getRepository
   * @param Mapper<TEntity, TModel> $entityToModelMapper
   */
  public function __construct(
    GetRepository $getRepository,
    Mapper $entityToModelMapper,
  ) {
    /** @var VoidRepository<TEntity> $voidRepository */
    $voidRepository = new VoidRepository();

    /** @var VoidMapper<TModel, TEntity> $voidMapper */
    $voidMapper = new VoidMapper();

    parent::__construct(
      $getRepository,
      $voidRepository,
      $voidRepository,
      $voidMapper,
      $entityToModelMapper,
    );
  }
}
