<?php

namespace Harmony\Core\Module\Sql\Helper;

use Harmony\Core\Module\Sql\Query\ComposedQuery;
use Harmony\Core\Module\Sql\Query\OrderByQuery;
use Harmony\Core\Module\Sql\Query\WhereQuery;
use Harmony\Core\Repository\Query\PaginationOffsetLimitQuery;
use Latitude\QueryBuilder\Query;
use Latitude\QueryBuilder\QueryFactory;
use function Latitude\QueryBuilder\field;

/**
 * @link https://latitude.shadowhand.com/
 */
class SqlBuilder {
  public function __construct(
    protected SqlSchema $schema,
    protected QueryFactory $factory
  ) {
  }

  public function getSchema(): SqlSchema {
    return $this->schema;
  }

  public function getFactory(): QueryFactory {
    return $this->factory;
  }

  public function selectByKey(mixed $value): Query {
    return $this->selectOneWhere($this->schema->getKeyColumn(), $value);
  }

  public function selectById(mixed $value): Query {
    return $this->selectOneWhere($this->schema->getIdColumn(), $value);
  }

  public function selectOneWhere(string $column, mixed $value): Query {
    $query = $this->factory
      ->select()
      ->from($this->schema->getTableName())
      ->where(field($column)->eq($value))
      ->limit(1)
      ->compile();

    return $query;
  }

  public function selectAll(
    ?int $offset = null,
    ?int $limit = null
  ): Query {
    $factory = $this->factory
      ->select()
      ->from($this->schema->getTableName());

    if (
      $offset !== null
      && $limit !== null
    ) {
      $factory->offset($offset);
      $factory->limit($limit);
    }

    $query = $factory->compile();

    return $query;
  }

  public function selectAllComposed(ComposedQuery $composed): Query {
    $factory = $this->factory
      ->select()
      ->from($this->schema->getTableName());

    if ($composed instanceof PaginationOffsetLimitQuery) {
      $factory->offset($composed->offset());
      $factory->limit($composed->limit());
    }

    if ($composed instanceof OrderByQuery) {
      $ascending = $composed->ascending() ? 'ASC' : 'DESC';
      $factory->orderBy($composed->orderBy(), $ascending);
      unset($ascending);
    }

    if ($composed instanceof WhereQuery) {
      $wheres = $composed->where();

      foreach ($wheres as $column => $value) {
        $factory->where(field($column)->eq($value));
      }
    }

    $query = $factory->compile();
    return $query;
  }

  public function updateById(mixed $id, mixed $entity): Query {
    $values = (array) $entity;

    $query = $this->factory
      ->update(
        $this->schema->getTableName(),
        $values
      )
      ->where(field($this->schema->getIdColumn())->eq($id))
      ->compile();

    return $query;
  }

  public function insert(mixed $entity): Query {
    $values = (array) $entity;

    $query = $this->factory
      ->insert($this->schema->getTableName(), $values)
      ->compile();

    return $query;
  }

  /**
   * @param object[] $entities
   *
   * @return Query
   */
  public function multiInsert(array $entities): Query {
    $factory = $this->factory
      ->insert($this->schema->getTableName());

    foreach ($entities as $entity) {
      $values = (array) $entity;
      $factory->values($values);
    }

    $query = $factory->compile();

    return $query;
  }

  public function deleteById(mixed $value): Query {
    $query = $this->factory
      ->delete($this->schema->getTableName())
      ->where(field($this->schema->getIdColumn())->eq($value))
      ->compile();

    return $query;
  }
}
