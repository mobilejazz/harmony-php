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
   * @param Query|null $query
   * @param Operation|null $operation
   *
   * @return array<T>
   */
  public function __invoke(
    ?Query $query = null,
    ?Operation $operation = null
  ): array {
    $query = $query ?? new VoidQuery();
    $operation = $operation ?? new DefaultOperation();
    return $this->getRepository->getAll($query, $operation);
  }
}
