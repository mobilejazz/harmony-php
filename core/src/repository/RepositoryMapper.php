<?php

namespace harmony\core\repository;

use harmony\core\repository\mapper\GenericMapper;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

/**
 * @template   TModel
 * @template   TEntity
 * @implements GetRepository<TModel>
 * @implements PutRepository<TModel>
 */
class RepositoryMapper implements GetRepository, PutRepository, DeleteRepository
{
    /** @var GetRepository<TEntity> */
    private $getRepository;
    /** @var PutRepository<TEntity> */
    private $putRepository;
    /** @var DeleteRepository */
    private $deleteRepository;

    /** @var GenericMapper<TModel, TEntity> */
    protected $toInMapper;
    /** @var GenericMapper<TEntity, TModel> */
    protected $toOutMapper;

    /**
     * RepositoryMapper constructor.
     *
     * @param GetRepository<TEntity>         $getRepository
     * @param PutRepository<TEntity>         $putRepository
     * @param DeleteRepository               $deleteRepository
     * @param GenericMapper<TModel, TEntity> $toInMapper
     * @param GenericMapper<TEntity, TModel> $toOutMapper
     */
    public function __construct(
        GetRepository $getRepository,
        PutRepository $putRepository,
        DeleteRepository $deleteRepository,
        GenericMapper $toInMapper,
        GenericMapper $toOutMapper
    ) {
        $this->getRepository = $getRepository;
        $this->putRepository = $putRepository;
        $this->deleteRepository = $deleteRepository;
        $this->toInMapper = $toInMapper;
        $this->toOutMapper = $toOutMapper;
    }

    /**
     * @inheritdoc
     */
    public function get(Query $query, Operation $operation)
    {
        $entity = $this->getRepository->get($query, $operation);
        $model = $this->toOutMapper->map($entity);

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function getAll(Query $query, Operation $operation): array
    {
        $entities = $this->getRepository->getAll($query, $operation);
        $models = [];

        foreach ($entities as $entity) {
            $models[] = $this->toOutMapper->map($entity);
        }

        return $models;
    }

    /**
     * @inheritdoc
     */
    public function put(Query $query, Operation $operation, $model = null)
    {
        $entity = null;

        if ($model !== null) {
            $entity = $this->toInMapper->map($model);
        }

        $entityPutted = $this->putRepository->put($query, $operation, $entity);
        $modelPutted = $this->toOutMapper->map($entityPutted);

        return $modelPutted;
    }

    /**
     * @inheritdoc
     */
    public function putAll(Query $query, Operation $operation, array $models = null): array
    {
        $entities = null;

        if ($models !== null) {
            $entities = [];

            foreach ($models as $model) {
                $entities[] = $this->toInMapper->map($model);
            }
        }

        $entitiesPutted = $this->putRepository->putAll($query, $operation, $entities);
        $modelsPutted = [];

        foreach ($entitiesPutted as $entityPutted) {
            $modelsPutted[] = $this->toOutMapper->map($entityPutted);
        }

        return $modelsPutted;
    }

    /**
     * @inheritdoc
     */
    public function delete(Query $query, Operation $operation): void
    {
        $this->deleteRepository->delete($query, $operation);
    }
}
