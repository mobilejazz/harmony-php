<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\DeleteRepository;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

/**
 * Class DeleteAllInteractor
 */
class DeleteAllInteractor
{
    /** @var DeleteRepository */
    private $deleteRepository;

    /**
     * DeleteAllInteractor constructor.
     *
     * @param $deleteRepository
     */
    public function __construct(DeleteRepository $deleteRepository)
    {
        $this->deleteRepository = $deleteRepository;
    }

    /**
     * Execute
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return void
     */
    public function execute(
        Query $query,
        Operation $operation
    ) {
        $this->deleteRepository->deleteAll($query, $operation);
    }
}
