<?php

namespace Sample\product\data\mapper;

use harmony\core\repository\mapper\GenericMapper;
use Sample\product\data\entity\ProductEntity;
use Sample\product\domain\model\Product;

class ProductToProductEntityMapper extends GenericMapper
{
    public function __construct()
    {
        parent::__construct(
            Product::class,
            ProductEntity::class
        );
    }

    /**
     * @param Product $from
     *
     * @return ProductEntity
     */
    protected function overrideMap($from): ProductEntity
    {
        $entity = new ProductEntity(
            $from->getId(),
            $from->getName(),
            $from->getDescription(),
            $from->getPrice()
        );

        return $entity;
    }
}
