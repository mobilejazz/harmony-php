<?php

namespace Sample\Product\Data\Entity;

use DateTimeImmutable;

class ProductEntity {
  public function __construct(
    public readonly int $id,
    public readonly string $name,
    public readonly string $description,
    public readonly float $price,
    public readonly DateTimeImmutable $createdAt,
  ) {
  }
}
