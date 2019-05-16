<?php

namespace harmony\domain\interactor;

use harmony\data\dataSource\query\Query;
use harmony\data\repository\DeleteRepository;
use harmony\data\repository\operation\Operation;

/**
 * Class DeleteInteractor
 */
class DeleteInteractor {

    /** @var DeleteRepository  */
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
        Query $query, Operation $operation
    ) {
        $this->deleteRepository->delete($query, $operation);
    }
}