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
   * @param string               $sql
   * @param array<string, mixed> $params
   *
   * @return int|string
   */
  public function insert(string $sql, array $params): int|string;

  /**
   * @param string $sql
   * @param mixed  $params
   *
   * @return mixed
   */
  public function transaction(string $sql, array $params): bool;

  /**
   * @param string               $sql
   * @param array<string, mixed> $params
   *
   * @return mixed
   */
  public function execute(string $sql, array $params): mixed;
}
