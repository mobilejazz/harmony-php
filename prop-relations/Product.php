<?php

class Product
{
  public function __construct (
    public readonly int $id,
    public readonly string $name,
    /** @var Collection<Category> */
    public readonly Collection $categories,
    // Option: add ID
    public readonly ?int $brandId = null,
    // Option: add Model
    public readonly ?Brand $brand = null,
    // Option: schrodinger cat
    public readonly ?Relation $brand_ = null,
  )
  {
  }
}
