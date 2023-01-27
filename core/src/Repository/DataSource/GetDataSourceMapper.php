<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Mapper\Mapper;
use Harmony\Core\Repository\Mapper\VoidMapper;

/**
 * @template   TEntity
 * @template   TData
 * @template-extends DataSourceMapper<TEntity, TData>
 */
class GetDataSourceMapper extends DataSourceMapper {
  /**
   * @param GetDataSource<TData>   $getDataSource
   * @param Mapper<TData, TEntity> $dataToEntityMapper
   */
  public function __construct(
    // @phpstan-ignore-next-line
    GetDataSource $getDataSource,
    // @phpstan-ignore-next-line
    Mapper $dataToEntityMapper,
  ) {
    /** @var VoidDataSource<TData> $voidDataSource */
    $voidDataSource = new VoidDataSource();

    /** @var VoidMapper<TEntity, TData> $voidMapper */
    $voidMapper = new VoidMapper();

    parent::__construct(
      $getDataSource,
      $voidDataSource,
      $voidDataSource,
      $voidMapper,
      $dataToEntityMapper,
    );
  }
}
