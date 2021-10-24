<?php

namespace Sample\User\Data\Mapper;

use Harmony\Core\Data\Mapper\Mapper;
use Sample\User\Data\Entity\UserEntity;
use Sample\User\Domain\Model\User;

class UserModelToEntityMapper implements Mapper {
  /**
   * @param User $from
   *
   * @return UserEntity
   */
  public function map(mixed $from): UserEntity {
    return new UserEntity($from->id, $from->name, $from->email);
  }
}
