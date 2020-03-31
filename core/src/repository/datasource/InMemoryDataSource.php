<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\error\DataNotFoundException;
use harmony\core\repository\error\QueryNotSupportedException;
use harmony\core\repository\query\AllQuery;
use harmony\core\repository\query\KeyQuery;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use InvalidArgumentException;

class InMemoryDataSource implements GetDataSource, PutDataSource, DeleteDataSource
{
    /** @var string */
    protected $genericClass;

    /** @var array */
    protected $objects = [];

    public function __construct(string $genericClass)
    {
        $this->genericClass = $genericClass;
    }

    /**
     * @param Query $query
     *
     * @return BaseEntity
     * @throws DataNotFoundException
     * @throws QueryNotSupportedException
     */
    public function get(Query $query): BaseEntity
    {
        if ($query instanceof KeyQuery) {
            if (!isset($this->objects[$query->geKey()])) {
                throw new DataNotFoundException();
            }

            return $this->objects[$query->geKey()];
        }

        throw new QueryNotSupportedException();
    }

    /**
     * @param Query $query
     *
     * @return GenericCollection
     * @throws DataNotFoundException
     * @throws QueryNotSupportedException
     */
    public function getAll(Query $query): GenericCollection
    {
        if ($query instanceof AllQuery) {
            if (empty($this->objects)) {
                throw new DataNotFoundException();
            }

            return new GenericCollection(
                $this->genericClass,
                $this->objects
            );
        }

        throw new QueryNotSupportedException();
    }

    /**
     * @param Query           $query
     * @param BaseEntity|null $baseModel
     *
     * @return BaseEntity
     * @throws QueryNotSupportedException
     */
    public function put(Query $query, BaseEntity $baseModel = null): BaseEntity
    {
        if ($baseModel === null) {
            throw new InvalidArgumentException();
        }

        if ($query instanceof KeyQuery) {
            $this->objects[$query->geKey()] = $baseModel;

            return $baseModel;
        }

        throw new QueryNotSupportedException();
    }

    /**
     * @param Query                  $query
     * @param GenericCollection|null $baseModels
     *
     * @return GenericCollection
     * @throws QueryNotSupportedException
     */
    public function putAll(
        Query $query,
        GenericCollection $baseModels = null
    ): GenericCollection {
        if ($baseModels === null) {
            throw new InvalidArgumentException();
        }

        if ($query instanceof AllQuery) {
            foreach ($baseModels AS $baseModel) {
                $this->objects[] = $baseModel;
            }

            return $baseModels;
        }

        throw new QueryNotSupportedException();
    }

    /**
     * @param Query $query
     *
     * @throws DataNotFoundException
     * @throws QueryNotSupportedException
     */
    public function delete(Query $query): void
    {
        if ($query instanceof KeyQuery) {
            if (!isset($this->objects[$query->geKey()])) {
                throw new DataNotFoundException();
            }

            unset($this->objects[$query->geKey()]);
            return;
        }

        throw new QueryNotSupportedException();
    }
}
