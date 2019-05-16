<?php

namespace harmony\data\repository;

use harmony\data\dataSource\query\Query;
use harmony\data\entity\BaseEntity;
use harmony\data\mapper\Mapper;
use harmony\data\repository\operation\Operation;
use harmony\domain\model\BaseModel;

/**
 * Class RepositoryMapper
 */
class RepositoryMapper implements
    GetRepository, PutRepository, DeleteRepository {

    /** @var GetRepository */
    private $getRepository;
    /** @var PutRepository */
    private $putRepository;
    /** @var DeleteRepository */
    private $deleteRepository;
    /** @var Mapper */
    private $toBaseEntityMapper;
    /** @var Mapper */
    private $toBaseModelMapper;

    /**
     * RepositoryMapper constructor.
     *
     * @param GetRepository    $getRepository      repository
     * @param PutRepository    $putRepository      repository
     * @param DeleteRepository $deleteRepository   repository
     * @param Mapper           $toBaseEntityMapper mapper
     * @param Mapper           $toBaseModelMapper  mapper
     */
    public function __construct(
        GetRepository $getRepository,
        PutRepository $putRepository,
        DeleteRepository $deleteRepository,
        Mapper $toBaseEntityMapper,
        Mapper $toBaseModelMapper
    ) {
        $this->getRepository = $getRepository;
        $this->putRepository = $putRepository;
        $this->deleteRepository = $deleteRepository;
        $this->toBaseEntityMapper = $toBaseEntityMapper;
        $this->toBaseModelMapper = $toBaseModelMapper;
    }

    /**
     * Delete
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return void
     */
    public function delete(Query $query, Operation $operation)
    {
        $this->deleteRepository->delete($query, $operation);
    }

    /**
     * Delete all
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return void
     */
    public function deleteAll(Query $query, Operation $operation)
    {
        $this->deleteRepository->deleteAll($query, $operation);
    }

    /**
     * Get
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return BaseModel
     */
    public function get(Query $query, Operation $operation): BaseModel
    {
        $entity = $this->getRepository->get($query, $operation);
        return $this->toBaseModelMapper->map($entity);
    }

    /**
     * Get all
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return BaseModel[]
     */
    public function getAll(Query $query, Operation $operation) : array
    {
        $response = $this->getRepository->getAll($query, $operation);
        $models = [];
        /** @var BaseEntity $entity */
        foreach ($response as $entity) {
            $models[] = $this->toBaseModelMapper->map($entity);
        }
        return $models;
    }

    /**
     * Put
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     * @param BaseModel $baseModel model
     *
     * @return BaseModel
     */
    public function put(
        Query $query, Operation $operation, BaseModel $baseModel
    ): BaseModel {
        $baseEntity = $this->toBaseEntityMapper->map($baseModel);
        $response = $this->putRepository->put($query, $operation, $baseEntity);
        return $this->toBaseModelMapper->map($response);
    }

    /**
     * Put all
     *
     * @param Query       $query      query
     * @param Operation   $operation  operation
     * @param BaseModel[] $baseModels models
     *
     * @return void
     */
    public function putAll(Query $query, Operation $operation, array $baseModels)
    {
        /** @var BaseModel $baseModel */
        foreach ($baseModels as $baseModel) {
            $this->put($query, $operation, $baseModel);
        }
    }
}