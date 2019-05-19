<?php

namespace harmony\core\domain\interactor;

use harmony\core\repository\BaseHarmony;
use harmony\core\repository\operation\Operation;
use harmony\core\repository\PutRepository;
use harmony\core\repository\query\Query;

/**
 * Class PutInteractor
 */
class PutInteractor
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
     * Execute
     *
     * @param Query       $query     query
     * @param Operation   $operation operation
     * @param BaseHarmony $baseModel model
     *
     * @return BaseHarmony
     */
    public function execute(
        Query $query,
        Operation $operation,
        BaseHarmony $baseModel
    ): BaseHarmony {
        return $this->putRepository->put($query, $operation, $baseModel);
    }
}
