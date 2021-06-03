<?php

namespace Sample\Product\Domain\Interactor;

use Harmony\Core\Domain\Interactor\PutAllInteractor;
use Sample\Product\Domain\Model\Product;

/**
 * @template-extends PutAllInteractor<Product>
 */
class PutAllProductInteractor extends PutAllInteractor {
}
