<?php

namespace harmony\eloquent\repository;

trait EloquentHelper {
  /**
   * @param mixed                 $from
   * @param string|EloquentEntity $class_to
   *
   * @return EloquentEntity
   */
  protected function getEloquentFromDbByIdOrNew(
    $from,
    string $class_to
  ): EloquentEntity {
    if (method_exists($from, "getId")) {
      return $class_to::firstOrNew(["id" => $from->getId()]);
    }

    return new $class_to();
  }
}
