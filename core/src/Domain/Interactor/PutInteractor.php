<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Data\Operation\DefaultOperation;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Data\Query\VoidQuery;
use Harmony\Core\Data\Repository\PutRepository;

/**
 * @template T
 */
class PutInteractor {
  /**
   * @param PutRepository<T> $putRepository
   */
  public function __construct(protected readonly PutRepository $putRepository) {
  }

  /**
   * @param T         $model
   * @param Query     $query
   * @param Operation $operation
   *
   * @return mixed
   */
  public function __invoke(
    mixed $model = null,
    Query $query = new VoidQuery(),
    Operation $operation = new DefaultOperation(),
  ): mixed {
    return $this->putRepository->put(
      query: $query,
      models: $model,
      operation: $operation,
    );
  }
}
