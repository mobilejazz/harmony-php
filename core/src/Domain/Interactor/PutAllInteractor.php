<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\PutRepository;
use Harmony\Core\Repository\Query\Query;

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
