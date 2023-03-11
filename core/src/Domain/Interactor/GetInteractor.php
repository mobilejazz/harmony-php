<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Data\Operation\DefaultOperation;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Data\Query\VoidQuery;
use Harmony\Core\Data\Repository\GetRepository;

/**
 * @template T
 */
class GetInteractor {
  /**
   * @param GetRepository<T> $getRepository
   */
  public function __construct(protected readonly GetRepository $getRepository) {
  }

  /**
   * @phpstan-return T
   */
  public function __invoke(
    ?Query $query = null,
    ?Operation $operation = null,
  ): mixed {
    $query = $query ?? new VoidQuery();
    $operation = $operation ?? new DefaultOperation();
    return $this->getRepository->get($query, $operation);
  }
}
