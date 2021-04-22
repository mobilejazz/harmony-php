<?php

namespace Sample\product\domain\model;

class Product {
  public function __construct(
    protected int $id,
    protected string $name,
    protected string $description,
    protected float $price
  ) {
  }

  /**
   * @return int
   */
  public function getId(): int {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * @return string
   */
  public function getDescription(): string {
    return $this->description;
  }

  /**
   * @return float
   */
  public function getPrice(): float {
    return $this->price;
  }
}
