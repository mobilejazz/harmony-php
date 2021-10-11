<?php

namespace Sample\Product\Domain\Model;

/**
 * @psalm-immutable
 */
class Product {
  public function __construct(
    public int $id,
    public string $name,
    public string $description,
    public float $price,
  ) {
  }
}
