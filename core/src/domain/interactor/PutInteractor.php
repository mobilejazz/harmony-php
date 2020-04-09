<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\PutRepository;
use harmony\core\repository\query\Query;

class PutInteractor
{
    /** @var PutRepository */
    private $putRepository;

    /**
     * @param PutRepository $putRepository
     */
    public function __construct(PutRepository $putRepository)
    {
        $this->putRepository = $putRepository;
    }

    /**
     * @param Query           $query
     * @param Operation       $operation
     * @param BaseEntity|null $baseModel
     *
     * @return BaseEntity
     */
    public function execute(
        Query $query,
        Operation $operation,
        BaseEntity $baseModel = null
    ): BaseEntity {
        return $this->putRepository->put($query, $operation, $baseModel);
    }
}
