<?php

namespace Sample\Product\Domain\Model;

class Product {
  public function __construct(
    public readonly int $id,
    public readonly string $name,
    public readonly string $description,
    public readonly float $price,
  ) {
  }
}
