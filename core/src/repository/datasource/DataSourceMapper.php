<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\mapper\GenericMapper;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * @template   TEntity
 * @template   TData
 * @implements GetDataSource<TEntity>
 * @implements PutDataSource<TEntity>
 */
class DataSourceMapper implements GetDataSource, PutDataSource, DeleteDataSource
{
    /** @var GetDataSource<TData> */
    protected $getDataSource;
    /** @var PutDataSource<TData> */
    protected $putDataSource;
    /** @var DeleteDataSource */
    protected $deleteDataSource;

    /** @var GenericMapper<TEntity, TData> */
    protected $entityToDataMapper;
    /** @var GenericMapper<TData, TEntity> */
    protected $dataToEntityMapper;

    /**
     * @param GetDataSource<TData>          $getDataSource
     * @param PutDataSource<TData>          $putDataSource
     * @param DeleteDataSource              $deleteDataSource
     * @param GenericMapper<TEntity, TData> $entityToDataMapper
     * @param GenericMapper<TData, TEntity> $dataToEntityMapper
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
     * @param Query $query
     *
     * @psalm-param  TEntity $entity
     *
     * @param null  $entity
     *
     * @psalm-return TEntity
     * @return T|mixed
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
     * @param Query                  $query
     *
     * @psalm-param  GenericCollection<TEntity> $entities
     *
     * @param GenericCollection|null $entities
     *
     * @psalm-return GenericCollection<TEntity>
     * @return GenericCollection
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
