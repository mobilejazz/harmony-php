<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\DeleteRepository;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

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
  public function execute(Query $query, Operation $operation): void {
    $this->deleteRepository->delete($query, $operation);
  }
}
