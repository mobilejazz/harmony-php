<?php

namespace Harmony\Core\Module\Sql\DataSource;

use Harmony\Core\Module\Sql\Schema\SqlSchemaInterface;
use Harmony\Core\Module\Sql\SqlBuilder;
use Harmony\Core\Data\DataSource\DeleteDataSource;
use Harmony\Core\Data\DataSource\GetDataSource;
use Harmony\Core\Data\DataSource\PutDataSource;
use Harmony\Core\Data\Error\DataNotFoundException;
use Harmony\Core\Data\Error\QueryNotSupportedException;
use Harmony\Core\Data\Query\Composed\ComposedQuery;
use Harmony\Core\Data\Query\CountQuery;
use Harmony\Core\Data\Query\IdQuery;
use Harmony\Core\Data\Query\Query;

/**
 * @see RawSqlProductInteractorsTest
 *
 * @implements GetDataSource<mixed>
 * @implements PutDataSource<mixed>
 */
class RawSqlDataSource implements
  GetDataSource,
  PutDataSource,
  DeleteDataSource {
  public function __construct(
    protected readonly SqlServiceInterface $pdo,
    protected readonly SqlBuilder $sqlBuilder,
    protected readonly SqlSchemaInterface $schema,
  ) {
    $this->sqlBuilder->setSchema($schema);
  }

  /**
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function get(Query $query): mixed {
    $sql = match (true) {
      $query instanceof IdQuery => $this->sqlBuilder->selectById($query->id),
      $query instanceof ComposedQuery => $this->sqlBuilder->selectComposed(
        $query,
      ),
      default => throw new QueryNotSupportedException($query),
    };

    $item = $this->pdo->findOne($sql->sql(), $sql->params());

    if ($item === null) {
      throw new DataNotFoundException();
    }

    if ($query instanceof CountQuery) {
      // @phpstan-ignore-next-line
      $item = $item->count;
    }

    return $item;
  }

  /**
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function put(Query $query, mixed $entity = null): mixed {
    $id = $this->getId($query, $entity);

    try {
      if (!empty($id)) {
        $currentData = $this->get(new IdQuery($id));
      }
    } catch (DataNotFoundException) {
      $currentData = null;
    }

    $isInsertion = empty($id) || empty($currentData);

    if ($isInsertion) {
      $sql = $this->sqlBuilder->insert($entity);
      $id = $this->pdo->insert($sql->sql(), $sql->params());
    } else {
      $sql = $this->sqlBuilder->updateById($id, $entity);
      $this->pdo->execute($sql->sql(), $sql->params());
    }

    return $this->get(new IdQuery($id));
  }

  public function getId(Query $query, mixed $entity = null): string|int {
    $id = null;
    $idColumnName = $this->sqlBuilder->getSchema()->getIdColumn();

    if ($query instanceof IdQuery) {
      $id = $query->id;
    } elseif (!empty($entity?->$idColumnName)) {
      $id = $entity->$idColumnName;
    }

    return $id;
  }

  /**
   * @throws QueryNotSupportedException
   */
  public function delete(Query $query): void {
    $sql = match (true) {
      $query instanceof IdQuery => $this->sqlBuilder->deleteById($query->id),
      $query instanceof ComposedQuery => $this->sqlBuilder->deleteComposed(
        $query,
      ),
      default => throw new QueryNotSupportedException($query),
    };

    $this->pdo->execute($sql->sql(), $sql->params());
  }
}
