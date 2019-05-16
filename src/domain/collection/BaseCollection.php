<?php

namespace harmony\domain\model;

/**
 * Class BaseCollection
 */
class BaseCollection {

    private $models;

    /**
     * BaseCollection constructor.
     * @param $models
     */
    public function __construct(array $models)
    {
        $this->models = $models;
    }

    /**
     * Get models
     *
     * @return array
     */
    public function getModels(): array
    {
        return $this->models;
    }

}