<?php

namespace Harmony\Core\Repository\DataSource\Sql\Helper;

use Harmony\Core\Repository\DataSource\Sql\SqlBaseColumn;
use Harmony\Core\Repository\Query\Composed\ComposedQuery;
use Harmony\Core\Repository\Query\Composed\CountQuery;
use Harmony\Core\Repository\Query\Composed\OrderByQuery;
use Harmony\Core\Repository\Query\Composed\PaginationOffsetLimitQuery;
use Harmony\Core\Repository\Query\Composed\WhereQuery;
use Harmony\Core\Repository\Query\Query;
use Latitude\QueryBuilder\Query as SqlQuery;
use Latitude\QueryBuilder\Query\SelectQuery;
use Latitude\QueryBuilder\Query\UpdateQuery;
use Latitude\QueryBuilder\QueryFactory;
use function Latitude\QueryBuilder\alias;
use function Latitude\QueryBuilder\field;
use function Latitude\QueryBuilder\func;

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

  public function selectByKey(mixed $value): SqlQuery {
    return $this->selectOneWhere($this->schema->getKeyColumn(), $value);
  }

  public function selectById(mixed $value): SqlQuery {
    return $this->selectOneWhere($this->schema->getIdColumn(), $value);
  }

  public function selectOneWhere(string $column, mixed $value): SqlQuery {
    $query = $this->factory
      ->select()
      ->from($this->schema->getTableName())
      ->where(field($column)->eq($value))
      ->limit(1)
      ->compile();

    return $query;
  }

  public function selectAll(?int $offset = null, ?int $limit = null): SqlQuery {
    $factory = $this->factory->select()->from($this->schema->getTableName());

    if ($offset !== null && $limit !== null) {
      $factory->offset($offset);
      $factory->limit($limit);
    }

    if ($this->schema->softDeleteEnabled()) {
      $factory->andWhere(field(SqlBaseColumn::DELETED_AT)->eq(null));
    }

    $query = $factory->compile();

    return $query;
  }

  public function selectComposed(ComposedQuery $composed): SqlQuery {
    $factory = $this->factory->select()->from($this->schema->getTableName());

    $factory = $this->addWhereConditions($composed, $factory);

    if ($composed instanceof CountQuery) {
      $factory = $this->factory->select(alias(func("COUNT", "*"), "count"));
    }

    $query = $factory->compile();

    return $query;
  }

  public function selectAllComposed(ComposedQuery $composed): SqlQuery {
    $factory = $this->factory->select()->from($this->schema->getTableName());

    if ($composed instanceof PaginationOffsetLimitQuery) {
      $factory->offset($composed->offset());
      $factory->limit($composed->limit());
    }

    if ($composed instanceof OrderByQuery) {
      $ascending = $composed->ascending() ? "ASC" : "DESC";
      $factory->orderBy($composed->orderBy(), $ascending);
      unset($ascending);
    }

    $factory = $this->addWhereConditions($composed, $factory);

    $query = $factory->compile();

    return $query;
  }

  public function updateById(mixed $id, mixed $entity): SqlQuery {
    $values = (array) $entity;

    $query = $this->factory
      ->update($this->schema->getTableName(), $values)
      ->where(field($this->schema->getIdColumn())->eq($id))
      ->compile();

    return $query;
  }

  public function insert(mixed $entity): SqlQuery {
    $values = (array) $entity;

    $query = $this->factory
      ->insert($this->schema->getTableName(), $values)
      ->compile();

    return $query;
  }

  /**
   * @param object[] $entities
   *
   * @return SqlQuery
   */
  public function multiInsert(array $entities): SqlQuery {
    $factory = $this->factory->insert($this->schema->getTableName());

    foreach ($entities as $entity) {
      $values = (array) $entity;
      $factory->values($values);
    }

    $query = $factory->compile();

    return $query;
  }

  public function deleteById(mixed $value): SqlQuery {
    if ($this->schema->softDeleteEnabled()) {
      $factory = $this->factory
        ->update($this->schema->getTableName(), [
          SqlBaseColumn::DELETED_AT => func("NOW"),
        ])
        ->where(field($this->schema->getIdColumn())->eq($value));
    } else {
      $factory = $this->factory
        ->delete($this->schema->getTableName())
        ->where(field($this->schema->getIdColumn())->eq($value));
    }

    $query = $factory->compile();

    return $query;
  }

  public function deleteByKey(mixed $value): SqlQuery {
    if ($this->schema->softDeleteEnabled()) {
      $factory = $this->factory
        ->update($this->schema->getTableName(), [
          SqlBaseColumn::DELETED_AT => func("NOW"),
        ])
        ->where(field($this->schema->getKeyColumn())->eq($value));
    } else {
      $factory = $this->factory
        ->delete($this->schema->getTableName())
        ->where(field($this->schema->getKeyColumn())->eq($value));
    }

    $query = $factory->compile();

    return $query;
  }

  public function deleteComposed(ComposedQuery $composed): SqlQuery {
    if ($this->schema->softDeleteEnabled()) {
      $factory = $this->factory
        ->update($this->schema->getTableName(), [
          SqlBaseColumn::DELETED_AT => func("NOW"),
        ]);
    } else {
      $factory = $this->factory
        ->delete($this->schema->getTableName());
    }

    $factory = $this->addWhereConditions($composed, $factory);

    $query = $factory->compile();

    return $query;
  }

  /**
   * @param Query                   $query
   * @param SelectQuery|UpdateQuery $factory
   *
   * @return SelectQuery|UpdateQuery
   */
  public function addWhereConditions(
    Query $query,
    SelectQuery|UpdateQuery $factory
  ): SelectQuery|UpdateQuery {
    if ($query instanceof WhereQuery) {
      $wheres = $query->where();

      foreach ($wheres as $column => $value) {
        $factory->andWhere(field($column)->eq($value));
      }
    }

    if ($this->schema->softDeleteEnabled()) {
      $factory->andWhere(field(SqlBaseColumn::DELETED_AT)->eq(null));
    }

    return $factory;
  }
}
