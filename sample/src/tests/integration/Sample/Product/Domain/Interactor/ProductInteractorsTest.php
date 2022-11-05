<?php

namespace App\Tests\integration\Sample\Product\Domain\Interactor;

use App\Tests\Helper\Pdo\DatabaseTest;
use PHPUnit\Framework\TestCase;
use Sample\Product\Domain\Interactor\GetProductInteractor;

class ProductInteractorsTest extends TestCase {
  use DatabaseTest;

  public function testOnEmptyDbReturnNothing(): void {
    $interactor = $this->getInteractor();
    // @todo
  }

  protected function getInteractor(): GetProductInteractor {
    // @todo
  }
}
