<?php

namespace App\Tests\Sample\Product\Data\Mapper;

use PHPUnit\Framework\TestCase;
use Sample\Product\Data\Entity\ProductEntity;
use Sample\Product\Data\Mapper\ProductEntityToProductMapper;

class ProductEntityToModelMapperTest extends TestCase {
  public function testMap(): void {
    $entity = new ProductEntity(1234, "superName", "someDescription", 66.333);
    $mapperModel = (new ProductEntityToProductMapper())->map($entity);

    $this->assertSame($entity->id, $mapperModel->id);
    $this->assertSame($entity->name, $mapperModel->name);
    $this->assertSame($entity->description, $mapperModel->description);
    $this->assertSame($entity->price, $mapperModel->price);
  }
}
