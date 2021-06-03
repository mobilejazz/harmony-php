<?php

namespace Sample\Product\Domain\Interactor;

use harmony\core\Domain\Interactor\GetAllInteractor;
use Sample\Product\Domain\Model\Product;

/**
 * @template-extends GetAllInteractor<Product>
 */
class GetAllProductInteractor extends GetAllInteractor {
}
