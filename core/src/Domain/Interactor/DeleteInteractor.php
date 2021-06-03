<?php

namespace harmony\core\Domain\Interactor;

use harmony\core\Repository\DeleteRepository;
use harmony\core\Repository\Operation\Operation;
use harmony\core\Repository\Query\Query;

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
