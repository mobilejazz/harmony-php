<?php

namespace harmony\core\repository;

use harmony\core\repository\mapper\GenericMapper;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

class RepositoryMapper implements GetRepository, PutRepository, DeleteRepository
{
    /** @var GetRepository */
    private $getRepository;
    /** @var PutRepository */
    private $putRepository;
    /** @var DeleteRepository */
    private $deleteRepository;

    /** @var GenericMapper */
    protected $toInMapper;
    /** @var GenericMapper */
    protected $toOutMapper;

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
     * @param Query     $query
     * @param Operation $operation
     *
     * @return BaseEntity
     */
    public function get(
        Query $query,
        Operation $operation
    ): BaseEntity {
        $from = $this->getRepository->get($query, $operation);
        $to = $this->toOutMapper->map($from);

        return $to;
    }

    /**
     * @param Query     $query
     * @param Operation $operation
     *
     * @return GenericCollection
     */
    public function getAll(
        Query $query,
        Operation $operation
    ): GenericCollection {
        $froms = $this->getRepository->getAll($query, $operation);
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
     * @param Query      $query
     * @param Operation  $operation
     * @param BaseEntity $baseEntity
     *
     * @return BaseEntity
     */
    public function put(
        Query $query,
        Operation $operation,
        BaseEntity $baseEntity
    ): BaseEntity {
        $toPut = $this->toInMapper->map($baseEntity);
        $result = $this->putRepository->put($query, $operation, $toPut);

        return $this->toOutMapper->map($result);
    }

    /**
     * @param Query             $query
     * @param Operation         $operation
     * @param GenericCollection $baseEntities
     *
     * @return GenericCollection
     */
    public function putAll(
        Query $query,
        Operation $operation,
        GenericCollection $baseEntities
    ): GenericCollection {
        $toPuts = new GenericCollection($this->toInMapper->getTypeTo());

        foreach ($baseEntities AS $from) {
            $toPuts->add($this->toInMapper->map($from));
        }

        $result = $this->putRepository->putAll($query, $operation, $toPuts);
        return $result;
    }

    /**
     * @param Query     $query
     * @param Operation $operation
     */
    public function delete(
        Query $query,
        Operation $operation
    ): void {
        $this->deleteRepository->delete($query, $operation);
    }
}
