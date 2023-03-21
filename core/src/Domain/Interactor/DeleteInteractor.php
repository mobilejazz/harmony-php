<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Data\Operation\DefaultOperation;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Data\Repository\DeleteRepository;

class DeleteInteractor {
  public function __construct(
    protected readonly DeleteRepository $deleteRepository,
  ) {
  }

  public function __invoke(
    Query $query,
    Operation $operation = new DefaultOperation(),
  ): void {
    $this->deleteRepository->delete($query, $operation);
  }
}
