<?php

namespace Harmony\Core\Data\DataSource;

use Harmony\Core\Data\Mapper\Mapper;

/**
 * @template   TEntity
 * @template   TData
 * @template-extends DataSourceMapper<TEntity, TData>
 */
class PutDataSourceMapper extends DataSourceMapper {
  /**
   * @param PutDataSource<TData>   $putDataSource
   * @param Mapper<TEntity, TData> $entityToDataMapper
   * @param Mapper<TData, TEntity> $dataToEntityMapper
   */
  public function __construct(
    PutDataSource $putDataSource,
    Mapper $entityToDataMapper,
    Mapper $dataToEntityMapper,
  ) {
    /** @var VoidDataSource<TData> $voidDataSource */
    $voidDataSource = new VoidDataSource();

    parent::__construct(
      $voidDataSource,
      $putDataSource,
      $voidDataSource,
      $entityToDataMapper,
      $dataToEntityMapper,
    );
  }
}
