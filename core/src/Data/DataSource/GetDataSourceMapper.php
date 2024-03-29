<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Mapper\Mapper;
use Harmony\Core\Data\Mapper\VoidMapper;

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
    GetDataSource $getDataSource,
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
