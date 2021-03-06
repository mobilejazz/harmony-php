<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\GetRepository;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

/**
 * @template T
 */
class GetAllInteractor
{
    /** @var GetRepository<T> */
    private $getRepository;

    /**
     * @param GetRepository<T> $getRepository
     */
    public function __construct(GetRepository $getRepository)
    {
        $this->getRepository = $getRepository;
    }

    /**
     * @param Query     $query
     * @param Operation $operation
     *
     * @return array<T>
     */
    public function execute(
        Query $query,
        Operation $operation
    ): array {
        return $this->getRepository->getAll($query, $operation);
    }
}
