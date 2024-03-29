<?php

namespace Harmony\Core\Domain\Interactor;

use Harmony\Core\Data\Operation\DefaultOperation;
use Harmony\Core\Data\Operation\Operation;
use Harmony\Core\Data\Query\CountAllQuery;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Data\Repository\GetRepository;

class GetCountInteractor {
  /**
   * @param GetRepository<int> $getRepository
   */
  public function __construct(protected readonly GetRepository $getRepository) {
  }

  public function __invoke(
    Query $query = new CountAllQuery(),
    Operation $operation = new DefaultOperation(),
  ): int {
    $result = $this->getRepository->get($query, $operation);

    return $result;
  }
}
