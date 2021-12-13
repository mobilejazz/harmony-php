<?php

namespace Harmony\Core\Module\Sql\DataSource;

use Harmony\Core\Module\Pdo\Error\PdoConnectionNotReadyException;
use Harmony\Core\Module\Sql\Helper\SqlBuilder;
use Harmony\Core\Repository\DataSource\DeleteDataSource;
use Harmony\Core\Repository\DataSource\GetDataSource;
use Harmony\Core\Repository\DataSource\PutDataSource;
use Harmony\Core\Repository\Error\DataNotFoundException;
use Harmony\Core\Repository\Error\QueryNotSupportedException;
use Harmony\Core\Repository\Query\AllQuery;
use Harmony\Core\Repository\Query\Composed\ComposedQuery;
use Harmony\Core\Repository\Query\IdQuery;
use Harmony\Core\Repository\Query\KeyQuery;
use Harmony\Core\Repository\Query\Query;
use Harmony\Core\Repository\Query\VoidQuery;
use InvalidArgumentException;
use socialPALS\System\Data\DataSource\SocialPalsSqlSchema;

/**
 * @implements GetDataSource<object>
 * @implements PutDataSource<object>
 */
class RawSqlDataSource implements
  GetDataSource,
  PutDataSource,
  DeleteDataSource {
  /**
   * @param SqlInterface $pdo
   * @param SqlBuilder   $sqlBuilder
   */
  public function __construct(
    protected SqlInterface $pdo,
    protected SqlBuilder $sqlBuilder
  ) {
  }

  /**
   * @psalm-suppress ImplementedReturnTypeMismatch
   *
   * @param Query $query
   *
   * @return object
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function get(Query $query): object {
    $sql = match (true) {
      $query instanceof IdQuery => $this->sqlBuilder->selectById(
        $query->getId(),
      ),
      $query instanceof KeyQuery => $this->sqlBuilder->selectByKey(
        $query->geKey(),
      ),
      $query instanceof ComposedQuery => $this->sqlBuilder->selectComposed(
        $query,
      ),
      default => throw new QueryNotSupportedException()
    };

    $item = $this->pdo->findOne($sql->sql(), $sql->params());

    if ($item === null) {
      throw new DataNotFoundException();
    }

    return $item;
  }

  /**
   * @psalm-suppress ImplementedReturnTypeMismatch
   *
   * @param Query $query
   *
   * @return object[]
   * @throws DataNotFoundException
   * @throws QueryNotSupportedException
   */
  public function getAll(Query $query): array {
    $sql = match (true) {
      $query instanceof AllQuery => $this->sqlBuilder->selectAll(),
      $query instanceof ComposedQuery => $this->sqlBuilder->selectAllComposed(
        $query,
      ),
      default => throw new QueryNotSupportedException()
    };

    $items = $this->pdo->findAll($sql->sql(), $sql->params());

    if (empty($items)) {
      throw new DataNotFoundException();
    }

    return $items;
  }

  /**
   * @psalm-suppress LessSpecificImplementedReturnType
   *
   * @param Query      $query
   * @param mixed|null $entity
   *
   * @return mixed
   */
  public function put(Query $query, mixed $entity = null): mixed {
    $id = $this->getId($query, $entity);
    return $this->pdo->transaction([$this, "executePutQuery"], [$entity, $id]);
  }

  /**
   * Method used as a callback
   * $params = { entity, id }
   *
   * @param mixed $params
   *
   * @return object
   * @throws DataNotFoundException
   * @throws PdoConnectionNotReadyException
   * @throws QueryNotSupportedException
   */
  public function executePutQuery(mixed $params): object {
    $entity = $params[0];
    $id = $params[1];

    $isInsertion = empty($id);

    if ($isInsertion) {
      $sql = $this->sqlBuilder->insert($entity);
      $id = $this->pdo->insert($sql->sql(), $sql->params());
    } else {
      $sql = $this->sqlBuilder->updateById($id, $entity);
      $this->pdo->execute($sql->sql(), $sql->params());
    }

    return $this->get(new IdQuery($id));
  }

  /**
   * @param Query      $query
   * @param mixed|null $entity
   *
   * @return mixed
   */
  public function getId(Query $query, mixed $entity = null): mixed {
    $id = null;
    if ($query instanceof IdQuery) {
      $id = $query->getId();
    } elseif ($query instanceof KeyQuery) {
      $id = $entity->getKey();
    }
    return $id;
  }

  /**
   * @psalm-suppress MoreSpecificImplementedParamType
   *
   * @param Query         $query
   * @param object[]|null $entities
   *
   * @return object[]
   * @throws QueryNotSupportedException
   */
  public function putAll(Query $query, array $entities = null): array {
    if ($entities === null) {
      throw new InvalidArgumentException();
    }

    $sql = match (true) {
      $query instanceof VoidQuery => $this->sqlBuilder->multiInsert($entities),
      default => throw new QueryNotSupportedException()
    };

    $this->pdo->execute($sql->sql(), $sql->params());

    return $entities;
  }

  /**
   * @param Query $query
   *
   * @throws QueryNotSupportedException
   */
  public function delete(Query $query): void {
    $sql = match (true) {
      $query instanceof IdQuery => $this->sqlBuilder->deleteById(
        $query->getId(),
      ),
      default => throw new QueryNotSupportedException()
    };

    $this->pdo->execute($sql->sql(), $sql->params());
  }
}
