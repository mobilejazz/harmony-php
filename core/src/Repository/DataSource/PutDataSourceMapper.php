<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Mapper\Mapper;

/**
 * @template   TEntity
 * @template   TData
 * @extends    DataSourceMapper<TEntity, TData>
 */
class PutDataSourceMapper extends DataSourceMapper {
  /**
   * @param PutDataSource<TData>   $putDataSource
   * @param Mapper<TEntity, TData> $entityToDataMapper
   * @param Mapper<TData, TEntity> $dataToEntityMapper
   */
  public function __construct(
    protected readonly PutDataSource $putDataSource,
    protected readonly Mapper $entityToDataMapper,
    protected readonly Mapper $dataToEntityMapper,
  ) {
    parent::__construct(
      new VoidDataSource(),
      $this->putDataSource,
      new VoidDataSource(),
      $this->entityToDataMapper,
      $this->dataToEntityMapper,
    );
  }
}
