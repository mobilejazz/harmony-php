<?php

namespace harmony\core\repository\mapper;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\InMemoryEntity;

abstract class EntityToInMemoryMapper extends GenericMapper
{
    public function __construct(string $from_class, string $to_class)
    {
        parent::__construct($from_class, $to_class);

        $this->isReceivedClassLikeExpectedOrFail($from_class, BaseEntity::class);
        $this->isReceivedClassLikeExpectedOrFail($to_class, InMemoryEntity::class);
    }
}
