<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\mapper\GenericMapper;
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

    /** @var GenericMapper */
    protected $toInMapper;
    /** @var GenericMapper */
    protected $toOutMapper;

    /**
     * @param GetDataSource    $getDataSource
     * @param PutDataSource    $putDataSource
     * @param DeleteDataSource $deleteDataSource
     * @param GenericMapper    $toInMapper
     * @param GenericMapper    $toOutMapper
     */
    public function __construct(
        GetDataSource $getDataSource,
        PutDataSource $putDataSource,
        DeleteDataSource $deleteDataSource,
        GenericMapper $toInMapper,
        GenericMapper $toOutMapper
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
     * @return bool
     */
    public function delete(Query $query): bool
    {
        return $this->deleteDataSource->delete($query);
    }

    /**
     * @param Query $query
     *
     * @return bool
     */
    public function deleteAll(Query $query): bool
    {
        return $this->deleteDataSource->deleteAll($query);
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

        dd('after datasourcemapper');

        return new GenericCollection(
            $this->toOutMapper->getTypeTo(),
            $tos
        );
    }

    /**
     * @param Query      $query
     * @param BaseEntity $baseEntity
     *
     * @return BaseEntity
     */
    public function put(Query $query, BaseEntity $baseEntity): BaseEntity
    {
        $toPut = $this->toInMapper->map($baseEntity);
        $result = $this->putDataSource->put($query, $toPut);

        return $this->toOutMapper->map($result);
    }

    /**
     * @param Query             $query
     * @param GenericCollection $baseEntities
     *
     * @return GenericCollection
     */
    public function putAll(Query $query, GenericCollection $baseEntities): GenericCollection
    {
        return $this->putDataSource->putAll($query, $baseEntities);
    }
}
