<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\GetRepository;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

/**
 * @template T
 */
class GetInteractor {
  /**
   * @param GetRepository<T> $getRepository
   */
  public function __construct(
    protected GetRepository $getRepository
  ) {
  }

  /**
   * @param Query     $query     query
   * @param Operation $operation operation
   *
   * @return mixed
   * @phpstan-return T
   */
  public function __invoke(Query $query, Operation $operation): mixed {
    return $this->getRepository->get($query, $operation);
  }
}
