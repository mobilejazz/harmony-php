<?php

namespace Sample\User\Data\Mapper;

use Harmony\Core\Data\Mapper\Mapper;
use Sample\User\Data\Entity\UserEntity;
use Sample\User\Domain\Model\User;

class UserEntityToModelMapper implements Mapper {
  /**
   * @param UserEntity $from
   *
   * @return User
   */
  public function map(mixed $from): User {
    return new User($from->id, $from->name, $from->email);
  }
}
