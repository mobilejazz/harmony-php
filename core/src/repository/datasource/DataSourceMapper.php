<?php

namespace harmony\core\repository\datasource;

use harmony\core\repository\mapper\GenericMapper;
use harmony\core\repository\query\Query;

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
    public function getAll(Query $query): array
    {
        $datas = $this->getDataSource->getAll($query);
        $entities = [];

        foreach ($datas as $from) {
            $entities[] = $this->dataToEntityMapper->map($from);
        }

        return $entities;
    }

    /**
     * @param Query        $query
     * @param TEntity|null $entity
     *
     * @return TEntity|mixed
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
     * @param Query               $query
     * @param array<TEntity>|null $entities
     *
     * @return array<TEntity>
     */
    public function putAll(Query $query, array $entities = null): array
    {
        $datas = null;

        if ($entities !== null) {
            $datas = [];

            foreach ($entities as $entity) {
                $datas[] = $this->entityToDataMapper->map($entity);
            }
        }

        $datasPutted = $this->putDataSource->putAll($query, $datas);
        $entitiesPutted = [];

        foreach ($datasPutted as $dataPutted) {
            $entitiesPutted[] = $this->dataToEntityMapper->map($dataPutted);
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
