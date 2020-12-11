<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\PutRepository;
use harmony\core\repository\query\Query;

/**
 * @template T
 */
class PutInteractor
{
    /**
     * @param PutRepository<T> $putRepository
     */
    public function __construct(
        protected PutRepository $putRepository
    ) {
    }

    /**
     * @param Query     $query
     * @param Operation $operation
     * @param T|null    $model
     *
     * @return mixed
     * @phpstan-return T
     */
    public function execute(Query $query, Operation $operation, $model = null)
    {
        return $this->putRepository->put($query, $operation, $model);
    }
}
