<?php

namespace Sample\Product\Data\Entity;

use Carbon\CarbonImmutable;

class ProductEntity {
  public function __construct(
    public readonly int $id,
    public readonly string $name,
    public readonly string $description,
    public readonly float $price,
    public readonly ?CarbonImmutable $createdAt,
  ) {
  }
}
