<?php

namespace harmony\eloquent\repository\mapper;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\mapper\GenericMapper;
use harmony\eloquent\repository\EloquentEntity;

abstract class EntityToEloquentMapper extends GenericMapper
{
    public function __construct(string $from_class, string $to_class)
    {
        parent::__construct($from_class, $to_class);

        $this->isReceivedClassLikeExpectedOrFail($from_class, BaseEntity::class);
        $this->isReceivedClassLikeExpectedOrFail($to_class, EloquentEntity::class);
    }

    /**
     * @param BaseEntity $from
     *
     * @return EloquentEntity
     */
    protected function getEloquentFromDbOrNew(BaseEntity $from): EloquentEntity
    {
        /** @var BaseEntity $from */
        $class = $this->getTypeTo();

        /** @var EloquentEntity $to */
        if (method_exists($from, 'getId')) {
            $to = $class::firstOrNew(['id' => $from->getId()]);
        } else {
            $to = new $class();
        }

        return $to;
    }
}
