<?php

namespace harmony\eloquent\repository;

use harmony\core\repository\BaseEntity;

trait EloquentHelper
{
    /**
     * @param BaseEntity            $from
     * @param string|EloquentEntity $class_to
     *
     * @return EloquentEntity
     */
    protected function getEloquentFromDbByIdOrNew(
        $from,
        string $class_to
    ): EloquentEntity {
        if (method_exists($from, 'getId')) {
            $to = $class_to::firstOrNew(['id' => $from->getId()]);
        } else {
            $to = new $class_to();
        }

        return $to;
    }
}
