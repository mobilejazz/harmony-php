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
use Harmony\Core\Module\Sql\Error\IdRequiredToUpdateSqlRowException;
use Harmony\Core\Module\Sql\Schema\SqlSchema;
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
    protected readonly SqlService $pdo,
    protected readonly SqlBuilder $sqlBuilder,
    protected readonly SqlSchema $schema,
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
   * @param Query|null   $query
   * @param mixed[]|null $entities
   *
   * @return mixed[]
   *
   * @throws QueryNotSupportedException
   * @throws DataNotFoundException
   * @throws IdRequiredToUpdateSqlRowException
   *
   * @todo           At present this method is inserting one by one each
   *                entity. But we can use `multiInsert` method to insert
   *                all entities at once.
   */
  public function put(Query $query = null, mixed $entities = null): array {
    if (
      $query instanceof AllQuery ||
      $query instanceof VoidQuery ||
      $query === null
    ) {
      if (!is_array($entities)) {
        throw new InvalidArgumentException(
          "For this type of Query is required and array of entities.",
        );
      }

      $insertedEntities = [];

      foreach ($entities as $toInsert) {
        $insertedEntities[] = $this->rawSqlDataSource->put(
          new VoidQuery(),
          $toInsert,
        );
      }

      return $insertedEntities;
    }

    throw new QueryNotSupportedException($query);
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
