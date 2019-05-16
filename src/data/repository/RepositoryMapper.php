<?php

namespace harmony\data\repository;

use harmony\data\dataSource\query\Query;
use harmony\data\mapper\Mapper;
use harmony\data\repository\operation\Operation;
use harmony\domain\model\BaseCollection;
use harmony\domain\model\BaseHarmony;

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
    private $toBaseHarmonyMapper;

    /**
     * RepositoryMapper constructor.
     *
     * @param GetRepository    $getRepository      repository
     * @param PutRepository    $putRepository      repository
     * @param DeleteRepository $deleteRepository   repository
     * @param Mapper           $toBaseEntityMapper mapper
     * @param Mapper           $toBaseHarmonyMapper  mapper
     */
    public function __construct(
        GetRepository $getRepository,
        PutRepository $putRepository,
        DeleteRepository $deleteRepository,
        Mapper $toBaseEntityMapper,
        Mapper $toBaseHarmonyMapper
    ) {
        $this->getRepository = $getRepository;
        $this->putRepository = $putRepository;
        $this->deleteRepository = $deleteRepository;
        $this->toBaseEntityMapper = $toBaseEntityMapper;
        $this->toBaseHarmonyMapper = $toBaseHarmonyMapper;
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
     * @return BaseHarmony
     */
    public function get(Query $query, Operation $operation): BaseHarmony
    {
        $entity = $this->getRepository->get($query, $operation);
        return $this->toBaseHarmonyMapper->map($entity);
    }

    /**
     * Get all
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return BaseCollection
     */
    public function getAll(Query $query, Operation $operation) : BaseCollection
    {
        $response = $this->getRepository->getAll($query, $operation);
        $models = [];
        /** @var BaseHarmony $entity */
        foreach ($response as $entity) {
            $models[] = $this->toBaseHarmonyMapper->map($entity);
        }
        return new BaseCollection($models);
    }

    /**
     * Put
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     * @param BaseHarmony $baseModel model
     *
     * @return BaseHarmony
     */
    public function put(
        Query $query, Operation $operation, BaseHarmony $baseModel
    ): BaseHarmony {
        $baseEntity = $this->toBaseEntityMapper->map($baseModel);
        $response = $this->putRepository->put($query, $operation, $baseEntity);
        return $this->toBaseHarmonyMapper->map($response);
    }

    /**
     * Put all
     *
     * @param Query          $query      query
     * @param Operation      $operation  operation
     * @param BaseCollection $baseModels models
     *
     * @return void
     */
    public function putAll(Query $query, Operation $operation, BaseCollection $baseModels)
    {
        /** @var BaseHarmony $baseModel */
        foreach ($baseModels as $baseModel) {
            $this->put($query, $operation, $baseModel);
        }
    }
}