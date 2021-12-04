<?php

namespace App\Tests\Sample\Product\Data\Mapper;

use PHPUnit\Framework\TestCase;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Data\Mapper\ProductEntityToProductMapper;
use Sample\Product\Domain\Model\Product;

class ProductEntityToModelMapperTest extends TestCase {
  public function testMap(): void {
    $entity = new ProductEntity(1234, "superName", "someDescription", 66.333);
    $model = (new ProductEntityToProductMapper())->map($entity);

    $this->assertInstanceOf(Product::class, $model);

    // @todo Generic Test for mappers.
    // Reflection to compare attributes?
    // Input From Object and check expected output
    $this->assertSame($entity->id, $model->id);
    $this->assertSame($entity->name, $model->name);
    $this->assertSame($entity->description, $model->description);
    $this->assertSame($entity->price, $model->price);
  }
}
