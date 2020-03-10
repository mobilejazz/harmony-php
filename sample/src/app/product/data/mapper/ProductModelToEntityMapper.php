<?php

namespace Sample\product\data\mapper;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\mapper\ModelToEntityMapper;
use Sample\product\data\entity\ProductEntity;
use Sample\product\domain\model\Product;

class ProductModelToEntityMapper extends ModelToEntityMapper
{
    /**
     * @param $from
     *
     * @return BaseEntity
     */
    protected function overrideMap($from): BaseEntity
    {
        /** @var Product $from */
        $entity = new ProductEntity(
            $from->getId(),
            $from->getName(),
            $from->getDescription(),
            $from->getPrice()
        );

        return $entity;
    }
}
