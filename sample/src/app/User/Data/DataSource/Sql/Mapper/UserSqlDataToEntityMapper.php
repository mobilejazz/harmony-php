<?php

namespace Sample\User\Data\DataSource\Sql\Mapper;

use Harmony\Core\Data\Mapper\Mapper;
use Sample\User\Data\DataSource\Sql\UserSqlData;
use Sample\User\Data\Entity\UserEntity;

class UserSqlDataToEntityMapper implements Mapper {
  /**
   * @param UserSqlData $from
   *
   * @return UserEntity
   */
  public function map($from): UserEntity {
    return new UserEntity($from->id, $from->name, $from->email);
  }
}
