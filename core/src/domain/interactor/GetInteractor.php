<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\BaseHarmony;
use harmony\core\repository\GetRepository;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

/**
 * Class GetInteractor
 */
class GetInteractor
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
     * Execute
     *
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return BaseHarmony
     */
    public function execute(
        Query $query,
        Operation $operation
    ): BaseHarmony {
        return $this->getRepository->get($query, $operation);
    }
}
