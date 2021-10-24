<?php

namespace Sample\Product\Domain\Interactor;

use Harmony\Core\Domain\Interactor\GetAllInteractor;
use Sample\Product\Data\Query\ProductPaginationSqlQuery;
use Sample\Product\Domain\Model\Product;

class GetAllProductsWithNameInteractor {
  /**
   * @param GetAllInteractor<Product> $getAllInteractor
   */
  public function __construct(protected GetAllInteractor $getAllInteractor) {
  }

  /**
   * @param int    $offset
   * @param int    $limit
   * @param string $productName
   *
   * @return Product[]
   */
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
