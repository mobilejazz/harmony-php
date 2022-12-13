<?php

namespace Sample\User\Domain\Model;

/**
 * @psalm-immutable
 */
class User {
  public function __construct(
    public int $id,
    public string $name,
    public string $email,
  ) {
  }
}
