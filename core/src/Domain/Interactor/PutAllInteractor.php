<?php

namespace harmony\core\Domain\Interactor;

use harmony\core\Repository\Operation\Operation;
use harmony\core\Repository\PutRepository;
use harmony\core\Repository\Query\Query;

/**
 * @template T
 */
class PutAllInteractor {
  /**
   * @param PutRepository<T> $putRepository
   */
  public function __construct(
    protected PutRepository $putRepository
  ) {
  }

  /**
   * @param Query         $query
   * @param Operation     $operation
   * @param array<T>|null $models
   *
   * @return array<T>
   */
  public function __invoke(Query $query, Operation $operation, array $models = null): array {
    return $this->putRepository->putAll($query, $operation, $models);
  }
}
