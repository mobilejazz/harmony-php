<?php

namespace harmony\data\dataSource;

use harmony\data\dataSource\query\Query;
use harmony\data\mapper\Mapper;
use harmony\domain\model\BaseCollection;
use harmony\domain\model\BaseHarmony;

/**
 * Class DataSourceMapper
 */
class DataSourceMapper implements GetDataSource, PutDataSource, DeleteDataSource {

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
     * DataSourceMapper constructor.
     *
     * @param GetDataSource    $getDataSource      DataSource
     * @param PutDataSource    $putDataSource      DataSource
     * @param DeleteDataSource $deleteDataSource   DataSource
     * @param Mapper           $toBaseEntityMapper mapper
     * @param Mapper           $toBaseModelMapper  mapper
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
     * Delete
     *
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
     * @return BaseHarmony
     */
    public function get(Query $query): BaseHarmony
    {
        return $this->getDataSource->get($query);
    }

    /**
     * Get all
     *
     * @param Query $query query
     *
     * @return BaseCollection
     */
    public function getAll(Query $query): BaseCollection
    {
        return $this->getDataSource->getAll($query);
    }

    /**
     * Put
     *
     * @param Query       $query      query
     * @param BaseHarmony $baseEntity entity
     *
     * @return BaseHarmony
     */
    public function put(Query $query, BaseHarmony $baseEntity): BaseHarmony
    {
        return $this->putDataSource->put($query, $baseEntity);
    }

    /**
     * Put all
     *
     * @param Query         $query        query
     * @param BaseCollection $baseEntities entities
     *
     * @return void
     */
    public function putAll(Query $query, BaseCollection $baseEntities)
    {
        $this->putDataSource->putAll($query, $baseEntities);
    }
}