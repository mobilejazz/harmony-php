<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Data\Operation\DefaultOperation;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Data\Query\VoidQuery;
use Harmony\Core\Data\Repository\PutRepository;

/**
 * @template T
 */
class PutInteractor {
  /**
   * @param PutRepository<T> $putRepository
   */
  public function __construct(protected readonly PutRepository $putRepository) {
  }

  /**
   * @param T              $model
   * @param Query|null     $query
   * @param Operation|null $operation
   *
   * @return mixed
   * @phpstan-return T
   */
  public function __invoke(
    mixed $model = null,
    ?Query $query = null,
    ?Operation $operation = null,
  ): mixed {
    $query = $query ?? new VoidQuery();
    $operation = $operation ?? new DefaultOperation();
    return $this->putRepository->put($query, $operation, $model);
  }
}
