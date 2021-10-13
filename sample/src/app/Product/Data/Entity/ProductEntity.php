<?php

namespace Sample\Product\Data\Entity;

use Carbon\Carbon;

/**
 * @psalm-immutable
 */
class ProductEntity {
  public Carbon $created_at;

  public function __construct(
    public int $id,
    public string $name,
    public string $description,
    public float $price,
    Carbon $created_at = null,
  ) {
    $this->created_at = $created_at ?? new Carbon();
  }
}
