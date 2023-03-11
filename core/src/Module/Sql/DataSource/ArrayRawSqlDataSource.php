<?php

namespace Harmony\Core\Module\Sql\DataSource;

use Harmony\Core\Data\DataSource\DeleteDataSource;
use Harmony\Core\Data\DataSource\GetDataSource;
use Harmony\Core\Data\DataSource\PutDataSource;
use Harmony\Core\Data\Error\DataNotFoundException;
use Harmony\Core\Data\Error\QueryNotSupportedException;
use Harmony\Core\Data\Query\AllQuery;
use Harmony\Core\Data\Query\Composed\ComposedQuery;
use Harmony\Core\Data\Query\IdsQuery;
use Harmony\Core\Data\Query\Query;
use Harmony\Core\Data\Query\VoidQuery;
use Harmony\Core\Module\Sql\Schema\SqlSchemaInterface;
use Harmony\Core\Module\Sql\SqlBuilder;
use InvalidArgumentException;

/**
 * @see RawSqlProductInteractorsTest
 *
 * @implements GetDataSource<mixed[]>
 * @implements PutDataSource<mixed[]>
 */
class ArrayRawSqlDataSource implements
  GetDataSource,
  PutDataSource,
  DeleteDataSource {
  protected readonly RawSqlDataSource $rawSqlDataSource;

  public function __construct(
    protected readonly SqlServiceInterface $pdo,
    protected readonly SqlBuilder $sqlBuilder,
    protected readonly SqlSchemaInterface $schema,
  ) {
    $this->sqlBuilder->setSchema($schema);
    $this->rawSqlDataSource = new RawSqlDataSource($pdo, $sqlBuilder, $schema);
  }

  /**
   * @return mixed[]
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function get(Query $query): array {
    $sql = match (true) {
      $query instanceof AllQuery => $this->sqlBuilder->selectAll(),
      $query instanceof ComposedQuery => $this->sqlBuilder->selectAllComposed(
        $query,
      ),
      default => throw new QueryNotSupportedException($query),
    };

    $items = $this->pdo->findAll($sql->sql(), $sql->params());

    if (empty($items)) {
      throw new DataNotFoundException();
    }

    return $items;
  }

  /**
   * @param Query         $query
   * @param object[]|null $entity
   *
   * @return mixed[]
   * @throws QueryNotSupportedException|DataNotFoundException
   *
   * @todo           At present this method is not returning the inserted
   *                 or updated entities.
   */
  public function put(Query $query, mixed $entity = null): array {
    if (!is_array($entity)) {
      throw new InvalidArgumentException();
    }

    if (empty($entity)) {
      return [];
    }

    if ($query instanceof AllQuery) {
      $insertedEntities = [];

      foreach ($entity as $toInsert) {
        $insertedEntities[] = $this->rawSqlDataSource->put(
          new VoidQuery(),
          $toInsert,
        );
      }

      return $insertedEntities;
    }

    $sql = match (true) {
      $query instanceof VoidQuery => $this->sqlBuilder->multiInsert($entity),
      default => throw new QueryNotSupportedException($query),
    };

    $this->pdo->execute($sql->sql(), $sql->params());

    return $entity;
  }

  /**
   * @throws QueryNotSupportedException
   */
  public function delete(Query $query): void {
    $sql = match (true) {
      $query instanceof IdsQuery => $this->sqlBuilder->deleteByIds($query->ids),
      $query instanceof ComposedQuery => $this->sqlBuilder->deleteComposed(
        $query,
      ),
      default => throw new QueryNotSupportedException($query),
    };

    $this->pdo->execute($sql->sql(), $sql->params());
  }
}
