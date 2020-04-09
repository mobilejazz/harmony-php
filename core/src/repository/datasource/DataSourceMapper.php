<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\mapper\GenericMapper;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * @template T2
 * @implements GetDataSource<T2>
 * @implements PutDataSource<T2>
 */
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
     * @inheritdoc
     */
    public function get(Query $query): BaseEntity
    {
        $from = $this->getDataSource->get($query);
        $to = $this->toOutMapper->map($from);

        return $to;
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
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
     * @inheritdoc
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
     * @inheritdoc
     */
    public function delete(Query $query): void
    {
        $this->deleteDataSource->delete($query);
    }
}
