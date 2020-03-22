<?php

namespace Sample\product\data\mapper;

use harmony\core\domain\Model;
use harmony\core\repository\mapper\EntityToModelMapper;
use Sample\product\data\entity\ProductEntity;
use Sample\product\domain\model\Product;

class ProductEntityToModelMapper extends EntityToModelMapper
{
    /**
     * @param $from
     *
     * @return Model
     */
    protected function overrideMap($from): Model
    {
        /** @var ProductEntity $from */
        $model = new Product(
            $from->getId(),
            $from->getName(),
            $from->getDescription(),
            $from->getPrice()
        );

        return $model;
    }
}
