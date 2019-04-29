<?php

namespace src\domain\interactor;

use src\data\dataSource\query\Query;
use src\data\repository\DeleteRepository;
use src\data\repository\operation\Operation;

/**
 * Class DeleteAllInteractor
 */
class DeleteAllInteractor {

    /** @var DeleteRepository  */
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
        Query $query, Operation $operation
    ) {
        $this->deleteRepository->deleteAll($query, $operation);
    }
}