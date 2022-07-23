<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Repository\GetRepository;
use Harmony\Core\Repository\Operation\DefaultOperation;
use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\CountAllQuery;
use Harmony\Core\Repository\Query\Query;

/**
 * @template T
 */
class GetCountInteractor {
  /**
   * @param GetRepository<T> $getRepository
   */
  public function __construct(protected GetRepository $getRepository) {
  }

  public function __invoke(
    ?Query $query = null,
    ?Operation $operation = null
  ): int {
    $query = $query ?? new CountAllQuery();
    $operation = $operation ?? new DefaultOperation();

    return $this->getRepository->getCount($query, $operation);
  }
}
