<?php

namespace Harmony\Core\Data\Query;

class IdsQuery extends KeysQuery {
  /**
   * @param int[]|string[] $ids
   */
  public function __construct(public readonly array $ids) {
    parent::__construct(
      array_map(static fn($id): string => (string) $id, $ids),
    );
  }
}
