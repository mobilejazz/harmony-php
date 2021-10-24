<?php

namespace Sample\User\Data\DataSource\Sql\Mapper;

use Harmony\Core\Data\Mapper\Mapper;
use Sample\User\Data\DataSource\Sql\UserSqlSchema;
use Sample\User\Data\Entity\UserEntity;
use stdClass;

class UserEntityToSqlDataMapper implements Mapper {
  /**
   * @param UserEntity $from
   *
   * @return stdClass
   */
  public function map(mixed $from): stdClass {
    $to = new stdClass();

    $to->{UserSqlSchema::COLUMN_ID} = $from->id;
    $to->{UserSqlSchema::COLUMN_NAME} = $from->name;
    $to->{UserSqlSchema::COLUMN_EMAIL} = $from->email;

    return $to;
  }
}
