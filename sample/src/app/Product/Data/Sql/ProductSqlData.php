<?php

namespace Sample\Product\Data\Sql;

class ProductSqlData {
  public function __construct(
    public readonly int $id,
    public readonly string $name,
    public readonly string $description,
    public readonly float $price,
    public readonly string $created_at,
  ) {
  }
}
