<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Repository\DeleteRepository;
use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

class DeleteInteractor {
  public function __construct(
    protected DeleteRepository $deleteRepository
  ) {
  }

  /**
   * @param Query     $query     query
   * @param Operation $operation operation
   *
   * @return void
   */
  public function __invoke(Query $query, Operation $operation): void {
    $this->deleteRepository->delete($query, $operation);
  }
}
