<?php

class Category
{
  public function __construct (
    public readonly int $id,
    public readonly string $name,
  ) {
  }
}
