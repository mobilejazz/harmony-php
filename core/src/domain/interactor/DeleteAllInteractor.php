<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\DeleteRepository;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

class DeleteAllInteractor
{
    /** @var DeleteRepository */
    private $deleteRepository;

    /**
     * @param $deleteRepository
     */
    public function __construct(DeleteRepository $deleteRepository)
    {
        $this->deleteRepository = $deleteRepository;
    }

    /**
     * @param Query     $query
     * @param Operation $operation
     *
     * @return bool
     */
    public function execute(
        Query $query,
        Operation $operation
    ): bool {
        return $this->deleteRepository->deleteAll($query, $operation);
    }
}
