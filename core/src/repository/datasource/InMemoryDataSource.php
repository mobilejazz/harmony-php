<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\error\DataNotFoundException;
use harmony\core\repository\error\QueryNotSupportedException;
use harmony\core\repository\query\AllQuery;
use harmony\core\repository\query\KeyQuery;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;
use InvalidArgumentException;

/**
 * @template   T
 * @implements GetDataSource<T>
 * @implements PutDataSource<T>
 */
class InMemoryDataSource implements GetDataSource, PutDataSource, DeleteDataSource
{
    /**
     * @var class-string<T>
     */
    protected $genericClass;

    /** @var array<mixed, T> */
    protected $objects = [];

    /**
     * @psalm-param class-string<T> $genericClass
     *
     * @param string $genericClass
     */
    public function __construct(string $genericClass)
    {
        $this->genericClass = $genericClass;
    }

    /**
     * @inheritdoc
     */
    public function get(Query $query)
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
     * @inheritdoc
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
     * @inheritdoc
     */
    public function put(Query $query, $baseModel = null)
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
     * @inheritdoc
     */
    public function putAll(
        Query $query,
        GenericCollection $baseModels = null
    ): GenericCollection {
        if ($baseModels === null) {
            throw new InvalidArgumentException();
        }

        if ($query instanceof AllQuery) {
            foreach ($baseModels as $baseModel) {
                $this->objects[] = $baseModel;
            }

            return $baseModels;
        }

        throw new QueryNotSupportedException();
    }

    /**
     * @inheritdoc
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
