<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\GetRepository;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\query\Query;

class GetInteractor
{
    /** @var GetRepository */
    private $getRepository;

    /**
     * @param $getRepository
     */
    public function __construct(GetRepository $getRepository)
    {
        $this->getRepository = $getRepository;
    }

    /**
     * @param Query     $query     query
     * @param Operation $operation operation
     *
     * @return BaseEntity
     */
    public function execute(
        Query $query,
        Operation $operation
    ): BaseEntity {
        return $this->getRepository->get($query, $operation);
    }
}
