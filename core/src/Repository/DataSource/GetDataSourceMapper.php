<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Mapper\Mapper;
use Harmony\Core\Repository\Mapper\VoidMapper;

/**
 * @template   TEntity
 * @template   TData
 * @implements GetDataSource<TEntity>
 */
class GetDataSourceMapper extends DataSourceMapper {
  /**
   * @param GetDataSource<TData>   $getDataSource
   * @param Mapper<TData, TEntity> $dataToEntityMapper
   */
  public function __construct(
    protected readonly GetDataSource $getDataSource,
    protected readonly Mapper $dataToEntityMapper,
  ) {
    parent::__construct(
      $this->getDataSource,
      new VoidDataSource(),
      new VoidDataSource(),
      new VoidMapper(),
      $this->dataToEntityMapper
    );
  }
}
