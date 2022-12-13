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
class GetInteractor {
  /**
   * @param GetRepository<T> $getRepository
   */
  public function __construct(protected GetRepository $getRepository) {
  }

  /**
   * @param Query|null     $query
   * @param Operation|null $operation
   *
   * @return mixed
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
