<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\mapper\Mapper;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

class DataSourceMapper implements GetDataSource, PutDataSource, DeleteDataSource
{
    /** @var GetDataSource */
    protected $getDataSource;
    /** @var PutDataSource */
    protected $putDataSource;
    /** @var DeleteDataSource */
    protected $deleteDataSource;

    /** @var Mapper */
    protected $toInMapper;
    /** @var Mapper */
    protected $toOutMapper;

    /**
     * @param GetDataSource    $getDataSource
     * @param PutDataSource    $putDataSource
     * @param DeleteDataSource $deleteDataSource
     * @param Mapper           $toInMapper
     * @param Mapper           $toOutMapper
     */
    public function __construct(
        GetDataSource $getDataSource,
        PutDataSource $putDataSource,
        DeleteDataSource $deleteDataSource,
        Mapper $toInMapper,
        Mapper $toOutMapper
    ) {
        $this->getDataSource = $getDataSource;
        $this->putDataSource = $putDataSource;
        $this->deleteDataSource = $deleteDataSource;
        $this->toInMapper = $toInMapper;
        $this->toOutMapper = $toOutMapper;
    }

    /**
     * @param Query $query
     *
     * @return BaseEntity
     */
    public function get(Query $query): BaseEntity
    {
        $from = $this->getDataSource->get($query);
        $to = $this->toOutMapper->map($from);

        return $to;
    }

    /**
     * @param Query $query
     *
     * @return GenericCollection
     */
    public function getAll(Query $query): GenericCollection
    {
        $froms = $this->getDataSource->getAll($query);
        $tos = [];

        foreach ($froms AS $from) {
            $tos[] = $this->toOutMapper->map($from);
        }

        $result = new GenericCollection(
            $this->toOutMapper->getTypeTo(),
            $tos
        );

        return $result;
    }

    /**
     * @param Query           $query
     * @param BaseEntity|null $baseEntity
     *
     * @return BaseEntity
     */
    public function put(Query $query, BaseEntity $baseEntity = null): BaseEntity
    {
        $toPut = null;

        if ($baseEntity !== null) {
            $toPut = $this->toInMapper->map($baseEntity);
        }

        $result = $this->putDataSource->put($query, $toPut);

        return $this->toOutMapper->map($result);
    }

    /**
     * @param Query                  $query
     * @param GenericCollection|null $baseEntities
     *
     * @return GenericCollection
     */
    public function putAll(
        Query $query,
        GenericCollection $baseEntities = null
    ): GenericCollection {
        $toPuts = null;

        if ($baseEntities !== null) {
            $toPuts = new GenericCollection($this->toInMapper->getTypeTo());

            foreach ($baseEntities AS $from) {
                $toPuts->add($this->toInMapper->map($from));
            }
        }

        $result = $this->putDataSource->putAll($query, $toPuts);

        return $result;
    }

    /**
     * @param Query $query
     *
     * @return void
     */
    public function delete(Query $query): void
    {
        $this->deleteDataSource->delete($query);
    }
}
