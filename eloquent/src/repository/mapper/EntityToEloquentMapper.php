<?php

namespace harmony\eloquent\repository\mapper;

use harmony\core\repository\BaseEntity;
use harmony\core\repository\error\MapException;
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
     * @param $from
     *
     * @return EloquentEntity
     * @throws MapException
     */
    protected function overrideMap($from): EloquentEntity
    {
        /** @var BaseEntity $from */
        $class = $this->getTypeTo();

        /** @var EloquentEntity $to */
        if (method_exists($from, 'getId')) {
            $to = $class::firstOrNew(['id' => $from->getId()]);
        } else {
            $to = new $class();
        }

        $attributes = $to->getFillable();

        foreach ($attributes AS $attribute) {
            $get_method = "get" . ucfirst($attribute);

            if (!method_exists($from, $get_method)) {
                throw new MapException(
                    'No value for constructor parameter "' . $attribute
                    . '" at Class "' . $class . '"'
                );
            }

            $to->$attribute = $from->$get_method();
        }

        return $to;
    }
}
