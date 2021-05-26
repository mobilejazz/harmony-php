<?php

namespace harmony\core\module\pdo;

use Latitude\QueryBuilder\Query;
use Latitude\QueryBuilder\QueryFactory;
use function Latitude\QueryBuilder\field;

/**
 * @link https://latitude.shadowhand.com/
 */
class SqlBuilder {
  public function __construct(
    protected SqlSchemaInterface $schema,
    protected QueryFactory $factory
  ) {
  }

  public function getSchema(): SqlSchemaInterface {
    return $this->schema;
  }

  public function getFactory(): QueryFactory {
    return $this->factory;
  }

  public function selectByKey($value): Query {
    return $this->selectWhere($this->schema->getKeyColumn(), $value);
  }

  public function selectById($value): Query {
    return $this->selectWhere($this->schema->getIdColumn(), $value);
  }

  public function selectWhere(string $column, $value): Query {
    $query = $this->factory
      ->select()
      ->from($this->schema->getTableName())
      ->where(field($column)->eq($value))
      ->limit(1)
      ->compile();

    return $query;
  }

  public function selectAll(): Query {
    $query = $this->factory
      ->select()
      ->from($this->schema->getTableName())
      ->compile();

    return $query;
  }

  public function updateById($id, PdoEntityInterface $entity): Query {
    $values = $entity->getColumnsWithValues();

    $query = $this->factory
      ->update(
        $this->schema->getTableName(),
        $values
      )
      ->where(field($this->schema->getIdColumn())->eq($id))
      ->compile();

    return $query;
  }

  public function insert(PdoEntityInterface $entity): Query {
    $values = $entity->getColumnsWithValues();

    $query = $this->factory
      ->insert($this->schema->getTableName(), $values)
      ->compile();

    return $query;
  }

  public function multiInsert(array $entities): Query {
    $factory = $this->factory
      ->insert($this->schema->getTableName());

    foreach ($entities as $entity) {
      $values = $entity->getColumnsWithValues();
      $factory->values($values);
    }

    $query = $factory->compile();

    return $query;
  }

  public function deleteById($value): Query {
    $query = $this->factory
      ->delete($this->schema->getTableName())
      ->where(field($this->schema->getIdColumn())->eq($value))
      ->compile();

    return $query;
  }
}
