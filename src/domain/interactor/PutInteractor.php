<?php

namespace src\domain\interactor;

use src\data\dataSource\query\Query;
use src\data\repository\operation\Operation;
use src\data\repository\PutRepository;
use src\domain\model\BaseModel;

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
     * @param Query     $query     query
     * @param Operation $operation operation
     * @param BaseModel $baseModel model
     *
     * @return BaseModel
     */
    public function execute(
        Query $query, Operation $operation, BaseModel $baseModel
    ) : BaseModel {
        return $this->putRepository->put($query, $operation, $baseModel);
    }
}