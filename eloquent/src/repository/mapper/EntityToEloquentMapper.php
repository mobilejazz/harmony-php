<?php

namespace harmony\eloquent\repository\mapper;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\mapper\GenericMapper;
use harmony\eloquent\repository\EloquentEntity;

class EntityToEloquentMapper extends GenericMapper
{
    public function __construct(string $from_class, string $to_class)
    {
        parent::__construct($from_class, $to_class);

        $this->isReceivedClassLikeExpectedOrFail($from_class, BaseEntity::class);
        $this->isReceivedClassLikeExpectedOrFail($to_class, EloquentEntity::class);
    }

    /**
     * @param object $from
     *
     * @return EloquentEntity
     */
    protected function overrideMap($from): EloquentEntity
    {
        dd('entity to eloquent');
        // TODO: Implement overrideMap() method.
    }
}
