<?php

namespace harmony\core\Domain\Interactor;

use harmony\core\Repository\GetRepository;
use harmony\core\Repository\Operation\Operation;
use harmony\core\Repository\Query\Query;

/**
 * @template T
 */
class GetInteractor {
  /**
   * @param GetRepository<T> $getRepository
   */
  public function __construct(
    protected GetRepository $getRepository
  ) {
  }

  /**
   * @param Query     $query     query
   * @param Operation $operation operation
   *
   * @return mixed
   * @phpstan-return T
   */
  public function __invoke(Query $query, Operation $operation): mixed {
    return $this->getRepository->get($query, $operation);
  }
}
