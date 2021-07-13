<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Repository\GetRepository;
use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

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
