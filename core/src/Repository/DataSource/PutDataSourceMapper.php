<?php

namespace Harmony\Core\Repository\DataSource;

use Harmony\Core\Repository\Mapper\Mapper;

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
    // @phpstan-ignore-next-line
    protected readonly PutDataSource $putDataSource,
    // @phpstan-ignore-next-line
    protected readonly Mapper $entityToDataMapper,
    // @phpstan-ignore-next-line
    protected readonly Mapper $dataToEntityMapper,
  ) {
    /** @var VoidDataSource<TData> $voidDataSource */
    $voidDataSource = new VoidDataSource();

    parent::__construct(
      $voidDataSource,
      $this->putDataSource,
      $voidDataSource,
      $this->entityToDataMapper,
      $this->dataToEntityMapper,
    );
  }
}
