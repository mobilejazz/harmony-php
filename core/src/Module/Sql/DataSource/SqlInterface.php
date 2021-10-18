<?php

namespace Harmony\Core\Module\Sql\DataSource;

interface SqlInterface {
  /**
   * @param string $sql
   * @param mixed[]  $params
   *
   * @return mixed
   */
  public function findOne(string $sql, array $params): mixed;

  /**
   * @param string $sql
   * @param mixed[]  $params
   *
   * @return object[]
   */
  public function findAll(string $sql, array $params): array;

  /**
   * @param string $sql
   * @param mixed[]  $params
   *
   * @return bool
   */
  public function transaction(string $sql, array $params): bool;

  /**
   * @param string $sql
   * @param mixed[]  $params
   *
   * @return mixed
   */
  public function execute(string $sql, array $params): mixed;
}
