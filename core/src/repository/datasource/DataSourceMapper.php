<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\mapper\Mapper;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

class DataSourceMapper implements GetDataSource, PutDataSource, DeleteDataSource
{
    /** @var GetDataSource */
    private $getDataSource;
    /** @var PutDataSource */
    private $putDataSource;
    /** @var DeleteDataSource */
    private $deleteDataSource;
    /** @var Mapper */
    private $toBaseEntityMapper;
    /** @var Mapper */
    private $toBaseModelMapper;

    /**
     * @param GetDataSource    $getDataSource
     * @param PutDataSource    $putDataSource
     * @param DeleteDataSource $deleteDataSource
     * @param Mapper           $toBaseEntityMapper
     * @param Mapper           $toBaseModelMapper
     */
    public function __construct(
        GetDataSource $getDataSource,
        PutDataSource $putDataSource,
        DeleteDataSource $deleteDataSource,
        Mapper $toBaseEntityMapper,
        Mapper $toBaseModelMapper
    ) {
        $this->getDataSource = $getDataSource;
        $this->putDataSource = $putDataSource;
        $this->deleteDataSource = $deleteDataSource;
        $this->toBaseEntityMapper = $toBaseEntityMapper;
        $this->toBaseModelMapper = $toBaseModelMapper;
    }

    /**
     * @param Query $query query
     *
     * @return void
     */
    public function delete(Query $query)
    {
        $this->deleteDataSource->delete($query);
    }

    /**
     * Delete all
     *
     * @param Query $query query
     *
     * @return void
     */
    public function deleteAll(Query $query)
    {
        $this->deleteDataSource->deleteAll($query);
    }

    /**
     * Get
     *
     * @param Query $query query
     *
     * @return BaseEntity
     */
    public function get(Query $query): BaseEntity
    {
        return $this->getDataSource->get($query);
    }

    /**
     * @param Query $query
     *
     * @return GenericCollection
     */
    public function getAll(Query $query): GenericCollection
    {
        return $this->getDataSource->getAll($query);
    }

    /**
     * Put
     *
     * @param Query      $query      query
     * @param BaseEntity $baseEntity entity
     *
     * @return BaseEntity
     */
    public function put(Query $query, BaseEntity $baseEntity): BaseEntity
    {
        return $this->putDataSource->put($query, $baseEntity);
    }

    /**
     * @param Query             $query
     * @param GenericCollection $baseEntities
     *
     * @return mixed|void
     */
    public function putAll(Query $query, GenericCollection $baseEntities)
    {
        $this->putDataSource->putAll($query, $baseEntities);
    }
}
