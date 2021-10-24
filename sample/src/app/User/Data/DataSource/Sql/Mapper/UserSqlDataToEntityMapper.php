<?php

namespace Sample\User\Data\DataSource\Sql\Mapper;

use Harmony\Core\Data\Mapper\Mapper;
use Sample\User\Data\DataSource\Sql\UserSqlSchema;
use Sample\User\Data\Entity\UserEntity;

class UserSqlDataToEntityMapper implements Mapper {
  public function map(mixed $from): UserEntity {
    return new UserEntity(
      $from->{UserSqlSchema::COLUMN_ID},
      $from->{UserSqlSchema::COLUMN_NAME},
      $from->{UserSqlSchema::COLUMN_EMAIL},
    );
  }
}
