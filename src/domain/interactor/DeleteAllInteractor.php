<?php

namespace harmony\domain\interactor;

use harmony\data\dataSource\query\Query;
use harmony\data\repository\DeleteRepository;
use harmony\data\repository\operation\Operation;

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