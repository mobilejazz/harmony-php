<?php

namespace Harmony\Core\Module\Sql\Helper;

interface SqlSchema {
  public function getTableName(): string;

  public function getIdColumn(): string;

  public function getKeyColumn(): string;

  public function getReturnClass(): ?string;
}
