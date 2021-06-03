<?php

namespace harmony\core\Domain\Interactor;

use harmony\core\Repository\GetRepository;
use harmony\core\Repository\Operation\Operation;
use harmony\core\Repository\Query\Query;

/**
 * @template T
 */
class GetAllInteractor {
  /**
   * @param GetRepository<T> $getRepository
   */
  public function __construct(
    protected GetRepository $getRepository
  ) {
  }

  /**
   * @param Query     $query
   * @param Operation $operation
   *
   * @return array<T>
   */
  public function __invoke(Query $query, Operation $operation): array {
    return $this->getRepository->getAll($query, $operation);
  }
}
