<?php

namespace harmony\core\repository;

use harmony\core\repository\mapper\Mapper;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

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
    /**  @var Mapper */
    private $toEntityBaseMapper;

    public function __construct(
        GetRepository $getRepository,
        PutRepository $putRepository,
        DeleteRepository $deleteRepository,
        Mapper $toBaseEntityMapper,
        Mapper $toEntityBaseMapper
    ) {
        $this->getRepository = $getRepository;
        $this->putRepository = $putRepository;
        $this->deleteRepository = $deleteRepository;
        $this->toBaseEntityMapper = $toBaseEntityMapper;
        $this->toEntityBaseMapper = $toEntityBaseMapper;
    }

    /**
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
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return BaseEntity
     */
    public function get(Query $query, Operation $operation): BaseEntity
    {
        $entity = $this->getRepository->get($query, $operation);
        return $this->toBaseEntityMapper->map($entity);
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

        /** @var BaseEntity $entity */
        foreach ($response as $entity) {
            $models[] = $this->toBaseEntityMapper->map($entity);
        }

        return new GenericCollection(User::class, $models);
    }

    /**
     * @param Query             $query
     * @param Operation         $operation
     * @param GenericCollection $baseModels
     *
     * @return GenericCollection
     */
    public function putAll(Query $query, Operation $operation, GenericCollection $baseModels): GenericCollection
    {
        /** @var BaseEntity $baseModel */
        foreach ($baseModels as $baseModel) {
            $this->put($query, $operation, $baseModel);
        }
    }

    /**
     * @param Query      $query     query
     * @param Operation  $operation operation
     * @param BaseEntity $entity    model
     *
     * @return BaseEntity
     */
    public function put(
        Query $query,
        Operation $operation,
        BaseEntity $entity
    ): BaseEntity {
        $baseEntity = $this->toBaseEntityMapper->map($entity);
        $response = $this->putRepository->put($query, $operation, $baseEntity);
        return $this->toBaseEntityMapper->map($response);
    }
}
