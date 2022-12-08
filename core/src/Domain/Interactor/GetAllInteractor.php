<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Repository\GetRepository;
use Harmony\Core\Repository\Operation\DefaultOperation;
use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\Query\Query;
use Harmony\Core\Repository\Query\VoidQuery;

/**
 * @template T
 */
class GetAllInteractor {
  /**
   * @param GetRepository<T> $getRepository
   */
  public function __construct(protected readonly GetRepository $getRepository) {
  }

  /**
   * @return array<T>
   */
  public function __invoke(
    ?Query $query = null,
    ?Operation $operation = null,
  ): array {
    $query = $query ?? new VoidQuery();
    $operation = $operation ?? new DefaultOperation();
    return $this->getRepository->getAll($query, $operation);
  }
}
