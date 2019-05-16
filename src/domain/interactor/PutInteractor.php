<?php

namespace harmony\domain\interactor;

use harmony\data\dataSource\query\Query;
use harmony\data\repository\operation\Operation;
use harmony\data\repository\PutRepository;
use harmony\domain\model\BaseHarmony;

/**
 * Class PutInteractor
 */
class PutInteractor {

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
     * @param Query       $query     query
     * @param Operation   $operation operation
     * @param BaseHarmony $baseModel model
     *
     * @return BaseHarmony
     */
    public function execute(
        Query $query, Operation $operation, BaseHarmony $baseModel
    ) : BaseHarmony {
        return $this->putRepository->put($query, $operation, $baseModel);
    }
}