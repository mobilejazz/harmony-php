<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Repository\Operation\DefaultOperation;
use Harmony\Core\Repository\Operation\Operation;
use Harmony\Core\Repository\PutRepository;
use Harmony\Core\Repository\Query\Query;
use Harmony\Core\Repository\Query\VoidQuery;

/**
 * @template T
 */
class PutAllInteractor {
  /**
   * @param PutRepository<T> $putRepository
   */
  public function __construct(protected readonly PutRepository $putRepository) {
  }

  /**
   * @param array<T>       $models
   * @param Query|null     $query
   * @param Operation|null $operation
   *
   * @return array<T>
   */
  public function __invoke(
    array $models,
    ?Query $query = null,
    ?Operation $operation = null,
  ): array {
    $query = $query ?? new VoidQuery();
    $operation = $operation ?? new DefaultOperation();
    return $this->putRepository->putAll($query, $operation, $models);
  }
}
