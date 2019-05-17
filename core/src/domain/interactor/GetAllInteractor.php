<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\GetRepository;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * Class GetAllInteractor
 */
class GetAllInteractor
{
    /** @var GetRepository */
    private $getRepository;

    /**
     * GetAllInteractor constructor.
     *
     * @param $getRepository
     */
    public function __construct(GetRepository $getRepository)
    {
        $this->getRepository = $getRepository;
    }

    /**
     * @param Query     $query
     * @param Operation $operation
     *
     * @return GenericCollection
     */
    public function execute(
        Query $query,
        Operation $operation
    ): GenericCollection {
        return $this->getRepository->getAll($query, $operation);
    }
}
