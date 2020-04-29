<?php

namespace harmony\core\repository;

use harmony\core\repository\mapper\GenericMapper;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

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
    public function get(
        Query $query,
        Operation $operation
    ) {
        $from = $this->getRepository->get($query, $operation);
        $to = $this->toOutMapper->map($from);

        return $to;
    }

    /**
     * @inheritdoc
     */
    public function getAll(
        Query $query,
        Operation $operation
    ): GenericCollection {
        $froms = $this->getRepository->getAll($query, $operation);
        $tos = [];

        foreach ($froms as $from) {
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
    public function put(
        Query $query,
        Operation $operation,
        $entity = null
    ) {
        $toPut = null;

        if ($entity !== null) {
            $toPut = $this->toInMapper->map($entity);
        }

        $result = $this->putRepository->put($query, $operation, $toPut);

        return $this->toOutMapper->map($result);
    }

    /**
     * @inheritdoc
     */
    public function putAll(
        Query $query,
        Operation $operation,
        GenericCollection $collection = null
    ): GenericCollection {
        $toPuts = null;

        if ($collection !== null) {
            $toPuts = new GenericCollection($this->toInMapper->getTypeTo());

            foreach ($collection as $from) {
                $toPuts->add($this->toInMapper->map($from));
            }
        }

        $datas = $this->putRepository->putAll($query, $operation, $toPuts);
        $toOuts = new GenericCollection($this->toOutMapper->getTypeTo());

        foreach ($datas as $data) {
            $toOuts->add($this->toOutMapper->map($data));
        }

        return $toOuts;
    }

    /**
     * @inheritdoc
     */
    public function delete(
        Query $query,
        Operation $operation
    ): void {
        $this->deleteRepository->delete($query, $operation);
    }
}
