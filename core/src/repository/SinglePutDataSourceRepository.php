<?php

namespace harmony\core\repository;

use harmony\core\repository\datasource\PutDataSource;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * @template T
 * @implements PutRepository<T>
 */
class SinglePutDataSourceRepository implements PutRepository
{
    /**
     * @var PutDataSource<T>
     */
    protected $putDataSource;

    /**
     * @param PutDataSource<T> $putDataSource
     */
    public function __construct(
        PutDataSource $putDataSource
    ) {
        $this->putDataSource = $putDataSource;
    }

    /**
     * @inheritdoc
     */
    public function put(
        Query $query,
        Operation $operation,
        $entity = null
    ) {
        return $this->putDataSource->put(
            $query,
            $entity
        );
    }

    /**
     * @inheritdoc
     */
    public function putAll(
        Query $query,
        Operation $operation,
        GenericCollection $collection = null
    ): GenericCollection {
        return $this->putDataSource->putAll($query, $collection);
    }
}
