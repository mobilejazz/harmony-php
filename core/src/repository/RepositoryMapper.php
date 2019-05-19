<?php

namespace harmony\core\repository;

use harmony\core\repository\mapper\Mapper;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * Class RepositoryMapper
 */
class RepositoryMapper implements
    GetRepository, PutRepository, DeleteRepository
{
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
     * @param GetRepository    $getRepository       repository
     * @param PutRepository    $putRepository       repository
     * @param DeleteRepository $deleteRepository    repository
     * @param Mapper           $toBaseEntityMapper  mapper
     * @param Mapper           $toBaseHarmonyMapper mapper
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
     * @param Query     $query
     * @param Operation $operation
     *
     * @return GenericCollection
     */
    public function getAll(Query $query, Operation $operation): GenericCollection
    {
        $response = $this->getRepository->getAll($query, $operation);
        $models = [];

        /** @var BaseHarmony $entity */
        foreach ($response as $entity) {
            $models[] = $this->toBaseHarmonyMapper->map($entity);
        }

        return new GenericCollection($models);
    }

    /**
     * @param Query             $query
     * @param Operation         $operation
     * @param GenericCollection $baseModels
     *
     * @return mixed|void
     */
    public function putAll(Query $query, Operation $operation, GenericCollection $baseModels)
    {
        /** @var BaseHarmony $baseModel */
        foreach ($baseModels as $baseModel) {
            $this->put($query, $operation, $baseModel);
        }
    }

    /**
     * Put
     *
     * @param Query       $query     query
     * @param Operation   $operation operation
     * @param BaseHarmony $baseModel model
     *
     * @return BaseHarmony
     */
    public function put(
        Query $query,
        Operation $operation,
        BaseHarmony $baseModel
    ): BaseHarmony {
        $baseEntity = $this->toBaseEntityMapper->map($baseModel);
        $response = $this->putRepository->put($query, $operation, $baseEntity);
        return $this->toBaseHarmonyMapper->map($response);
    }
}
