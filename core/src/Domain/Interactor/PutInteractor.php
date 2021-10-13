<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\PutRepository;
use Harmony\Core\Repository\Query\Query;

/**
 * @template T
 */
class PutInteractor {
  /**
   * @param PutRepository<T> $putRepository
   */
  public function __construct(protected PutRepository $putRepository) {
  }

  /**
   * @param Query $query
   * @param Operation $operation
   * @param T|null $model
   *
   * @return mixed
   * @phpstan-return T
   */
  public function __invoke(
    Query $query,
    Operation $operation,
    mixed $model = null,
  ): mixed {
    return $this->putRepository->put($query, $operation, $model);
  }
}
