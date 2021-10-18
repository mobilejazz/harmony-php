<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Data\GetRepository;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;

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
   * @param Query     $query
   * @param Operation $operation
   *
   * @return array<T>
   */
  public function __invoke(Query $query, Operation $operation): array {
    return $this->getRepository->getAll($query, $operation);
  }
}
