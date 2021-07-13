<?php

namespace Harmony\Core\Module\Sql\Query;

interface WhereSqlQuery extends ComposedSqlQuery {
  /**
   * @return array<string, mixed>
   */
  public function where(): array;
}
