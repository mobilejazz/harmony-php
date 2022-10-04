<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Repository\GetRepository;
use Harmony\Core\Repository\Operation\DefaultOperation;
use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\AllQuery;
use Harmony\Core\Repository\Query\Query;

/**
 * @template T
 */
class GetAllInteractor {
  /**
   * @param GetRepository<T> $getRepository
   */
  public function __construct(protected GetRepository $getRepository) {
  }

  /**
   * @return array<T>
   */
  public function __invoke(
    ?Query $query = null,
    ?Operation $operation = null,
  ): array {
    $query = $query ?? new AllQuery();
    $operation = $operation ?? new DefaultOperation();
    return $this->getRepository->getAll($query, $operation);
  }
}
