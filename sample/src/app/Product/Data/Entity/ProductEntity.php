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
    $this->setCreatedAt($created_at);
  }

  /**
   * @param Carbon|null $created_at
   */
  protected function setCreatedAt(Carbon $created_at = null): void {
    if ($created_at === null) {
      $created_at = new Carbon();
    }

    $this->created_at = $created_at;
  }
}
