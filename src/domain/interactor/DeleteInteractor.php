<?php

namespace src\domain\interactor;

use src\data\dataSource\query\Query;
use src\data\repository\DeleteRepository;
use src\data\repository\operation\Operation;

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