<?php

namespace Sample\controllers;

use harmony\core\domain\interactor\DeleteInteractor;
use harmony\core\domain\interactor\GetAllInteractor;
use harmony\core\domain\interactor\GetInteractor;
use harmony\core\domain\interactor\PutAllInteractor;
use harmony\core\domain\interactor\PutInteractor;

class ProductController
{
    /**
     * @var GetInteractor
     */
    protected $getInteractor;
    /**
     * @var GetAllInteractor
     */
    protected $getAllInteractor;
    /**
     * @var PutInteractor
     */
    protected $putInteractor;
    /**
     * @var PutAllInteractor
     */
    protected $putAllInteractor;
    /**
     * @var DeleteInteractor
     */
    protected $deleteInteractor;

    public function __construct(
        GetInteractor $getInteractor,
        GetAllInteractor $getAllInteractor,
        PutInteractor $putInteractor,
        PutAllInteractor $putAllInteractor,
        DeleteInteractor $deleteInteractor
    )
    {
        $this->getInteractor = $getInteractor;
        $this->getAllInteractor = $getAllInteractor;
        $this->putInteractor = $putInteractor;
        $this->putAllInteractor = $putAllInteractor;
        $this->deleteInteractor = $deleteInteractor;
    }

    public function actionIndex()
    {
        return "Hello World";
    }
}
