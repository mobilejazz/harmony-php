<?php

namespace Sample\User\Domain\Interactor;

use Harmony\Core\Domain\Interactor\GetAllInteractor;
use Sample\User\Data\Query\UserPaginationSqlQuery;
use Sample\User\Domain\Model\User;

class GetAllUsersByNameInteractor {
  /**
   * @param GetAllInteractor<User> $getAllInteractor
   */
  public function __construct(protected GetAllInteractor $getAllInteractor) {
  }

  /**
   * @param int    $offset
   * @param int    $limit
   * @param string $userName
   *
   * @return User[]
   */
  public function __invoke(int $offset, int $limit, string $userName): array {
    $query = new UserPaginationSqlQuery($offset, $limit, $userName);
    $items = ($this->getAllInteractor)($query);

    return $items;
  }
}
