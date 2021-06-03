<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Repository\GetRepository;
use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;

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
