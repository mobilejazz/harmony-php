<?php

namespace harmony\domain\interactor;

use harmony\data\dataSource\query\Query;
use harmony\data\repository\GetRepository;
use harmony\data\repository\operation\Operation;
use harmony\domain\model\BaseHarmony;

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
     * @return BaseHarmony
     */
    public function execute(
        Query $query, Operation $operation
    ) : BaseHarmony {
        return $this->getRepository->get($query, $operation);
    }
}