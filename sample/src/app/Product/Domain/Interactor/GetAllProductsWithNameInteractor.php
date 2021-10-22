<?php

namespace Sample\Product\Domain\Interactor;

use Harmony\Core\Domain\Interactor\GetAllInteractor;
use Sample\Product\Data\Query\ProductPaginationSqlQuery;

class GetAllProductsWithNameInteractor {
  public function __construct(protected GetAllInteractor $getAllInteractor) {
  }

  public function __invoke(
    int $offset,
    int $limit,
    string $productName,
  ): array {
    $query = new ProductPaginationSqlQuery($offset, $limit, $productName);

    $items = ($this->getAllInteractor)($query);

    return $items;
  }
}
