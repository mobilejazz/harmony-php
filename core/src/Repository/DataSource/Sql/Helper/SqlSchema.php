<?php

namespace Harmony\Core\Repository\DataSource\Sql\Helper;

interface SqlSchema {
  public function getTableName(): string;

  public function getIdColumn(): string;

  public function getKeyColumn(): string;

  public function softDeleteEnabled(): bool;

  public function getReturnClass(): ?string;
}
