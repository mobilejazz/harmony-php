<?php

namespace Harmony\Core\Module\Sql\DataSource;

interface SqlService {
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
   * @param string               $sql
   * @param array<string, mixed> $params
   *
   * @return bool
   */
  public function transaction(string $sql, array $params): bool;

  public function startTransaction(): void;

  public function endTransaction(): void;

  public function rollbackTransaction(): void;

  /**
   * @param string               $sql
   * @param array<string, mixed> $params
   *
   * @return mixed
   */
  public function execute(string $sql, array $params): mixed;
}
