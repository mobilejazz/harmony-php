<?php

namespace Harmony\Core\Domain\Pagination;

/**
 * @template T
 */
class Pagination {
    /**
     * @param array<T> $values
     */
    public function __construct(
        protected array $values,
    ) {
    }

    /**
     * @return array<T>
     */
    public function getValues(): array {
        return $this->values;
    }
}
