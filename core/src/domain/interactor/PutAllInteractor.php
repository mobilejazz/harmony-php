<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\PutRepository;
use harmony\core\repository\query\Query;

/**
 * @template T
 */
class PutAllInteractor
{
    /** @var PutRepository<T> */
    private $putRepository;

    /**
     * @param PutRepository<T> $putRepository
     */
    public function __construct(PutRepository $putRepository)
    {
        $this->putRepository = $putRepository;
    }

    /**
     * @param Query         $query
     * @param Operation     $operation
     * @param array<T>|null $models
     *
     * @return array<T>
     */
    public function execute(Query $query, Operation $operation, array $models = null): array
    {
        return $this->putRepository->putAll($query, $operation, $models);
    }
}
