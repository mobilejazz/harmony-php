<?php

namespace Sample\User\Data\DataSource\Sql\Mapper;

use Harmony\Core\Repository\Mapper\Mapper;
use Sample\User\Data\DataSource\Sql\UserSqlData;
use Sample\User\Data\Entity\UserEntity;

class UserEntityToSqlDataMapper implements Mapper {
  /**
   * @param UserEntity $from
   *
   * @return UserSqlData
   */
  public function map(mixed $from): UserSqlData {
    $to = new UserSqlData($from->id, $from->name, $from->email);

    return $to;
  }
}
