<?php

namespace harmony\core\Module\Sql\Query;

interface WhereSqlQuery extends ComposedSqlQuery {
  /**
   * @return array<string, mixed>
   */
  public function where(): array;
}
