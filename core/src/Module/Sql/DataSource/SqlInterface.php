<?php

namespace Harmony\Core\Module\Sql\DataSource;

interface SqlInterface {
  /**
   * @param string               $sql
   * @param array<string, mixed> $params
   *
   * @return object|null
   */
  public function findOne(string $sql, array $params): ?object;

  /**
   * @param string               $sql
   * @param array<string, mixed> $params
   *
   * @return object[]
   */
  public function findAll(string $sql, array $params): array;

  /**
   * @param Callable $callback
   * @param mixed    $params
   *
   * @return mixed
   */
  public function transaction(callable $callback, mixed $params): mixed;

  /**
   * @param string               $sql
   * @param array<string, mixed> $params
   *
   * @return mixed
   */
  public function execute(string $sql, array $params): mixed;
}
