<?php

namespace harmony\core\Domain\Interactor;

use harmony\core\Repository\Operation\Operation;
use harmony\core\Repository\PutRepository;
use harmony\core\Repository\Query\Query;

/**
 * @template T
 */
class PutInteractor {
  /**
   * @param PutRepository<T> $putRepository
   */
  public function __construct(
    protected PutRepository $putRepository
  ) {
  }

  /**
   * @param Query     $query
   * @param Operation $operation
   * @param T|null    $model
   *
   * @return mixed
   * @phpstan-return T
   */
  public function __invoke(Query $query, Operation $operation, mixed $model = null): mixed {
    return $this->putRepository->put($query, $operation, $model);
  }
}
