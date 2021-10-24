<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Data\DeleteRepository;
use Harmony\Core\Data\Operation\DefaultOperation;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;

/**
 * @template T
 */
class DeleteInteractor {
  /**
   * @param DeleteRepository<T> $deleteRepository
   */
  public function __construct(protected DeleteRepository $deleteRepository) {
  }

  /**
   * @param Query          $query
   * @param Operation|null $operation
   *
   * @return void
   */
  public function __invoke(Query $query, ?Operation $operation = null): void {
    $operation = $operation ?? new DefaultOperation();
    $this->deleteRepository->delete($query, $operation);
  }
}
