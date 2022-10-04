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
class PutInteractor {
  /**
   * @param PutRepository<T> $putRepository
   */
  public function __construct(protected PutRepository $putRepository) {
  }

  /**
   * @param T $model
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
