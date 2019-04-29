<?php

namespace src\domain\interactor;

use src\data\dataSource\query\Query;
use src\data\repository\GetRepository;
use src\data\repository\operation\Operation;
use src\domain\model\BaseModel;

/**
 * Class GetInteractor
 */
class GetInteractor {

    /** @var GetRepository  */
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
     * Execute
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return BaseModel
     */
    public function execute(
        Query $query, Operation $operation
    ) : BaseModel {
        return $this->getRepository->get($query, $operation);
    }
}