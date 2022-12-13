<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Repository\DeleteRepository;
use Harmony\Core\Repository\Operation\DefaultOperation;
use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

class DeleteInteractor {
  public function __construct(
    protected readonly DeleteRepository $deleteRepository,
  ) {
  }

  public function __invoke(Query $query, ?Operation $operation = null): void {
    $operation = $operation ?? new DefaultOperation();
    $this->deleteRepository->delete($query, $operation);
  }
}
