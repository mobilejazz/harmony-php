<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\PutRepository;
use Harmony\Core\Data\Query\Query;

/**
 * @template T
 */
class PutAllInteractor {
  /**
   * @param PutRepository<T> $putRepository
   */
  public function __construct(protected PutRepository $putRepository) {
  }

  /**
   * @param array<T>  $models
   * @param Query|null $query
   * @param Operation|null $operation
   *
   * @return array<T>
   */
  public function __invoke(
    array $models,
    ?Query $query = null,
    ?Operation $operation = null
  ): array {
    $query = $query ?? new VoidQuery();
    $operation = $operation ?? new DefaultOperation();
    return $this->putRepository->putAll($query, $operation, $models);
  }
}
