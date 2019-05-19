<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\BaseHarmony;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\PutRepository;
use harmony\core\repository\query\Query;
use harmony\core\shared\collection\GenericCollection;

/**
 * Class PutAllInteractor
 */
class PutAllInteractor
{
    /** @var PutRepository */
    private $putRepository;

    /**
     * PutInteractor constructor.
     *
     * @param $putRepository
     */
    public function __construct(PutRepository $putRepository)
    {
        $this->putRepository = $putRepository;
    }

    /**
     * @param Query             $query
     * @param Operation         $operation
     * @param GenericCollection $baseModels
     *
     * @return BaseHarmony
     */
    public function execute(
        Query $query,
        Operation $operation,
        GenericCollection $baseModels
    ): BaseHarmony {
        return $this->putRepository->putAll($query, $operation, $baseModels);
    }
}
