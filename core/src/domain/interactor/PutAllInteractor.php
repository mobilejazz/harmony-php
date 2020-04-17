<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\operation\Operation;
use harmony\core\repository\PutRepository;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

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
     * @param Query                     $query
     * @param Operation                 $operation
     * @param GenericCollection<T>|null $models
     *
     * @return GenericCollection<T>
     */
    public function execute(
        Query $query,
        Operation $operation,
        GenericCollection $models = null
    ): GenericCollection {
        return $this->putRepository->putAll($query, $operation, $models);
    }
}
