<?php

namespace Sample\User\Data\Entity;

/**
 * @psalm-immutable
 */
class UserEntity {
  public function __construct(
    public int $id,
    public string $name,
    public string $email,
  ) {
  }
}
