<?php

namespace harmony\core\repository\mapper;

use harmony\core\domain\Model;
use harmony\core\repository\BaseEntity;

abstract class ModelToEntityMapper extends GenericMapper
{
    public function __construct(string $from_class, string $to_class)
    {
        parent::__construct($from_class, $to_class);

        $this->isReceivedClassLikeExpectedOrFail($from_class, Model::class);
        $this->isReceivedClassLikeExpectedOrFail($to_class, BaseEntity::class);
    }
}
