<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\DeleteRepository;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

/**
 * Class DeleteInteractor
 */
class DeleteInteractor
{
    /** @var DeleteRepository */
    private $deleteRepository;

    /**
     * DeleteInteractor constructor.
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
        $this->deleteRepository->delete($query, $operation);
    }
}
