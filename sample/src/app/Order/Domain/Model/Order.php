<?php

namespace Sample\Order\Domain\Model;

/**
 * @psalm-immutable
 */
class Order {
  public function __construct(
    public int $id,
    public int $userId,
    public string $status,
    public int $createdAt,
  ) {
  }
}
