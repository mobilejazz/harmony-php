<?php

namespace Harmony\Core\Repository\DataSource\Sql\Helper;

use Harmony\Core\Repository\DataSource\Sql\SqlBaseColumn;
use Harmony\Core\Repository\Query\Composed\ComposedQuery;
use Harmony\Core\Repository\Query\Composed\CountQuery;
use Harmony\Core\Repository\Query\Composed\IncludeSoftDeletedQuery;
use Harmony\Core\Repository\Query\Composed\OrderByQuery;
use Harmony\Core\Repository\Query\Composed\PaginationOffsetLimitQuery;
use Harmony\Core\Repository\Query\Composed\WhereQuery;
use Harmony\Core\Repository\Query\Query;
use Latitude\QueryBuilder\Query as LatitudeQuery;
use Latitude\QueryBuilder\Query\DeleteQuery as LatitudeDeleteQuery;
use Latitude\QueryBuilder\Query\SelectQuery as LatitudeSelectQuery;
use Latitude\QueryBuilder\Query\UpdateQuery as LatitudeUpdateQuery;
use Latitude\QueryBuilder\QueryFactory as LatitudeQueryFactory;
use function Latitude\QueryBuilder\alias;
use function Latitude\QueryBuilder\field;
use function Latitude\QueryBuilder\func;

/**
 * @link https://latitude.shadowhand.com/
 */
class SqlBuilder {
  public function __construct(
    protected SqlSchema $schema,
    protected LatitudeQueryFactory $factory,
  ) {
  }

  public function getSchema(): SqlSchema {
    return $this->schema;
  }

  public function getFactory(): LatitudeQueryFactory {
    return $this->factory;
  }

  public function selectByKey(mixed $value): LatitudeQuery {
    return $this->selectOneWhere($this->schema->getKeyColumn(), $value);
  }

  public function selectById(mixed $value): LatitudeQuery {
    return $this->selectOneWhere($this->schema->getIdColumn(), $value);
  }

  public function selectOneWhere(string $column, mixed $value): LatitudeQuery {
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
    ?int $limit = null,
    ?string $orderBy = null,
    ?bool $ascending = null,
  ): LatitudeQuery {
    $factory = $this->factory->select()->from($this->schema->getTableName());

    if (
      $offset !== null &&
      $limit !== null &&
      $orderBy !== null &&
      $ascending !== null
    ) {
      $factory->offset($offset);
      $factory->limit($limit);
      $factory->orderBy($orderBy, $ascending ? "ASC" : "DESC");
    }

    if ($this->schema->softDeleteEnabled()) {
      $factory->andWhere(field(SqlBaseColumn::DELETED_AT)->eq(null));
    }

    $query = $factory->compile();

    return $query;
  }

  public function selectComposed(ComposedQuery $composed): LatitudeQuery {
    if ($composed instanceof CountQuery) {
      $factory = $this->factory
        ->select(alias(func("COUNT", "*"), "count"))
        ->from($this->schema->getTableName());
    } else {
      $factory = $this->factory->select()->from($this->schema->getTableName());
    }

    $factory = $this->addWhereConditions($composed, $factory);

    $query = $factory->compile();

    return $query;
  }

  public function selectAllComposed(ComposedQuery $composed): LatitudeQuery {
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

  public function updateById(mixed $id, mixed $entity): LatitudeQuery {
    $values = (array) $entity;

    $query = $this->factory
      ->update($this->schema->getTableName(), $values)
      ->where(field($this->schema->getIdColumn())->eq($id))
      ->compile();

    return $query;
  }

  public function insert(mixed $entity): LatitudeQuery {
    $values = (array) $entity;

    $query = $this->factory
      ->insert($this->schema->getTableName(), $values)
      ->compile();

    return $query;
  }

  /**
   * @param object[] $entities
   *
   * @return LatitudeQuery
   */
  public function multiInsert(array $entities): LatitudeQuery {
    $factory = $this->factory->insert($this->schema->getTableName());

    foreach ($entities as $entity) {
      $values = (array) $entity;
      $factory->values($values);
    }

    $query = $factory->compile();

    return $query;
  }

  protected function getDeleteQuery(): LatitudeUpdateQuery|LatitudeDeleteQuery {
    if ($this->schema->softDeleteEnabled()) {
      return $this->factory->update($this->schema->getTableName(), [
        SqlBaseColumn::DELETED_AT => func("NOW"),
      ]);
    }

    return $this->factory->delete($this->schema->getTableName());
  }

  public function deleteById(mixed $value): LatitudeQuery {
    return $this->getDeleteQuery()
      ->where(field($this->schema->getIdColumn())->eq($value))
      ->compile();
  }

  public function deleteByKey(mixed $value): LatitudeQuery {
    return $this->getDeleteQuery()
      ->where(field($this->schema->getKeyColumn())->eq($value))
      ->compile();
  }

  public function deleteComposed(ComposedQuery $composed): LatitudeQuery {
    $deleteQuery = $this->getDeleteQuery();

    return $this->addWhereConditions($composed, $deleteQuery)->compile();
  }

  /**
   * @param Query                                                       $query
   * @param LatitudeSelectQuery|LatitudeUpdateQuery|LatitudeDeleteQuery $factory
   *
   * @return LatitudeSelectQuery|LatitudeUpdateQuery|LatitudeDeleteQuery
   */
  protected function addWhereConditions(
    Query $query,
    LatitudeSelectQuery|LatitudeUpdateQuery|LatitudeDeleteQuery $factory,
  ): LatitudeSelectQuery|LatitudeUpdateQuery|LatitudeDeleteQuery {
    if ($query instanceof WhereQuery) {
      $wheres = $query->where();

      foreach ($wheres as $column => $value) {
        $factory->andWhere(field($column)->eq($value));
      }
    }

    if (
      !$query instanceof IncludeSoftDeletedQuery &&
      $this->schema->softDeleteEnabled()
    ) {
      $factory->andWhere(field(SqlBaseColumn::DELETED_AT)->isNull());
    }

    return $factory;
  }
}
