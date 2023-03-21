<?php

namespace Harmony\Core\Data\Repository;

use Harmony\Core\Data\DataSource\DeleteDataSource;
use Harmony\Core\Data\DataSource\GetDataSource;
use Harmony\Core\Data\DataSource\PutDataSource;
use Harmony\Core\Data\DataSource\VoidDataSource;
use Harmony\Core\Data\Mapper\BlankMapper;
use Harmony\Core\Data\Mapper\Mapper;

class RepositoryProvider {
  // @phpstan-ignore-next-line
  public static function singleRepositoryMapper(
    GetDataSource&PutDataSource&DeleteDataSource $singleDataSource = new VoidDataSource(),
    GetDataSource $getDataSource = null,
    PutDataSource $putDataSource = null,
    DeleteDataSource $deleteDataSource = null,
    Mapper $modelToEntityMapper = new BlankMapper(),
    Mapper $entityToModelMapper = new BlankMapper(),
  ): RepositoryMapper {
    $repository = new SingleDataSourceRepository(
      $getDataSource ?? $singleDataSource,
      $putDataSource ?? $singleDataSource,
      $deleteDataSource ?? $singleDataSource,
    );

    return new RepositoryMapper(
      $repository,
      $repository,
      $repository,
      $modelToEntityMapper,
      $entityToModelMapper,
    );
  }
}
