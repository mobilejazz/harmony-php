<?php

namespace harmony\core\module\pdo;

use harmony\core\repository\datasource\DeleteDataSource;
use harmony\core\repository\datasource\GetDataSource;
use harmony\core\repository\datasource\PutDataSource;
use harmony\core\repository\query\Query;

class PdoDataSource implements GetDataSource, PutDataSource, DeleteDataSource {
  public function get(Query $query) {
    // TODO: Implement get() method.
  }

  public function getAll(Query $query): array {
    // TODO: Implement getAll() method.
  }

  public function put(Query $query, $entity = null) {
    // TODO: Implement put() method.
  }

  public function putAll(Query $query, array $entities = null): array {
    // TODO: Implement putAll() method.
  }

  public function delete(Query $query): void {
    // TODO: Implement delete() method.
  }
}
