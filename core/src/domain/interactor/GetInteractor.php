<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\GetRepository;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

/**
 * @template T
 */
class GetInteractor
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
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return mixed
     * @phpstan-return T
     */
    public function execute(
        Query $query,
        Operation $operation
    ) {
        return $this->getRepository->get($query, $operation);
    }
}
