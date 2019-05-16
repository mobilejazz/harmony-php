<?php

namespace harmony\domain\interactor;

use harmony\data\dataSource\query\Query;
use harmony\data\repository\operation\Operation;
use harmony\data\repository\PutRepository;
use harmony\domain\model\BaseCollection;
use harmony\domain\model\BaseHarmony;

/**
 * Class PutAllInteractor
 */
class PutAllInteractor {

    /** @var PutRepository  */
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
     * @param Query          $query      query
     * @param Operation      $operation  operation
     * @param BaseCollection $baseModels model
     *
     * @return BaseHarmony
     */
    public function execute(
        Query $query, Operation $operation, BaseCollection $baseModels
    ) : BaseHarmony {
        return $this->putRepository->putAll($query, $operation, $baseModels);
    }
}