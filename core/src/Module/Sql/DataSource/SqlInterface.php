<?php

namespace Harmony\Core\Module\Sql\DataSource;

interface SqlInterface {
  /**
   * @param string       $sql
   * @param mixed[]      $params
   * @param class-string $returnClass
   *
   * @return mixed
   */
  public function findOne(
    string $sql,
    array $params,
    string $returnClass,
  ): mixed;

  /**
   * @param string       $sql
   * @param mixed[]      $params
   * @param class-string $returnClass
   *
   * @return object[]
   */
  public function findAll(
    string $sql,
    array $params,
    string $returnClass,
  ): array;

  /**
   * @param string  $sql
   * @param mixed[] $params
   *
   * @return bool
   */
  public function transaction(string $sql, array $params): bool;

  /**
   * @param string       $sql
   * @param mixed[]      $params
   * @param class-string $returnClass
   *
   * @return mixed
   */
  public function execute(
    string $sql,
    array $params,
    string $returnClass,
  ): mixed;
}
