<?php

namespace harmony\eloquent\repository\mapper;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\mapper\GenericMapper;
use harmony\eloquent\repository\EloquentEntity;

abstract class EloquentToEntityMapper extends GenericMapper
{
    public function __construct(string $from_class, string $to_class)
    {
        parent::__construct($from_class, $to_class);

        $this->isReceivedClassLikeExpectedOrFail($from_class, EloquentEntity::class);
        $this->isReceivedClassLikeExpectedOrFail($to_class, BaseEntity::class);
    }
}
