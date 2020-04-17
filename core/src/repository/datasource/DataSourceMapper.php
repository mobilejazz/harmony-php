<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\mapper\GenericMapper;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * @template   Tentity
 * @template   Tdata
 * @implements GetDataSource<Tentity>
 * @implements PutDataSource<Tentity>
 */
class DataSourceMapper implements GetDataSource, PutDataSource, DeleteDataSource
{
    /** @var GetDataSource<Tdata> */
    protected $getDataSource;
    /** @var PutDataSource<Tdata> */
    protected $putDataSource;
    /** @var DeleteDataSource */
    protected $deleteDataSource;

    /** @var GenericMapper<Tentity, Tdata> */
    protected $entityToDataMapper;
    /** @var GenericMapper<Tdata, Tentity> */
    protected $dataToEntityMapper;

    /**
     * @param GetDataSource<Tdata>          $getDataSource
     * @param PutDataSource<Tdata>          $putDataSource
     * @param DeleteDataSource              $deleteDataSource
     * @param GenericMapper<Tentity, Tdata> $entityToDataMapper
     * @param GenericMapper<Tdata, Tentity> $dataToEntityMapper
     */
    public function __construct(
        GetDataSource $getDataSource,
        PutDataSource $putDataSource,
        DeleteDataSource $deleteDataSource,
        GenericMapper $entityToDataMapper,
        GenericMapper $dataToEntityMapper
    ) {
        $this->getDataSource = $getDataSource;
        $this->putDataSource = $putDataSource;
        $this->deleteDataSource = $deleteDataSource;
        $this->entityToDataMapper = $entityToDataMapper;
        $this->dataToEntityMapper = $dataToEntityMapper;
    }

    /**
     * @inheritdoc
     */
    public function get(Query $query)
    {
        $data = $this->getDataSource->get($query);
        $entity = $this->dataToEntityMapper->map($data);

        return $entity;
    }

    /**
     * @inheritdoc
     */
    public function getAll(Query $query): GenericCollection
    {
        $datas = $this->getDataSource->getAll($query);
        $entities = new GenericCollection($this->dataToEntityMapper->getTypeTo());

        foreach ($datas as $from) {
            $entities->add($this->dataToEntityMapper->map($from));
        }

        return $entities;
    }

    /**
     * @inheritdoc
     */
    public function put(Query $query, $entity = null)
    {
        $data = null;

        if ($entity !== null) {
            $data = $this->entityToDataMapper->map($entity);
        }

        $dataPutted = $this->putDataSource->put($query, $data);
        $entityPutted = $this->dataToEntityMapper->map($dataPutted);

        return $entityPutted;
    }

    /**
     * @inheritdoc
     */
    public function putAll(
        Query $query,
        GenericCollection $entities = null
    ): GenericCollection {
        $datas = null;

        if ($entities !== null) {
            $datas = new GenericCollection($this->entityToDataMapper->getTypeTo());

            foreach ($entities as $from) {
                $datas->add($this->entityToDataMapper->map($from));
            }
        }

        $datasPutted = $this->putDataSource->putAll($query, $datas);
        $entitiesPutted = new GenericCollection($this->dataToEntityMapper->getTypeTo());

        foreach ($datasPutted as $dataPutted) {
            $entitiesPutted->add($this->dataToEntityMapper->map($dataPutted));
        }

        return $entitiesPutted;
    }

    /**
     * @inheritdoc
     */
    public function delete(Query $query): void
    {
        $this->deleteDataSource->delete($query);
    }
}
