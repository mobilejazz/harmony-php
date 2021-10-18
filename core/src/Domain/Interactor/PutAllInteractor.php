<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\PutRepository;
use Harmony\Core\Data\Query\Query;

/**
 * @template T
 */
class PutAllInteractor {
  /**
   * @param PutRepository<T> $putRepository
   */
  public function __construct(protected PutRepository $putRepository) {
  }

  /**
   * @param Query         $query
   * @param Operation     $operation
   * @param array<T>|null $models
   *
   * @return array<T>
   */
  public function __invoke(
    Query $query,
    Operation $operation,
    array $models = null,
  ): array {
    return $this->putRepository->putAll($query, $operation, $models);
  }
}
