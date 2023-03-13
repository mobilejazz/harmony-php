<?php

namespace Harmony\Core\Module\Sql;

use Harmony\Core\Data\Query\Composed\ComposedQuery;
use Harmony\Core\Data\Query\Composed\IncludeSoftDeletedQuery;
use Harmony\Core\Data\Query\Composed\OrderByQuery;
use Harmony\Core\Data\Query\Composed\PaginationOffsetLimitQuery;
use Harmony\Core\Data\Query\Composed\WhereQuery;
use Harmony\Core\Data\Query\CountQuery;
use Harmony\Core\Data\Query\Criteria\Criteria;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Module\Sql\Schema\SqlSchemaInterface;
use Latitude\QueryBuilder\Query as LatitudeQuery;
use Latitude\QueryBuilder\Query\DeleteQuery as LatitudeDeleteQuery;
use Latitude\QueryBuilder\Query\SelectQuery as LatitudeSelectQuery;
use Latitude\QueryBuilder\Query\UpdateQuery as LatitudeUpdateQuery;
use Latitude\QueryBuilder\QueryFactory as LatitudeQueryFactory;
use function Latitude\QueryBuilder\alias;
use function Latitude\QueryBuilder\field;
use function Latitude\QueryBuilder\func;

/**
 * @link           https://latitude.shadowhand.com/
 * @psalm-suppress PropertyNotSetInConstructor
 */
class SqlBuilder {
  protected SqlSchemaInterface $schema;

  public function __construct(
    protected readonly LatitudeQueryFactory $factory,
  ) {
  }

  public function setSchema(SqlSchemaInterface $schema): void {
    $this->schema = $schema;
  }

  public function getSchema(): SqlSchemaInterface {
    return $this->schema;
  }

  public function getFactory(): LatitudeQueryFactory {
    return $this->factory;
  }

  public function selectById(int|string $id): LatitudeQuery {
    return $this->selectOneWhere($this->schema->getIdColumn(), $id);
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
    ?Query $query = null,
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
      $factory->orderBy(
        $orderBy,
        $ascending ? SqlOrderDirection::ASC : SqlOrderDirection::DESC,
      );
    }

    if (
      !$query instanceof IncludeSoftDeletedQuery &&
      $this->schema->softDeleteEnabled()
    ) {
      $factory->andWhere(field(SqlDefaultColumn::DELETED_AT)->isNull());
    }

    $latitudeQuery = $factory->compile();

    return $latitudeQuery;
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
      $ascending = $composed->ascending()
        ? SqlOrderDirection::ASC
        : SqlOrderDirection::DESC;
      $factory->orderBy($composed->orderBy(), $ascending);
      unset($ascending);
    }

    $factory = $this->addWhereConditions($composed, $factory);
    $query = $factory->compile();

    return $query;
  }

  public function updateById(int|string $id, mixed $entity): LatitudeQuery {
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
      $factory->columns(...array_keys($values));
      $factory->values(...array_values($values));
    }

    $query = $factory->compile();

    return $query;
  }

  protected function getDeleteQuery(): LatitudeUpdateQuery|LatitudeDeleteQuery {
    if ($this->schema->softDeleteEnabled()) {
      return $this->factory->update($this->schema->getTableName(), [
        SqlDefaultColumn::DELETED_AT => func("NOW"),
      ]);
    }

    return $this->factory->delete($this->schema->getTableName());
  }

  public function deleteById(int|string $id): LatitudeQuery {
    return $this->getDeleteQuery()
      ->where(field($this->schema->getIdColumn())->eq($id))
      ->compile();
  }

  /**
   * @param int[]|string[] $ids
   */
  public function deleteByIds(array $ids): LatitudeQuery {
    return $this->getDeleteQuery()
      ->where(field($this->schema->getIdColumn())->in(...$ids))
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

      foreach ($wheres as $where) {
        $field = field($where->field);
        $value = $where->value;

        $condition = match ($where->condition) {
          Criteria::In => $field->in(...(array) $value),
          Criteria::NotIn => $field->notIn(...(array) $value),
          Criteria::Eq => $field->eq($value),
          Criteria::NotEq => $field->notEq($value),
          Criteria::Gt => $field->gt($value),
          Criteria::Gte => $field->gte($value),
          Criteria::Lt => $field->lt($value),
          Criteria::Lte => $field->lte($value),
          Criteria::IsNull => $field->isNull(),
          Criteria::IsNotNull => $field->isNotNull(),
        };

        $factory->andWhere($condition);
      }
    }

    if (
      !$query instanceof IncludeSoftDeletedQuery &&
      $this->schema->softDeleteEnabled()
    ) {
      $factory->andWhere(field(SqlDefaultColumn::DELETED_AT)->isNull());
    }

    return $factory;
  }
}
