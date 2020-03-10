<?php

namespace Sample\product\data\datasource\inMemory\mapper;

use harmony\core\repository\InMemoryEntity;
use harmony\core\repository\mapper\EntityToInMemoryMapper;
use Sample\product\data\datasource\inMemory\model\ProductInMemory;
use Sample\product\data\entity\ProductEntity;

class ProductEntityToInMemoryMapper extends EntityToInMemoryMapper
{
    /**
     * @param $from
     *
     * @return mixed|ProductInMemory
     */
    protected function overrideMap($from): InMemoryEntity
    {
        /** @var ProductEntity $from */
        $inMemory = new ProductInMemory(
            $from->getId(),
            $from->getName(),
            $from->getDescription(),
            $from->getPrice(),
            $from->getCreatedAt()
        );

        return $inMemory;
    }
}
