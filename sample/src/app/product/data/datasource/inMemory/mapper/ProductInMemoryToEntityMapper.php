<?php

namespace Sample\product\data\datasource\inMemory\mapper;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\mapper\InMemoryToEntityMapper;
use Sample\product\data\datasource\inMemory\model\ProductInMemory;
use Sample\product\data\entity\ProductEntity;

class ProductInMemoryToEntityMapper extends InMemoryToEntityMapper
{
    /**
     * @param $from
     *
     * @return BaseEntity
     */
    protected function overrideMap($from): BaseEntity
    {
        /** @var ProductInMemory $from */
        $entity = new ProductEntity(
            $from->getId(),
            $from->getName(),
            $from->getDescription(),
            $from->getPrice(),
            $from->getCreatedAt()
        );

        return $entity;
    }
}
